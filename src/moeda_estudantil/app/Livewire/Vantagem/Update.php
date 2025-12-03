<?php

namespace App\Livewire\Vantagem;

use App\Livewire\Traits\Alert;
use App\Models\Empresa;
use App\Models\Vantagem;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use TallStackUi\Traits\Interactions;

class Update extends Component
{
    use Alert;

    use Interactions;

    use WithFileUploads;

    public ?Vantagem $vantagem = null;

    #[Rule('nullable')]
    #[Rule('image')]
    #[Rule('mimes:jpeg,png,jpg,webp')]
    public $foto;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.vantagem.update');
    }

    #[On('load::vantagem')]
    public function load(Vantagem $vantagem): void
    {
        $this->vantagem = $vantagem;

        $this->modal = true;
    }

    public function rules(): array
    {
        return [
            'vantagem.nome' => [
                'min:2',
                'required',
                'string',
                'unique:vantagens,nome,' . $this->vantagem->id
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

        if($this->foto)
        {
            $this->vantagem->foto = Storage::disk('public')->putFile('fotos', $this->foto);
        }

        $this->vantagem->save();

        $this->dispatch('updated');

        $this->resetExcept('empresas');

        $this->toast()->success();
    }
}
