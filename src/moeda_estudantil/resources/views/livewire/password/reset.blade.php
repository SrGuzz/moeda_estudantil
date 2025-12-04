<div class="w-[500px]">
    <div class="my-6 grid items-center justify-center ">
        <img src="{{ asset('/assets/images/logo.png') }}" class="w-[200px] m-auto mb-3"/>
        <h2 class="text-2xl text-center font-bold text-foreground">Recuperar Senha</h2>
        <p class="text-muted-foreground text-center">Digite seu email para recuperação</p>
    </div>
    <form wire:submit.prevent="resetPassword" class="grid gap-6">

        <x-input 
            label="Email" 
            icon="envelope" 
            wire:model.defer="email"
            hint="Um link de redefinição de senha sera enviado ao email sugerido"
            class="h-10"
        />

        <div>
            <x-button type="submit" class="w-full" color="orange">
                Enviar
            </x-button>
        </div>

        @if($status)
            <div class="bg-green-100 text-green-700 p-2 my-4">
                {{ $status }}
            </div>
        @endif
    </form>
</div>
