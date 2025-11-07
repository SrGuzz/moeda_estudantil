<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="tallstackui_darkTheme()">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <tallstackui:script />
        @livewireStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased"
          x-cloak
          x-data="{ name: @js(auth()->user()->name) }"
          x-on:name-updated.window="name = $event.detail.name"
          x-bind:class="{ 'dark bg-neutral-950': darkTheme, 'bg-neutral-50': !darkTheme }">
    <x-layout>
        <x-slot:top>
            <x-dialog />
            <x-toast />
        </x-slot:top>
        <x-slot:header>
            <x-layout.header>
                <x-slot:left>
                    <x-theme-switch />
                </x-slot:left>
                <x-slot:right>
                    <x-dropdown>
                        <x-slot:action>
                            <div>
                                <button x-on:click="show = !show"><x-avatar class="cursor-pointer hover:bg-orange-500/80" text="{{Str::upper(substr(auth()->user()->name, 0, 2))}}" color="orange" /></button>
                            </div>
                        </x-slot:action>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown.items :text="__('Profile')" :href="route('user.profile')" />
                            @if (auth()->user()->aluno)
                            <x-dropdown.items :text="__('Resgates')" :href="route('user.resgates')" separator/>
                            @endif
                            <x-dropdown.items :text="__('Logout')" onclick="event.preventDefault(); this.closest('form').submit();" separator />
                        </form>
                    </x-dropdown>
                </x-slot:right>
            </x-layout.header>
        </x-slot:header>
        <x-slot:menu>
            <x-side-bar smart collapsible>
                <x-slot:brand>
                    <div class="mt-8 flex items-center justify-center">
                        <img src="{{ asset('/assets/images/logo.png') }}" width="200" height="200" />
                    </div>
                </x-slot:brand>
                <x-side-bar.item text="Alunos" icon="users" :route="route('alunos.index')" />
                <x-side-bar.item text="Empresas Parceiras" icon="building-office-2" :route="route('empresas.index')" />
                <x-side-bar.item text="Professores" icon="academic-cap" :route="route('professores.index')" />
                <x-side-bar.item text="Transacoes" icon="clock" :route="route('transacoes.index')" />
                @if (auth()->user()->aluno || auth()->user()->empresa)
                <x-side-bar.item text="Loja" icon="shopping-bag" :route="route('vantagens.index')" />
                @endif
            </x-side-bar>
        </x-slot:menu>
        {{ $slot }}
    </x-layout>
    @livewireScripts
    </body>
</html>
