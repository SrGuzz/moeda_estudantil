<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f6f6f6;">
  <table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <td align="center" style="padding: 20px 0;">
        <!-- Container principal -->
        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 8px; overflow: hidden;">
          <!-- Cabeçalho -->
          <tr>
            <td align="center" bgcolor="#ff6900" style="padding: 20px; color: #ffffff; font-family: Arial, sans-serif; font-size: 24px;">
              Moeda Estudantil
            </td>
          </tr>
          <!-- Corpo do email -->
          <tr>
            <td style="padding: 40px 30px; font-family: Arial, sans-serif; font-size: 16px; color: #333333;">
              <h2 style="color: #ff6900; margin-top: 0;">Redefinir Senha</h2>
              <p>Olá,</p>
              <p>Você solicitou a redefinição da sua senha. Para criar uma nova senha, clique no botão abaixo:</p>
              <p style="text-align: center;">
                <a href="{{ $resetUrl }}" style="background-color: #ff6900; color: #ffffff; padding: 12px 20px; text-decoration: none; border-radius: 4px; display: inline-block;">
                  Redefinir Senha
                </a>
              </p>
              <p>Se você não solicitou essa alteração, por favor, ignore este email.</p>
              <p>Atenciosamente,<br>Equipe Portal DTIC</p>
            </td>
          </tr>
          <!-- Rodapé -->
          <tr>
            <td bgcolor="#eeeeee" style="padding: 20px; text-align: center; font-family: Arial, sans-serif; font-size: 12px; color: #777777;">
              &copy; {{ date('Y') }} Moeda Estudantil. Todos os direitos reservados.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
