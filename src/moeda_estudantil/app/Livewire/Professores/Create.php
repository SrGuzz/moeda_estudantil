<?php

namespace App\Livewire\Professores;

use App\Livewire\Traits\Alert;
use App\Models\Aluno;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\Professor;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use Alert;

    public Professor $professor;

    public $empresas;

    public User $user;
    
    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function mount(): void
    {
        $this->professor = new Professor();
        $this->user = new User();
        $this->empresas = Empresa::withAggregate('user', 'name')->orderBy('user_name')->get();
        $this->empresas = $this->empresas->map(fn($e) => [
            'label' => $e->user_name,         // texto a mostrar
            'value' => $e->id,                // id da empresa
        ])->all();
    }

    public function render(): View
    {
        return view('livewire.professores.create');
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
                Rule::unique('users', 'email'),
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
                'unique:professores,cpf'
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

        $this->user->password = bcrypt($this->password);
        $this->user->email_verified_at = now();
        $this->user->save();

        $this->professor->user_id = $this->user->id;
        $this->professor->save();

        $this->dispatch('created');

        $this->reset();
        $this->mount();

        $this->success();
    }

}
