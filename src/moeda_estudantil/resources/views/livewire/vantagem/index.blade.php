<div>
    <div class="mb-2 mt-4 flex gap-x-5 justify-between items-end">
        <div>
            <p class="text-3xl font-semibold dark:text-neutral-50">Vantagens Cadastradas</p>
            <p class="text-neutral-500">Total de {{count($this->vantagens)}} vantagem cadastradas</p>
        </div>
        <div class="flex items-end gap-5">
            @if (auth()->user()->empresa)
                <livewire:vantagem.create @created="$refresh" />
            @endif
            <x-input class="" icon="magnifying-glass" position="right" wire:model.live.debounce="search"/>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 mt-10 gap-10">
        @foreach($this->vantagens as $vantagem)
            <div class="hover:shadow-card-hover transition-all duration-300 hover:scale-[1.02]">
                <x-card>
                    <div class="flex justify-center">
                        <img class="w-[300px] h-[300px]" src="{{asset('storage/' . $vantagem->foto) }}" alt="foto" >
                    </div>
                    <div class="grid gap-5">
                        <div class="flex items-center text-orange-500 gap-1">
                            <x-icon name="currency-dollar" class="h-7 w-7" outline/>
                            <p class="text-3xl font-bold">{{$vantagem->valor}}</p>
                        </div>
        
                        <div>
                            <p class="text-2xl font-bold ">{{$vantagem->nome}}</p>
                            <p class="text-neutral-600">{{$vantagem->descricao}}</p>
                        </div>
                        
    
                        <hr class="text-neutral-500">
    
                        <div class="grid gap-2">
                            <div class="flex items-center gap-1">
                                <x-icon name="building-office-2" class="text-orange-500 h-5 w-5" outline/>
                                <p class=" font-semibold">{{$vantagem->empresa->user->name}}</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <x-icon name="envelope" class="h-5 w-5 text-neutral-500" outline/>
                                <p class="text-neutral-500">{{$vantagem->empresa->user->email}}</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <x-icon name="identification" class="text-neutral-500 h-5 w-5" outline/>
                                <p class="text-neutral-500">{{$this->mask_cnpj($vantagem->empresa->cnpj)}}</p>
                            </div>
                            <div class="flex items-center gap-1">
                                <x-icon name="map-pin" class="text-neutral-500 h-5 w-5" outline/>
                                <p class="text-neutral-500">{{"{$vantagem->empresa->endereco->rua}, {$vantagem->empresa->endereco->numero} - {$vantagem->empresa->endereco->cidade}/{$vantagem->empresa->endereco->estado}"}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-5">
                        @if (auth()->user()->empresa)
                            <x-button color="yellow" icon="pencil" wire:click="$dispatch('load::vantagem', { 'vantagem' : '{{ $vantagem->id }}'})" light>Editar</x-button>
                        @else
                            <x-button icon="banknotes" position="left" wire:click="comprar({{$vantagem->id}})">Comprar</x-button>    
                        @endif
                        
                    </div>
                </x-card>
            </div>
        @endforeach
    </div>

    <livewire:vantagem.update @updated="$refresh" />
</div>
