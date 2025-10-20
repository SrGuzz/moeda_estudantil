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
    public function rows(): LengthAwarePaginator
    {
        return Empresa::query()
            ->when($this->search !== null, fn (Builder $query) => $query->whereAny(['nome', 'email', 'cnpj'], 'like', '%'.trim($this->search).'%'))
            ->orderBy(...array_values($this->sort))
            ->withAggregate('endereco', 'estado')
            ->withAggregate('endereco', 'cidade')
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
