<?php

namespace App\Livewire\Alunos;

use App\Livewire\Traits\Alert;
use App\Mail\Transacao as MailTransacao;
use App\Models\Aluno;
use App\Models\Transacao as ModelsTransacao;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Transacao extends Component
{
    use Alert;

    use Interactions;

    public ?Aluno $aluno;

    public ?User $user;

    public ?ModelsTransacao $transacao;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.alunos.transacao');
    }

    #[On('transacao::aluno')]
    public function load(Aluno $aluno): void
    {
        $this->transacao = new ModelsTransacao();
        $this->transacao->aluno_id = $aluno->id;
        $this->transacao->professor_id = auth()->user()?->professor->id ?? null;

        $this->aluno = $aluno;
        $this->user = $this->aluno->user;
        
        $this->modal = true;
    }

    public function rules(): array
    {
        return [
            'transacao.moedas' => [
                'required',
                'numeric',
                'min:1',
                'max:' . auth()->user()->professor->saldo_moedas ?? '1',
            ],
            'transacao.mensagem' => [
                'required',
                'string',
                'min:5',
                'max:500'
            ],
            'transacao.aluno_id' => [
                'required',
                'exists:alunos,id'
            ],
            'transacao.professor_id' => [
                'required',
                'exists:professores,id'
            ]
        ];
    }

    public function save(): void
    {
        $this->validate();
        
        $this->transacao->save();
        
        $professor = auth()->user()->professor; 
        $professor->saldo_moedas = intval(auth()->user()->professor->saldo_moedas) - intval($this->transacao->moedas);
        $professor->save();

        $this->aluno->saldo_moedas = intval($this->aluno->saldo_moedas) + intval($this->transacao->moedas);
        $this->aluno->save();

        $this->enviar_email();

        $this->dispatch('updated');

        $this->resetExcept(['aluno', 'user']);
        $this->transacao = new ModelsTransacao();

        $this->toast()->success("Registro efetuado com sucesso!");
    }

    public function enviar_email()
    {
        $transacao = [];
        $transacao['professor'] = $this->transacao->professor->user->name;
        $transacao['aluno'] = $this->transacao->aluno->user->name;
        $transacao['moedas'] = $this->transacao->moedas;
        $transacao['data'] = $this->transacao->created_at->format('d/m/Y H:i');
        $transacao['destinatario'] = $this->transacao->professor->user->name;
        $transacao['tipo'] = 'enviada';

        Mail::to($this->transacao->professor->user->email)->send(new MailTransacao($transacao));

        $transacao['destinatario'] = $this->transacao->aluno->user->name;
        $transacao['tipo'] = 'recebida';

        Mail::to($this->transacao->aluno->user->email)->send(new MailTransacao($transacao));

    }
}
