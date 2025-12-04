<div class="w-[500px]">
    <div class="my-6 grid items-center justify-center ">
        <img src="{{ asset('/assets/images/logo.png') }}" class="w-[200px] m-auto mb-3"/>
        <h2 class="text-2xl text-center font-bold text-foreground">Recuperar Senha</h2>
        <p class="text-muted-foreground text-center">Digite sua nova senha </p>
    </div>
    <form wire:submit.prevent="save" class="grid gap-6">

        <x-input 
            class="h-13" 
            style="font-size: larger;"
            label="Email" 
            icon="envelope" 
            wire:model.defer="email"
        />

        <x-password 
            class="h-13" 
            style="font-size: larger;"
            label="Senha" 
            hint="Deve conter maisculas, minusculas e ao menos um caracter especial" 
            wire:model="password" 
        />

        <x-password 
            class="h-13" 
            style="font-size: larger;"
            label="Confirmar senha" 
            wire:model="confirm_password" 
        />

        <div>
                <x-button type="submit" class="w-full" color="orange">
                Confirmar
            </x-button>
        </div>
    </form>
</div>
