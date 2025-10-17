<div>
    <x-card>
        <div class="mb-2 mt-4">
            <livewire:alunos.create @created="$refresh" />
        </div>

        <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter loading :quantity="[2, 5, 15, 25]">
            @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
            @endinteract

            @interact('column_action', $row)
            <div class="flex gap-4">
                <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::aluno', { 'aluno' : '{{ $row->id }}'})" light/>
                <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::aluno', { 'aluno' : '{{ $row->id }}'})" light/>
            </div>
            @endinteract
        </x-table>
    </x-card>

    <livewire:alunos.update @updated="$refresh" />
    <livewire:alunos.delete @deleted="$refresh" />
</div>
