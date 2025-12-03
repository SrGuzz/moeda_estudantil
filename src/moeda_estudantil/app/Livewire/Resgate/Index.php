<?php

namespace App\Livewire\Resgate;

use App\Livewire\Traits\Alert;
use App\Models\Resgate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Index extends Component
{
    use Interactions;
    use Alert;
    
    public $codigo_resgate;

    public $resgate;

    public function render()
    {
        return view('livewire.resgate.index')->layout('layouts.resgate');
    }

    public function rules()
    {
        return [
            'codigo_resgate' => 'required|size:6|string|exists:resgates,codigo_resgate'
        ];
    }

    public function messages()
    {
        return [
            'codigo_resgate.exists' => 'O código digitado não existe!'
        ];
    }

    public function search()
    {
        $this->validate();
        $this->resgate = Resgate::where('codigo_resgate', $this->codigo_resgate)->first();
    }

    public function finalizar()
    {
        $this->dialog()
        ->question('Cuidado!', 'Quer finalizar o resgate ' . $this->resgate->codigo_resgate . '?')
        ->confirm('Confirmar', 'confirmed')
        ->cancel('Cancelar')
        ->send();
    }

    public function confirmed(): void
    {
        $this->resgate->status = 0;
        $this->resgate->save();
        $this->toast()->success();
    }
}
