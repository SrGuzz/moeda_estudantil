<?php

namespace App\Livewire\Alunos;

use App\Livewire\Traits\Alert;
use App\Models\Aluno;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Update extends Component
{
    use Alert;

    use Interactions;

    public ?Aluno $aluno;

    public ?User $user;

    public ?Endereco $endereco;

    public ?string $bairro;

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
        $this->endereco = $this->aluno->endereco;
        $this->bairro = $this->endereco->bairro;

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
            ],
            'endereco.rua' => [
                'required',
                'string',
            ],
            'endereco.numero' => [
                'required',
                'numeric',
            ],
            'endereco.cidade' => [
                'required',
                'string',
            ],
            'endereco.estado' => [
                'required',
                'string',
            ],
            'endereco.cep' => [
                'required',
                'string',
            ],
            'endereco.complemento' => [
                'nullable',
                'string',
            ],
            'bairro' => [
                'required',
                'string',
            ]
        ];
    }

    public function save(): void
    {
        $this->validate();

        $this->user->password = when($this->password !== null, bcrypt($this->password), $this->user->password);
        $this->user->save();

        $this->endereco->bairro = $this->bairro;
        $this->endereco->save();

        $this->aluno->save();

        $this->dispatch('updated');

        $this->reset();

        $this->toast()->success("Registro efetuado com sucesso!");
    }

    public function updatedEnderecoCep()
    {
        if(mb_strlen($this->endereco->cep, 'UTF-8') == 9){
            $endereco = $this->buscarCep();

            if($endereco && !array_key_exists('erro', $endereco))
            {
                $this->endereco->rua = $endereco['logradouro'];
                $this->bairro = $endereco['bairro'];
                $this->endereco->cidade = $endereco['localidade'];
                $this->endereco->estado = $endereco['estado'];
                $this->resetErrorBag('endereco.cep');
            }
            else
            {
                $this->addError('endereco.cep', 'Informe um CEP válido.');
            }
        }
    }

    public function buscarCep()
    {
        $response = Http::get('https://viacep.com.br/ws/' . $this->endereco->cep .'/json');
        if($response){
            return $response->json();
        }
        else{
            $this->toast()
                ->timeout(seconds: 15)
                ->error('Erro', 'Não foi possivel comunicar com os correios.')
                ->send();

            $this->modal = false;
        }
    }
}
