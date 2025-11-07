<x-guest-layout>
    <div class="my-6 flex items-center justify-center ">
        <img src="{{ asset('/assets/images/logo.png') }}" class="w-75"/>
    </div>

    <p class="text-3xl text-center font-semibold mb-5">Criar Aluno</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <x-step selected="1" helpers navigate-previous>
            <x-step.items step="1" title="Dados">
                <div>
                    <x-input label="Name *" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-input label="Email *" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-password label="Password *" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-password label="Confirm Password *" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </x-step.items>
            <x-step.items step="2" title="Endereço">
                <div class="mb-5">
                    <x-input label="CEP" hint="Ex: 12345-678" x-mask="99999-999" wire:model.live="endereco.cep" clearable/>
                </div>

                <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                    <x-input label="Estado" wire:model="endereco.estado" disabled />

                    <x-input label="Cidade" wire:model="endereco.cidade" disabled />
                    
                    <x-input label="Bairro" wire:model="bairro" disabled />

                    <x-input label="Rua" wire:model="endereco.rua" disabled />
                    
                    <x-input label="Numero" type="number" wire:model="endereco.numero" />
                    
                    <x-input label="Complemento" wire:model="endereco.complemento" />
                </div>
            </x-step.items>
            <x-slot:finish>
                <x-button type="submit" class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </x-slot:finish>
        </x-step>

        <div class="flex items-center justify-center mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
