<?php

namespace App\Livewire\Professores;

use App\Livewire\Traits\Alert;
use App\Models\Professor;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Delete extends Component
{
    use Interactions;
    use Alert;

    public Professor $professor;

    public function render()
    {
        return view('livewire.professores.delete');
    }

    #[On('delete::professor')]    
    public function load(Professor $professor)
    {
        $this->professor = $professor;

        $this->dialog()
        ->question('Cuidado!', 'Quer apagar o professor ' . $professor->user->name . '?')
        ->confirm('Confirmar', 'confirmed')
        ->cancel('Cancelar')
        ->send();
    }

    public function confirmed(): void
    {
        $this->professor->user->delete();
        $this->reset('professor');
        $this->toast()->success();
        $this->dispatch('deleted');
    }
}
