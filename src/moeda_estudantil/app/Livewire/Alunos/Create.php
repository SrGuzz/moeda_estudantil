<?php

namespace App\Livewire\Alunos;

use App\Livewire\Traits\Alert;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use Alert;

    public User $user;

    public Aluno $aluno;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function mount(): void
    {
        $this->user = new User();
        $this->aluno = new Aluno();
    }

    public function render(): View
    {
        return view('livewire.alunos.create');
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
            'aluno.rg' => [
                'min:6',
                'required',
                'string',
                'unique:alunos,rg'
            ],
            'aluno.instituicao' => [
                'min:3',
                'string',
                'required',
            ],
            'aluno.curso' => [
                'min:3',
                'string',
                'required',
            ]
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = bcrypt($this->password);
        $this->user->email_verified_at = now();
        $this->user->save();

        $this->aluno->user_id = $this->user->id;
        $this->aluno->save();

        $this->dispatch('created');

        $this->reset();
        $this->user = new User();
        $this->aluno = new Aluno();

        $this->success();
    }
}
