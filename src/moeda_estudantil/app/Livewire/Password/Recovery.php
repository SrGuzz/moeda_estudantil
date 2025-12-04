<?php

namespace App\Livewire\Password;

use App\Models\User;
use Illuminate\Support\Facades\{DB, Hash};
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\{Layout, Title};
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Recovery extends Component
{
    use Interactions;

    public string $token;

    public string $email = '';

    public string $password = '';

    public string $confirm_password = '';

    public $recaptcha;

    #[Layout('layouts.guest')]
    #[Title('Nova Senha')]
    public function render()
    {
        return view('livewire.password.recovery');
    }

    public function mount($token)
    {
        $this->token = $token;
        $this->email =  DB::table('password_reset_tokens')->where('token', $token)->first()->email ?? '';
    }

    public function save()
    {
        try {
            $this->validate();

            $record = DB::table('password_reset_tokens')
                ->where('email', $this->email)
                ->where('token', $this->token)
                ->first();

            if (!$record) 
            {
                return $this->addError('email', 'Token inválido ou expirado.');
            }

            // Atualize a senha do usuário
            $user = User::where('email', $this->email)->first();

            if ($user) 
            {
                $user->password = Hash::make($this->password);
                $user->save();

                // Remova o token da tabela (opcional)
                DB::table('password_reset_tokens')->where('email', $this->email)->delete();

                $this->toast()->success(
                    'Senha alterada com sucesso!!'
                );

                return redirect()->route('login');
            } 
            else 
            {
                $this->addError('email', 'Email não encontrado.');
            }
        } catch (\Exception $e) {
            $this->toast()->error(
                'Erro ao salvar, por gentileza entre em contato com o time de TI',
            );
        }
    }

    public function rules()
    {
        return [
            'email'    => 'required|email:rfc,dns',
            'password' => [
                'required',
                'min:8',
                'string',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'confirm_password' => 'required|same:password',
        ];
    }
}
