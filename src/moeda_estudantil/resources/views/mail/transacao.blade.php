@component('mail::message')
# 💸 Transação Realizada com Sucesso

Olá, **{{ $transacao['destinatario'] }}**!

Uma nova transação foi registrada no sistema.

@component('mail::panel')
**📅 Data:** {{ $transacao['data'] }}  
**👨‍🏫 Professor:** {{ $transacao['professor'] }}  
**🎓 Aluno:** {{ $transacao['aluno'] }}  
**💰 Valor:** R$ {{ $transacao['moedas'] }}
@endcomponent

@if ($transacao['tipo'] === 'enviada')
Essa transação foi **enviada** por você (professor).  
O valor foi transferido com sucesso para o aluno **{{ $transacao['aluno'] }}**.
@else
Você **recebeu** uma transação de **{{ $transacao['professor'] }}**.  
O valor já está disponível no seu saldo.
@endif

Obrigado por usar nosso sistema!  
**{{ config('app.name') }}**
@endcomponent
