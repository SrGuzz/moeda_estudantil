<?php

namespace App\Livewire\User;

use App\Models\Resgate as ModelsResgate;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Resgate extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $sort = [
        'column'    => 'created_at',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'aluno.user.name', 'label' => 'Aluno'],
        ['index' => 'vantagem.nome', 'label' => 'Vantagem'],
        ['index' => 'valor', 'label' => 'Valor'],
        ['index' => 'created_at', 'label' => 'Data'],
    ];

    public function render()
    {
        return view('livewire.user.resgate');
    }

    #[Computed()]
    public function resgates()
    {
        return auth()->user()->aluno->resgates;
    }

    #[Computed()]
    public function rows()
    {
        return ModelsResgate::query()
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela professores
                    $q->whereAny(['valor'], 'like', $term)

                    ->orWhereRelation('vantagem', 'nome', 'like', $term);
                });
            })
            ->orderBy(...array_values($this->sort))
            ->with(['aluno.user'])
            ->paginate($this->quantity)
            ->withQueryString();
    }

    public function soma_valor($resgates)
    {
        $total = 0;
        foreach($resgates as $resgate)
        {
            $total += $resgate->valor;
        }
        return $total;
    }

    public function resgates_semestre($resgates)
    {
        $ano = (int) date('Y');
        $mes = (int) date('n');

        // Defina início/fim do semestre como Carbon (pegando o dia todo)
        if ($mes <= 6) {
            $inicio = Carbon::create($ano, 1, 1)->startOfDay();
            $fim    = Carbon::create($ano, 6, 30)->endOfDay();
        } else {
            $inicio = Carbon::create($ano, 7, 1)->startOfDay();
            $fim    = Carbon::create($ano, 12, 31)->endOfDay();
        }

        $filtradas = $resgates->whereBetween('created_at', [$inicio, $fim]);

        return count($filtradas);
    }
}
