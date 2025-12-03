<?php

namespace App\Livewire\Empresas;

use App\Livewire\Traits\Alert;
use App\Models\Empresa;
use App\Models\Endereco;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Create extends Component
{
    use Alert;
    use Interactions;

    public User $user;

    public Empresa $empresa;

    public Endereco $endereco;

    public $bairro;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public bool $modal = false;

    public function mount(): void
    {
        $this->empresa = new Empresa();
        $this->endereco = new Endereco();
        $this->user = new User();
    }

    public function render(): View
    {
        return view('livewire.empresas.create');
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
                'unique:users,email',
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed'
            ],
            'empresa.cnpj' => [
                'required',
                'string',
                'size:14',
                'unique:empresas,cnpj',
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

        $this->user->password = $this->password;
        $this->user->save();

        $this->endereco->bairro = $this->bairro;
        $this->endereco->save();

        $this->empresa->user_id = $this->user->id;
        $this->empresa->endereco_id = $this->endereco->id;
        $this->empresa->save();

        $this->dispatch('created');

        $this->reset();
        $this->toast()->success();
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
