<div>
    
        <div class="mb-2 mt-4 flex gap-x-5 justify-between items-end">
            <div>
                <p class="text-3xl font-semibold dark:text-neutral-50">Empresas Cadastradas</p>
                <p class="text-neutral-500">Total de {{count($this->empresas)}} empresas cadastradas</p>
            </div>
            <div class="flex items-end gap-5">
                <livewire:empresas.create @created="$refresh" />
                <x-input class="" icon="magnifying-glass" position="right" wire:model.live.debounce="search"/>
            </div>
        </div>

        <div class="grid grid-cols-2 mt-10 gap-10">
            @foreach($this->empresas as $empresa)
                <div class="hover:shadow-card-hover transition-all duration-300 hover:scale-[1.02]">
                    <x-card >
                        <div class="grid gap-y-5">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <x-avatar class="mr-5" color="orange" borderless />
                                    <div>
                                        <p class="text-xl font-bold">{{$empresa->nome}}</p>
                                        <div class="text-neutral-500 flex gap-x-2">
                                            <x-icon name="envelope" class="h-5 w-5" outline/>
                                            <p>{{$empresa->email}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <x-badge text="{{preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $empresa->cnpj)}}" icon="document-text" position="left" color="orange" light />
                                </div>
                            </div>

                            <hr class="text-neutral-300">

                            <div class="flex gap-x-4">
                                <x-icon name="map-pin" class="h-6 w-6 text-orange-400" outline/>
                                <div>
                                    <p>{{$empresa->endereco->rua . ', ' . $empresa->endereco->numero . ' - ' . $empresa->endereco->complemento}}</p>
                                    <p class="text-neutral-500">{{$empresa->endereco->bairro . ', ' . $empresa->endereco->cidade . ' - ' . $empresa->endereco->estado}}</p>
                                    <x-badge text="{{'CEP: ' . $empresa->endereco->cep}}" color="neutral" light />
                                </div>
                            </div>

                            <hr class="text-neutral-300">

                            <div class="flex justify-end gap-4">
                                <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::empresa', { 'empresa' : '{{ $empresa->id }}'})" light/>
                                <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::empresa', { 'empresa' : '{{ $empresa->id }}'})" light/>
                            </div>
                        </div>
                    </x-card>
                </div>
            @endforeach
        </div>

        {{-- <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter loading :quantity="[2, 5, 15, 25]">
            @interact('column_created_at', $row)
            {{ $row->created_at->diffForHumans() }}
            @endinteract

            @interact('column_action', $row)
            <div class="flex gap-4 justify-end">
                <x-button.circle color="yellow" icon="pencil" wire:click="$dispatch('load::empresa', { 'empresa' : '{{ $row->id }}'})" light/>
                <x-button.circle color="red" icon="trash" wire:click="$dispatch('delete::empresa', { 'empresa' : '{{ $row->id }}'})" light/>
            </div>
            @endinteract
        </x-table> --}}


    <livewire:empresas.update @updated="$refresh" />
    <livewire:empresas.delete @deleted="$refresh" />
</div>
