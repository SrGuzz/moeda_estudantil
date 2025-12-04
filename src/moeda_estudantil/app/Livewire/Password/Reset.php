<?php

namespace App\Livewire\Password;

use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\{DB, Mail};
use Illuminate\Support\Str;
use Livewire\Attributes\{Layout, Title};
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class Reset extends Component
{
    use Interactions;

    public $status = false;

    public ?string $email;

    #[Layout('layouts.guest')]
    #[Title('Restaurar Senha')]
    public function render()
    {
        return view('livewire.password.reset');
    }

    public function resetPassword()
    {
        $this->validate();
        
        try {

            $user = User::where('email', $this->email)->first();

            if (!$user) {
                return $this->addError('email', trans('auth.failed'));
            }

            $token = Str::random(60);

            DB::table('password_reset_tokens')->updateOrInsert(
                [
                    'email' => $this->email,
                ],
                [
                    'token'      => $token,
                    'created_at' => Carbon::now(),
                ]
            );

            Mail::to($this->email)->send(new ResetPassword($token, $this->email));
            $this->status = 'Um email foi enviado para redefinir sua senha.';
        } 
        catch (\Exception $e) 
        {
            $this->toast()->error(
                'Opss!',
                'Erro ao salvar, por gentileza entre em contato com o time de TI',
            );
        }
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}
