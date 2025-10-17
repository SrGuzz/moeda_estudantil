<div>
    <div class="flex justify-end">
        <x-button :text="'Criar Aluno'" wire:click="$toggle('modal')" sm />
    </div>

    <x-modal :title="'Criar Aluno'" wire x-on:open="setTimeout(() => $refs.name.focus(), 250)">
        <form id="user-create" wire:submit="save" class="space-y-4">
            <div>
                <x-input label="{{ __('Nome') }} *" x-ref="name" wire:model="user.name" required />
            </div>

            <div>
                <x-input label="{{ __('Email') }} *" wire:model="user.email" required />
            </div>
            
            <div>
                <x-input label="{{ __('RG') }} *" wire:model="aluno.rg" required />
            </div>

            <div>
                <x-input label="{{ __('Intituição') }} *" wire:model="aluno.instituicao" required />
            </div>

            <div>
                <x-input label="{{ __('Curso') }} *" wire:model="aluno.curso" required />
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
            <x-button type="submit" form="user-create">
                @lang('Save')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
