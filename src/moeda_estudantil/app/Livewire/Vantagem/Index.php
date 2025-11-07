<?php

namespace App\Livewire\Vantagem;

use App\Mail\ResgateAlunoMail;
use App\Mail\ResgateEmpresaMail;
use App\Models\Resgate;
use App\Models\Vantagem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination;

    use Interactions;

    public $vantagem;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $sort = [
        'column'    => 'nome',
        'direction' => 'asc',
    ];


    public function render()
    {
        return view('livewire.vantagem.index');
    }

    #[Computed()]
    public function vantagens(): LengthAwarePaginator
    {
        return Vantagem::query()
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela vantagens
                    $q->whereAny(['nome', 'descricao', 'valor'], 'like', $term)

                    // colunas do relacionamento user()
                    ->orWhereRelation('empresa', 'nome', 'like', $term);
                });
            })
            ->orderBy(...array_values($this->sort))
            ->paginate($this->quantity)
            ->withQueryString();
    }

    function mask_cnpj(?string $cnpj): ?string
    {
        if ($cnpj === null) {
            return null;
        }

        // Remove qualquer caractere que não seja número
        $digits = preg_replace('/\D/', '', $cnpj);

        // Se não tiver 14 dígitos, retorna o original (ou vazio)
        if (strlen($digits) !== 14) {
            return $cnpj;
        }

        return substr($digits, 0, 2) . '.' .
            substr($digits, 2, 3) . '.' .
            substr($digits, 5, 3) . '/' .
            substr($digits, 8, 4) . '-' .
            substr($digits, 12, 2);
    }

    public function comprar($id)
    {
        $this->vantagem = Vantagem::findOrFail($id);

        $this->dialog()
        ->question('Atenção!', "Quer efeturar o resgate do item {$this->vantagem->nome}? \nSeu saldo atual é: " . auth()->user()->aluno->saldo_moedas)
        ->confirm('Confirmar', 'confirmed')
        ->cancel('Cancelar')
        ->send();
    }

    public function confirmed(): void
    {
        $this->vantagem->codigo_resgate = Str::random(6);

        $resgate = [
            'aluno_id' => auth()->user()->aluno->id,
            'vantagem_id' => $this->vantagem->id,
            'valor' => $this->vantagem->valor,
            'codigo_resgate' => $this->vantagem->codigo_resgate,
            'status' => 1
        ];

        $novo_saldo = auth()->user()->aluno->saldo_moedas - $this->vantagem->valor;

        if($novo_saldo < 0)
        {
            $this->error('Erro', 'Saldo Insuficiente!')->send();
        }

        auth()->user()->aluno->update(['saldo_moedas' => $novo_saldo]);

        $resgate = Resgate::create($resgate);

        $mail = [
            'aluno' => $resgate->aluno->user->name,
            'empresa' => $resgate->vantagem->empresa->user->name,
            'codigo_resgate' => $resgate->codigo_resgate,
            'vantagem' => $resgate->vantagem->nome,
            'descricao' => $resgate->vantagem->descricao,
            'valor' => $resgate->valor,
            'data' => $resgate->created_at->format('d/m/Y H:i'),
            'url' => env('APP_URL') . '/resgate'
        ];

        
        $this->reset('vantagem');
        $this->dialog()->success('Resgate Efetuado!', "Voce resgatou a vantagem {$resgate->vantagem->nome} por {$resgate->valor} moedas")->send();
        
        Mail::to($resgate->aluno->user->email)->send(new ResgateAlunoMail($mail));
        Mail::to($resgate->vantagem->empresa->user->email)->send(new ResgateEmpresaMail($mail));
    }
}
