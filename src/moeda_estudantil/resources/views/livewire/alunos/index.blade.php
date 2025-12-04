<div>
    <div class="mb-2 mt-4 flex gap-x-5 justify-between items-end">
        <div>
            <p class="text-3xl font-semibold dark:text-neutral-50">Alunos Cadastrados</p>
            <p class="text-neutral-500">Total de {{count($this->alunos)}} alunos cadastrados</p>
        </div>
        <div class="flex items-end gap-5">
            <livewire:alunos.create @created="$refresh" />
            <x-input class="" icon="magnifying-glass" position="right" wire:model.live.debounce="search"/>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 mt-10 gap-10">
        @foreach($this->alunos as $aluno)
            <div class="hover:shadow-card-hover transition-all duration-300 hover:scale-[1.02]">
                <x-card >
                    <div class="grid gap-y-5">
                        <div class="grid gap-5">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <x-avatar class="mr-5" color="orange" borderless />
                                    <div>
                                        <p class="text-xl font-bold">{{$aluno->user->name}}</p>
                                        <div class="text-neutral-500 flex gap-x-2">
                                            <x-icon name="envelope" class="h-5 w-5" outline/>
                                            <p>{{$aluno->user->email}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <x-badge text="{{$aluno->rg}}" icon="identification" position="left" color="orange" light />
                                </div>
                            </div>

                            <div class="flex justify-between bg-orange-100/80 dark:bg-neutral-900 py-5 rounded-md">
                                <div class="flex gap-4 ml-3">
                                    <x-icon name="currency-dollar" class="h-8 w-8 text-orange-500" outline/>
                                    <p class="text-xl text-neutral-500 dark:text-white font-semibold">Saldo</p>
                                </div>
                                <div class="mr-3">
                                    <p class="bg-orange-500 px-5 py-1 rounded-3xl font-bold text-neutral-50">{{$aluno->saldo_moedas}}</p>
                                </div>
                            </div>
                        </div>
    
                        <hr class="text-neutral-300">
                        
                        <div class="flex gap-x-4 items-center">
                            <x-icon name="building-office-2" class="h-6 w-6 text-orange-500" />
                            <div>
                                <p class="font-bold">{{$aluno->instituicao}}</p>
                                <div class="flex gap-x-1">
                                    <x-icon name="academic-cap" class="h-5 w-5 text-orange-400" outline/>
                                    <p class="text-neutral-500">{{$aluno->curso}}</p>
                                </div>
                            </div>
                        </div>
    
                        <hr class="text-neutral-300">
                        
                        <div class="flex gap-x-4">
                            <x-icon name="map-pin" class="h-6 w-6 text-orange-400" outline/>
                            <div>
                                <p>{{$aluno->endereco->rua . ', ' . $aluno->endereco->numero . ' - ' . $aluno->endereco->complemento}}</p>
                                <p class="text-neutral-500">{{$aluno->endereco->bairro . ', ' . $aluno->endereco->cidade . ' - ' . $aluno->endereco->estado}}</p>
                                <x-badge text="{{'CEP: ' . $aluno->endereco->cep}}" color="neutral" light />
                            </div>
                        </div>  
    
                        <hr class="text-neutral-300">
                        
                        <div class="flex justify-end gap-4">
                            @if (auth()->user()->professor)
                            <x-button.circle color="green" icon="banknotes" wire:click="$dispatch('transacao::aluno', { 'aluno' : '{{ $aluno->id }}'})" light/>    
                            @endif
                            <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::aluno', { 'aluno' : '{{ $aluno->id }}'})" light/>
                            <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::aluno', { 'aluno' : '{{ $aluno->id }}'})" light/>
                        </div>
                    </div>
                </x-card>
            </div>
        @endforeach
    </div>

    <livewire:alunos.update @updated="$refresh" />
    <livewire:alunos.delete @deleted="$refresh" />
    <livewire:alunos.transacao @updated="$refresh" />
</div>
