<div>
    <div class="mb-2 mt-4 flex gap-x-5 justify-between items-end">
        <div>
            <p class="text-3xl font-semibold dark:text-neutral-50">Professores Cadastrados</p>
            <p class="text-neutral-500">Total de {{count($this->professores)}} professores cadastrados</p>
        </div>
        <div class="flex items-end gap-5">
            <livewire:professores.create @created="$refresh" />
            <x-input class="" icon="magnifying-glass" position="right" wire:model.live.debounce="search"/>
        </div>
    </div>

    <div class="grid grid-cols-2 mt-10 gap-10">
        @foreach($this->professores as $professor)
            <div class="hover:shadow-card-hover transition-all duration-300 hover:scale-[1.02]">
                <x-card >
                    <div class="grid gap-y-5">
                        <div class="grid gap-5">
                            <div class="flex">
                                <x-avatar class="mr-5" color="orange" borderless />
                                <div>
                                    <p class="text-xl font-bold">{{$professor->user->name}}</p>
                                    <div class="text-neutral-500 flex gap-x-2">
                                        <x-icon name="identification" class="h-5 w-5" outline/>
                                        <p>{{$this->mask_cpf($professor->cpf)}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between bg-orange-100/80 py-5 rounded-md">
                                <div class="flex gap-4 ml-3">
                                    <x-icon name="currency-dollar" class="h-8 w-8 text-orange-500" outline/>
                                    <p class="text-xl text-neutral-500 font-semibold">Saldo</p>
                                </div>
                                <div class="mr-3">
                                    <p class="bg-orange-500 px-5 py-1 rounded-3xl font-bold text-neutral-50">{{$professor->saldo_moedas}}</p>
                                </div>
                            </div>
                        </div>
    
                        <hr class="text-neutral-300">

                        <div class="grid gap-5">
                            <div class="flex gap-x-4 items-center">
                                <x-icon name="briefcase" class="h-6 w-6" outline/>
                                <div>
                                    <p class="text-neutral-500 ">Departamento</p>
                                    <div class="flex gap-x-1">
                                        <p class="font-semibold">{{$professor->departamento}}</p>
                                    </div>
                                </div>
                            </div> 
                            <div class="flex gap-x-4 items-center">
                                <x-icon name="building-office-2" class="h-6 w-6" outline/>
                                <div>
                                    <p class="text-neutral-500 ">Empresa</p>
                                    <div class="flex gap-x-1">
                                        <p class="font-semibold">{{$professor->empresa->nome}}</p>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        
    
                        <hr class="text-neutral-300">
                        
                        <div class="flex justify-end gap-4">
                            <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::professor', { 'professor' : '{{ $professor->id }}'})" light/>
                            <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::professor', { 'professor' : '{{ $professor->id }}'})" light/>
                        </div>
                    </div>
                </x-card>
            </div>
        @endforeach
    </div>
    <livewire:professores.update @updated="$refresh" />
    <livewire:professores.delete @deleted="$refresh" />
</div>
