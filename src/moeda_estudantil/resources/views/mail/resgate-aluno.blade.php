@component('mail::message')
# 🎁 Nova Vantagem Disponível!

Olá **{{ $resgate['aluno'] }}**,  

Você resgatou uma nova vantagem da empresa **{{ $resgate['empresa'] }}**!  
Confira os detalhes do seu cupom de resgate:

---

### 🛍️ {{ $resgate['vantagem'] }}
**Descrição:** {{ $resgate['descricao'] }}

**Empresa:** {{ $resgate['empresa'] }}  
**Valor do Cupom:** {{ $resgate['valor'] }}  
**Criado em:** {{ \Carbon\Carbon::parse($resgate['data'])->format('d/m/Y H:i') }}  

@component('mail::panel')
**Codigo de Resgate:** {{$resgate['codigo_resgate']}}
@endcomponent

---

Atenciosamente,  
**Equipe Moeda Estudantil**  
  
📩 *Este é um e-mail automático. Não responda diretamente.*

@endcomponent
