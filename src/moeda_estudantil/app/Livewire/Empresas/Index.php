<?php

namespace App\Livewire\Empresas;

use App\Models\Empresa;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $sort = [
        'column'    => 'nome',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'nome', 'label' => 'Nome'],
        ['index' => 'email', 'label' => 'Email'],
        ['index' => 'cnpj', 'label' => 'CNPJ'],
        ['index' => 'endereco_estado', 'label' => 'Estado'],
        ['index' => 'endereco_cidade', 'label' => 'Cidade'],
        ['index' => 'action', 'sortable' => false],
    ];

    public function render()
    {
        return view('livewire.empresas.index');
    }

    #[Computed()]
    public function empresas(): LengthAwarePaginator
    {
        return Empresa::query()
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela alunos
                    $q->whereAny(['nome', 'email', 'cnpj'], 'like', $term)

                    // colunas do relacionamento user()
                    ->orWhereRelation('endereco', 'cep', 'like', $term)
                    ->orWhereRelation('endereco', 'numero', 'like', $term)
                    ->orWhereRelation('endereco', 'rua', 'like', $term)
                    ->orWhereRelation('endereco', 'bairro', 'like', $term)
                    ->orWhereRelation('endereco', 'cidade', 'like', $term)
                    ->orWhereRelation('endereco', 'estado', 'like', $term)
                    ->orWhereRelation('endereco', 'estado', 'like', $term)
                    ->orWhereRelation('endereco', 'complemento', 'like', $term);
                });
            })
            ->orderBy(...array_values($this->sort))
            ->withAggregate('endereco', 'estado')
            ->withAggregate('endereco', 'cidade')
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
