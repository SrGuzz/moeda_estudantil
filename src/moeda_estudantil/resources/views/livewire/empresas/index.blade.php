<div>
    <x-card>
        <div class="mb-2 mt-4">
            <livewire:empresas.create @created="$refresh" />
        </div>

        <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter loading :quantity="[2, 5, 15, 25]">
            @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
            @endinteract

            @interact('column_action', $row)
            <div class="flex gap-4 justify-end">
                <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::empresa', { 'empresa' : '{{ $row->id }}'})" light/>
                <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::empresa', { 'empresa' : '{{ $row->id }}'})" light/>
            </div>
            @endinteract
        </x-table>
    </x-card>

    <livewire:empresas.update @updated="$refresh" />
    <livewire:empresas.delete @deleted="$refresh" />
</div>
