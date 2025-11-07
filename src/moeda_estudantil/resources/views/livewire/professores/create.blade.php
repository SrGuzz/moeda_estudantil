<div>
    
    <x-button class="!py-1.5" :text="'Criar Professor'" wire:click="$toggle('modal')" />

    <x-modal :title="'Criar Professor'" wire x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="professor-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Nome') }} *" x-ref="name" wire:model="user.name" required />
            </div>

            <div class="grid gap-5 md:grid-cols-2 grid-cols-1">
                <x-input label="{{ __('Email') }} *" wire:model="user.email" required />
                <x-input label="{{ __('CPF') }} *" wire:model="professor.cpf" required />
                <x-input label="{{ __('Departamento') }} *" wire:model="professor.departamento" required />
                <x-select.styled  :options="$empresas" wire:model="professor.empresa_id"  required  label="Empresa"/>
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
            
        </form>
        <x-slot:footer>
            <x-button type="submit" form="professor-create" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
