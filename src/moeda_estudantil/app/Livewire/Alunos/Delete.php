<?php

namespace App\Livewire\Alunos;

use App\Livewire\Traits\Alert;
use App\Models\Aluno;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;


class Delete extends Component
{
    use Interactions;
    use Alert;

    public Aluno $aluno;

    public function render()
    {
        return view('livewire.alunos.delete');
    }

    #[On('delete::aluno')]    
    public function load(Aluno $aluno)
    {
        $this->aluno = $aluno;

        $this->dialog()
        ->question('Cuidado!', 'Quer apagar o aluno ' . $aluno->user->name . '?')
        ->confirm('Confirmar', 'confirmed')
        ->cancel('Cancelar')
        ->send();
    }

    public function confirmed(): void
    {
        $this->aluno->endereco->delete();
        $this->aluno->user->delete();
        $this->reset('aluno');
        $this->toast()->success();
        $this->dispatch('deleted');
    }
}
