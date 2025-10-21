<?php

namespace App\Livewire\Alunos;

use App\Models\Aluno;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?int $quantity = 5;

    public ?string $search = null;

    public array $sort = [
        'column'    => 'user_name',
        'direction' => 'asc',
    ];

    public array $headers = [
        ['index' => 'user_name', 'label' => 'Nome'],
        ['index' => 'user_email', 'label' => 'Email'],
        ['index' => 'rg', 'label' => 'RG'],
        ['index' => 'instituicao', 'label' => 'Instituicao'],
        ['index' => 'curso', 'label' => 'Curso'],
        ['index' => 'saldo_moedas', 'label' => 'Saldo de Moedas'],
        ['index' => 'action', 'sortable' => false],
    ];

    public function render()
    {
        return view('livewire.alunos.index');
    }

    #[Computed()]
    public function alunos(): LengthAwarePaginator
    {
        return Aluno::query()
            ->whereNotIn('id', [Auth::id()])
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela alunos
                    $q->whereAny(['rg', 'instituicao', 'curso', 'saldo_moedas'], 'like', $term)

                    // colunas do relacionamento user()
                    ->orWhereRelation('user', 'name',  'like', $term)
                    ->orWhereRelation('user', 'email', 'like', $term)
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
            ->withAggregate('user', 'name')
            ->withAggregate('user', 'email')
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
