<?php

namespace App\Livewire\Professores;

use App\Models\Professor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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


    public function render()
    {
        return view('livewire.professores.index');
    }

    #[Computed()]
    public function professores(): LengthAwarePaginator
    {
        return Professor::query()
            ->whereNotIn('id', [Auth::id()])
            ->when(filled($this->search), function ($q) {
                $term = '%'.trim($this->search).'%';

                $q->where(function ($q) use ($term) {
                    // colunas locais da tabela professores
                    $q->whereAny(['cpf', 'departamento', 'nome', 'saldo_moedas'], 'like', $term)

                    // colunas do relacionamento user()
                    ->orWhereRelation('empresa.user', 'name', 'like', $term)
                    ->orWhereRelation('user', 'email', 'like', $term)
                    ->orWhereRelation('user', 'name', 'like', $term);
                });
            })
            ->orderBy(...array_values($this->sort))
            ->withAggregate('user', 'name')
            ->paginate($this->quantity)
            ->withQueryString();
    }

    function mask_cpf(?string $cpf): ?string
    {
        if ($cpf === null) {
            return null;
        }

        // Remove qualquer não-dígito
        $digits = preg_replace('/\D/', '', $cpf);

        // Se não tem 11 dígitos, retorna original (ou vazio)
        if (strlen($digits) !== 11) {
            return $cpf;
        }

        return substr($digits, 0, 3) . '.' .
               substr($digits, 3, 3) . '.' .
               substr($digits, 6, 3) . '-' .
               substr($digits, 9, 2);
    }
}
