<div>
    <x-modal :title="__('Atualizar Professor', ['id' => $professor?->id])" wire>
        <form id="professor-update-{{ $professor?->id }}" wire:submit="save" class="space-y-4">
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
                <x-password label="{{ __('Senha') }}"
                            wire:model="password"
                            rules
                            generator
                            x-on:generate="$wire.set('password_confirmation', $event.detail.password)"
                            />
            </div>

            <div>
                <x-password :label="__('Confirmar Senha')" wire:model="password_confirmation" rules />
            </div>
        </form>
        <x-slot:footer>
            <x-button type="submit" form="professor-update-{{ $professor?->id }}" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
