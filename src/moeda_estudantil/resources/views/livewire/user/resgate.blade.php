<div>
    <p class="font-bold text-4xl text-neutral-800 dark:text-white">Historico de Resgates</p>
    <p class="mb-5 text-xl text-neutral-500">Visualize todas os seus resgates</p>
    <div class="grid grid-cols-3 gap-5">
        <x-card>
            <p class="text-neutral-500 font-semibold">Valor Total</p>
            <div class="flex justify-between items-center">
                <div class="flex gap-2 items-end">
                    <p class="font-bold text-4xl">{{$this->soma_valor($this->resgates)}}</p>
                    <p class="text-neutral-500">moedas</p>
                </div>
                <div class="p-3 rounded-full bg-orange-500">
                    <x-icon name="banknotes" class="text-white h-6 w-6"/>
                </div>
            </div>    
        </x-card>
        <x-card>
            <p class="text-neutral-500 font-semibold">Total de Resgates</p>
            <div class="flex justify-between items-center">
                <div class="flex gap-2 items-end">
                    <p class="font-bold text-4xl">{{count($this->resgates)}}</p>
                    <p class="text-neutral-500">transações</p>
                </div>
                <div class="p-3 rounded-full bg-orange-500">
                    <x-icon name="arrow-trending-up" class="text-white h-6 w-6"/>
                </div>
            </div>    
        </x-card>
        <x-card>
            <p class="text-neutral-500 font-semibold">Resgates no Semestre</p>
            <div class="flex justify-between items-center">
                <div class="flex gap-2 items-end">
                    <p class="font-bold text-4xl">{{$this->resgates_semestre($this->resgates)}}</p>
                    <p class="text-neutral-500">resgates</p>
                </div>
                <div class="p-3 rounded-full bg-orange-500">
                    <x-icon name="academic-cap" class="text-white h-6 w-6"/>
                </div>
            </div>    
        </x-card>
    </div>
    <div class="mt-5">
        <x-card>
            <x-table :$headers :$sort :rows="$this->rows" paginate simple-pagination filter loading :quantity="[2, 5, 15, 25]">
                @interact('column_created_at', $row)
                {{ $row->created_at->format('d/m/Y H:i') }}
                @endinteract
            </x-table>
        </x-card>
    </div>
</div>
