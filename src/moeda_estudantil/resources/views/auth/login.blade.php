<x-guest-layout>
    <div class="w-[500px]">
        <div class="my-6 grid items-center justify-center ">
            <img src="{{ asset('/assets/images/logo.png') }}" class="w-[200px] m-auto mb-3"/>
            <h2 class="text-2xl text-center font-bold text-foreground">Entrar na plataforma</h2>
            <p class="text-muted-foreground text-center">Digite suas credenciais para acessar</p>
        </div>
    
        <form method="POST" action="{{ route('login') }}">
            @csrf
    
            <div class="space-y-8">
                <x-input class="h-13" style="font-size: larger;" label="Email *" type="email" name="email" :value="old('email', 'test@example.com')" required autofocus autocomplete="username" />
    
                <x-password class="h-13" style="font-size: larger;" label="Senha *" type="password" name="password" required autocomplete="current-password" />
            </div>
    
            <div class="flex justify-between my-8">
                <x-checkbox label="Lebrar-me" id="remember_me" color="orange" type="checkbox" name="remember" />
                @if (Route::has('register'))
                    <a class="text-sm text-orange-400 hover:text-orange-800 rounded-md" href="{{ route('reset-password') }}">
                        Esqueceu a senha?
                    </a>
                @endif
            </div>
    
            <div class="">
                <x-button type="submit" class="w-full" color="orange">
                    Entrar
                </x-button>
            </div>

            <div class="text-center my-5 text-lg text-muted-foreground">
                Não tem uma conta? 
                <a href="#" class="text-orange-400 font-semibold">
                Cadastre-se
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
