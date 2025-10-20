<?php

namespace App\Livewire\Empresas;

use App\Livewire\Traits\Alert;
use App\Models\Empresa;
use App\Models\Endereco;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    use Alert;

    public ?Empresa $empresa;

    public ?Endereco $endereco;

    public $bairro;

    public bool $modal = false;

    public function render(): View
    {
        return view('livewire.empresas.update');
    }

    #[On('load::empresa')]
    public function load(Empresa $empresa): void
    {
        $this->empresa = $empresa;
        $this->endereco = $this->empresa->endereco;
        $this->bairro = $this->endereco->bairro;

        $this->modal = true;
    }

    public function rules(): array
    {
        return [
            'empresa.nome' => [
                'required',
                'string',
                'max:255'
            ],
            'empresa.email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:empresas,email,' . $this->empresa->id,
            ],
            'empresa.cnpj' => [
                'required',
                'string',
                'size:14',
                'unique:empresas,cnpj,' . $this->empresa->id,
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

        $this->endereco->bairro = $this->bairro;
        $this->endereco->save();

        $this->empresa->save();

        $this->dispatch('updated');

        $this->resetExcept(['empresa', 'endereco']);

        $this->success();
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
