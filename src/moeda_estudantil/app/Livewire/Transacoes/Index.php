<?php

namespace App\Livewire\Transacoes;

use App\Models\Transacao;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
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
        'column'    => 'created_at',
        'direction' => 'desc',
    ];

    public array $headers = [
        ['index' => 'professor.user.name', 'label' => 'Professor'],
        ['index' => 'aluno.user.name', 'label' => 'Aluno'],
        ['index' => 'moedas', 'label' => 'Valor'],
        ['index' => 'created_at', 'label' => 'Data'],
    ];

    public function render(): View
    {
        return view('livewire.transacoes.index');
    }

    #[Computed]
    public function rows(): LengthAwarePaginator
    {
        $option1 = auth()->user()->professor ? 'professor_id' : 'aluno_id';
        $option2 = auth()->user()->professor ? auth()->user()->professor->id : auth()->user()->aluno->id;

        return Transacao::query()
            ->where($option1, $option2)
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela professores
                    $q->whereAny(['moedas'], 'like', $term);
                });
            })
            ->orderBy(...array_values($this->sort))
            ->with(['professor.user', 'aluno.user'])
            ->paginate($this->quantity)
            ->withQueryString();
    }
}
