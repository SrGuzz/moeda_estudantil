@component('mail::message')
# 🎉 Vantagem Resgatada!

Olá **{{ $resgate['empresa'] }}**,  

Temos uma ótima notícia!  
O aluno **{{ $resgate['aluno'] }}** resgatou uma de suas vantagens disponibilizadas no sistema **Moeda Estudantil**.  
Confira os detalhes abaixo:

---

### 🏷️ {{ $resgate['vantagem'] }}
**Descrição:** {{ $resgate['descricao'] }}

**Aluno:** {{ $resgate['aluno'] }}  
**Valor do Cupom:** {{ $resgate['valor'] }}  
**Data do Resgate:** {{ \Carbon\Carbon::createFromFormat('d/m/Y H:i', $resgate['data']) }}

@component('mail::panel')
**Código de Resgate:** {{ $resgate['codigo_resgate'] }}
@endcomponent

---

📢 Este código confirma que o aluno realizou o resgate da vantagem.  
Para validar o cupom clique [Aqui]($resgate['url']).  


Atenciosamente,  
**Equipe Moeda Estudantil**  
📩 *Este é um e-mail automático. Não responda diretamente.*

@endcomponent
