<?php

namespace App\Livewire\Professores;

use App\Livewire\Traits\Alert;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    use Alert;

    public $empresas;

    public ?User $user = null;

    public ?Professor $professor = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.professores.update');
    }

    public function mount()
    {
        $this->empresas = Empresa::orderBy('nome')->get();
    }

    #[On('load::professor')]
    public function load(Professor $professor): void
    {
        $this->professor = $professor;
        $this->user = $this->professor->user;
        $this->empresas = Empresa::orderBy('nome')->get();

        $this->modal = true;
    }

    public function rules(): array
    {
        return [
            'user.name' => [
                'required',
                'string',
                'max:255'
            ],
            'user.email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user?->id),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],
            'professor.cpf' => [
                'size:11',
                'required',
                'string',
                'unique:professores,cpf,' . $this->professor?->id
            ],
            'professor.departamento' => [
                'min:3',
                'string',
                'required',
            ],
            'professor.empresa_id' => [
                'integer',
                'required',
            ],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = when($this->password !== null, bcrypt($this->password), $this->user->password);
        $this->user->save();

        $this->professor->save();

        $this->dispatch('updated');

        $this->resetExcept(['professor', 'user']);

        $this->success();
    }
}
