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
        'direction' => 'desc',
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
    public function rows(): LengthAwarePaginator
    {
        return Aluno::query()
            ->whereNotIn('id', [Auth::id()])
            ->when($this->search !== null, fn (Builder $query) => $query->whereAny(['rg', 'instituicao', 'curso', 'saldo_moedas'], 'like', '%'.trim($this->search).'%'))
            ->orderBy(...array_values($this->sort))
            ->withAggregate('user', 'name')
            ->withAggregate('user', 'email')
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
