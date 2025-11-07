<div>
    <div class="mt-20 grid gap-3">
        <p class="font-bold text-center text-5xl">Validação de Código de Resgate</p>
        <p class="text-neutral-500 text-xl text-center">Digite o código para visualizar os detalhes da vantagem</p>
    </div>

    <div class="mt-10">
        <x-card class="grid gap-5">
            <div class="p-5 grid gap-5">
                <div class="grid gap-1">
                    <p class="text-3xl font-semibold">Código de resgate</p>
                    <p class="text-xl text-neutral-500">insira o código fornecido para validação</p>
                </div>
    
                <div class="grid grid-cols-[65%_30%] gap-3 justify-between items-start">
                    <x-input wire:model="codigo_resgate" />
                    <x-button icon="magnifying-glass" position="left" wire:click="search">Buscar</x-button>
                </div>
            </div>
        </x-card>
    </div>

    @if ($resgate)
        <div class="mt-10 mb-20">
            <div class="hover:shadow-card-hover transition-all duration-300 hover:scale-[1.02]">
                <x-card>
                    <div class="flex justify-center">
                        <img class="w-[300px] h-[300px]" src="{{asset('storage/' . $resgate->vantagem->foto) }}" alt="foto" >
                    </div>
                    <div class="grid gap-5">
                        <div class="flex items-center text-orange-500 gap-1">
                            <x-icon name="currency-dollar" class="h-7 w-7" outline/>
                            <p class="text-3xl font-bold">{{$resgate->vantagem->valor}}</p>
                        </div>
        
                        <div>
                            <div class="flex justify-between">
                                <p class="text-2xl font-bold ">{{$resgate->vantagem->nome}}</p>
                                <x-badge 
                                    text="{{ $resgate->status == 1 ? 'Pendente' : 'Finalizada' }}" 
                                    icon="{{ $resgate->status == 1 ? 'clock' : 'check' }}" position="left" 
                                    color="{{ $resgate->status == 1 ? 'orange' : 'green' }}" 
                                />
                            </div>
                            <p class="text-neutral-600">{{$resgate->vantagem->descricao}}</p>
                        </div>
                        

                        <hr class="text-neutral-500">

                        <div class="grid gap-5">
                            <div class="flex text-lg font-semibold items-center gap-1 justify-between">
                                <p class="text-neutral-500">Aluno:</p>
                                <p class=" font-semibold">{{$resgate->aluno->user->name}}</p>
                            </div>
                            <hr class="text-neutral-500">
                            <div class="flex text-lg font-semibold items-center gap-1 justify-between">
                                <p class="text-neutral-500">Data da solicitação:</p>
                                <p class=" font-semibold">{{$resgate->created_at->format('d/m/Y - H:i')}}</p>
                            </div>
                            <hr class="text-neutral-500">
                            <div class="flex text-lg font-semibold items-center gap-1 justify-between">
                                <p class="text-neutral-500">Código</p>
                                <p class=" font-semibold text-orange-500">{{$resgate->codigo_resgate}}</p>
                            </div>
                        </div>
                    </div>
                    @if ($resgate->status == 1)
                    <div class="flex justify-end gap-4 mt-5">
                        <x-button icon="check" position="left" wire:click="finalizar" >Finalizar</x-button> 
                    </div>
                    @endif
                </x-card>
            </div>
        </div>
    @endif
</div>
