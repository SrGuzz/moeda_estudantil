<?php

namespace App\Livewire\Empresas;

use App\Livewire\Traits\Alert;
use App\Models\Empresa;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;


class Delete extends Component
{
    use Interactions;
    use Alert;

    public Empresa $empresa;

    public function render()
    {
        return view('livewire.empresas.delete');
    }

    #[On('delete::empresa')]    
    public function load(Empresa $empresa)
    {
        $this->empresa = $empresa;

        $this->dialog()
        ->question('Cuidado!', 'Quer apagar a empresa ' . $empresa->nome . '?')
        ->confirm('Confirmar', 'confirmed')
        ->cancel('Cancelar')
        ->send();
    }

    public function confirmed(): void
    {
        $this->empresa->endereco->delete();
        $this->empresa->delete();
        $this->reset('empresa');
        $this->toast()->success("Registro efetuado com sucesso!");
        $this->dispatch('deleted');
    }
}
