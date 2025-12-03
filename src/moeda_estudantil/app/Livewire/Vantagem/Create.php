<?php

namespace App\Livewire\Vantagem;

use App\Livewire\Traits\Alert;
use App\Models\Vantagem;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Alert;

    use Interactions;

    use WithFileUploads;

    public Vantagem $vantagem;

    #[Rule('nullable')]
    #[Rule('image')]
    #[Rule('mimes:jpeg,png,jpg,webp')]
    public $foto;

    public bool $modal = false;

    public function mount(): void
    {
        $this->vantagem = new Vantagem();
    }

    public function render(): View
    {
        return view('livewire.vantagem.create');
    }

    public function rules(): array
    {
        return [
            'vantagem.nome' => [
                'min:2',
                'required',
                'string',
                'unique:vantagens,nome'
            ],
            'vantagem.descricao' => [
                'min:5',
                'required',
                'string',
            ],
            'vantagem.valor' => [
                'integer',
                'required',
            ]
        ];
    }

    public function save(): void
    {
        $this->validate();  

        $this->vantagem->foto = Storage::disk('public')->putFile('fotos', $this->foto);
        $this->vantagem->empresa_id = auth()->user()->empresa->id;
        $this->vantagem->save();

        $this->dispatch('created');

        $this->reset();
        $this->mount();

        $this->toast()->success();
    }

}
