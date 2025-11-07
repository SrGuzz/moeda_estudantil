<div>
    <x-modal :title="__('Atualizar Professor', ['id' => $vantagem?->id])" wire>
        <form id="vantagem-update-{{ $vantagem?->id }}" wire:submit="save" class="space-y-4">
            <div>
                <x-upload accept="image/*" wire:model="foto" label="Foto *" close-after-upload/>
            </div>

            <div class="grid gap-5 md:grid-cols-2 grid-cols-1">
                 <x-input label="{{ __('Nome') }} *" x-ref="name" wire:model="vantagem.nome" required />
                 <x-number label="Valor *" min="1" wire:model="vantagem.valor" />
            </div>

            <div>
                <x-textarea label="Descrição *" resize-auto wire:model="vantagem.descricao" />
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="vantagem-update-{{ $vantagem?->id }}" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
