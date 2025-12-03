<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <body class="font-sans text-gray-900 antialiased">

        <div class="min-h-screen grid grid-cols-2 sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="hidden lg:flex lg:w-full h-full relative overflow-hidden">
                <div 
                    class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url({{ asset('/assets/images/bg-login.jpg'); }})">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-orange-400/80 to-orange-400/70"> </div>
                <div class="relative z-10 w-full flex flex-col justify-center items-center text-white p-12">
                    <div class="max-w-md text-center space-y-6">
                        <h1 class="text-4xl font-bold leading-tight">
                            Bem-vindo à Moeda Estudantil
                        </h1>
                        <p class="text-lg text-white/90">
                            Sistema peer-to-peer descentralizado para transações estudantis
                        </p>
                    </div>
                </div>
            </div>
            <div class="grid justify-center items-center">
                <div class="mt-6 px-6 py-4 bg-white shadow-md sm:rounded-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
