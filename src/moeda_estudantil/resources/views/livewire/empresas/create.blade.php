<div>
    <div class="flex justify-end">
        <x-button class="!py-1.5" :text="'Criar Empresa'" wire:click="$toggle('modal')" />
    </div>

    <x-modal :title="'Dados da Empresa'" wire x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="empresa-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Nome') }} *" x-ref="name" wire:model="user.name" required />
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-input label="Email *" wire:model="user.email" required />
                
                <x-input label="CNPJ *" wire:model="empresa.cnpj" required x-mask="99999999999999"/>
            </div>

            <div>
                <x-password label="{{ __('Senha') }} *"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)"
                            required />
            </div>

            <div>
                <x-password :label="__('Confirmar Senha')" wire:model="password_confirmation" rules required />
            </div>

            <hr class="text-neutral-200 mb-1.5">

            <div>
                <h1 class="font-semibold text-black dark:text-white">Endereco</h1>
            </div>

            <div class="w-1/2 grid pr-2.5">
                <x-input label="CEP" hint="Ex: 12345-678" x-mask="99999-999" wire:model.live="endereco.cep" clearable/>
            </div>

            <div class="grid grid-cols-2 gap-5">
                <x-input label="Estado" wire:model="endereco.estado" disabled />

                <x-input label="Cidade" wire:model="endereco.cidade" disabled />
                
                <x-input label="Bairro" wire:model="bairro" disabled />

                <x-input label="Rua" wire:model="endereco.rua" disabled />
                
                <x-input label="Numero" type="number" wire:model="endereco.numero" />
                
                <x-input label="Complemento" wire:model="endereco.complemento" />
            </div>

        </form>
        <x-slot:footer>
            <x-button type="submit" form="empresa-create" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
