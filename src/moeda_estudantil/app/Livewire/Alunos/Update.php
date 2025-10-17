<?php

namespace App\Livewire\Alunos;

use App\Livewire\Traits\Alert;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    use Alert;

    public ?Aluno $aluno;

    public ?User $user;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.alunos.update');
    }

    #[On('load::aluno')]
    public function load(Aluno $aluno): void
    {
        $this->aluno = $aluno;
        $this->user = $this->aluno->user;

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
                Rule::unique('users', 'email')->ignore($this->user->id),
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
                'unique:alunos,rg,' . $this->aluno->id
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

        $this->user->password = when($this->password !== null, bcrypt($this->password), $this->user->password);
        $this->user->save();

        $this->aluno->save();

        $this->dispatch('updated');

        $this->resetExcept(['aluno', 'user']);

        $this->success();
    }
}
