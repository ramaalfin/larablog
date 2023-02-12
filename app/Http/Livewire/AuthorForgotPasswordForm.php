<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class AuthorForgotPasswordForm extends Component
{
    public $email;

    public function render()
    {
        return view('livewire.author-forgot-password-form');
    }

    public function forgotHandler()
    {
        $this->validate([
            'email' => "required|email|exists:users,email"
        ], [
            'email.required' => 'Enter your email address',
            'email.email' => 'Invalid email address',
            'email.exists' => 'This email is not registered',
        ]);

        $token = base64_encode(Str::random(64));

        DB::table('password_resets')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-password-form', ['token' => $token, 'email' => $this->email]);
        $body_message = "We are received a request to reset the password for <b>Larablog</b> account associated with ".$this->email.". <br> You can reset yout password by clicking the button below.";
        $body_message.='<br>';
        $body_message.='<a href="'. $link .'" target="_blank" style="color: #fff; border-color: #22bc66; border-style: solid; border-width: 10px 180px; background-color: #22bc66; display: inline-block; text-decoration: none; border-radius: 3px; box-sizing: border-box;">Reset Password</a>';
        $body_message.='<br>';
        $body_message.='If you did not request for a password reset, please ignore the email';

        $data = array('name' => $user->name, 'body_message' => $body_message);
        
        Mail::send('forgot-email-template', $data, function($message) use ($user) {
            $message->from('noreply@gmail.com', 'Larablog');
            $message->to($user->email, $user->name)->subject('Reset Password');
        });

        $this->email = null;
        session()->flash('success', 'We have e-mailed your password reset link');
    }
}
