<div>
    <x-modal :title="__('Enviar Moedas', ['id' => $aluno?->id])" wire>
        <form id="aluno-transacao-{{ $aluno?->id }}" wire:submit="save" class="space-y-4">
            
            <div class="grid gap-5 md:grid-cols-2 grid-cols-1">
                <x-input label="{{ __('Aluno') }}" value="{{$user->name ?? ''}}" disabled/>
                <x-input label="{{ __('Seu saldo') }}" value="{{auth()->user()->professor->saldo_moedas ?? ''}}" disabled/>
            </div>

            <div>
                <x-number label="Valor *" hint="Insira ate o valor do saldo disponivel" wire:model="transacao.moedas" min="1"/>
            </div>

            <div>
                <x-textarea label="Mensagem *" resize-auto count wire:model="transacao.mensagem "/>
            </div>

        </form>
        <x-slot:footer>
            <x-button type="submit" form="aluno-transacao-{{ $aluno?->id }}" loading="save">
                @lang('Salvar')
            </x-button>
        </x-slot:footer>
    </x-modal>
</div>
