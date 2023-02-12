<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AuthorLoginForm extends Component
{
    public $password, $login_id;
    
    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldType == 'email') {
            $this->validate(
                [
                    'login_id' => 'required|email|exists:users,email',
                    'password' => 'required|min:5'
                ],
                [
                    'login_id' => 'Email address or username is required',
                    'login_id.email' => 'Invalid email address',
                    'login_id.exists' => 'This email is not registered',
                    'password.required' => 'Password is required'
                ]
            );
        } else {
            $this->validate(
                [
                    'login_id' => 'required|exists:users,username',
                    'password' => 'required|min:5'
                ],
                [
                    'login_id.required' => 'Email address or username is required',
                    'login_id.exists' => 'Username is not registered',
                    'password.required' => 'Password is required'
                ]
            );
        }

        $creds = array($fieldType => $this->login_id, 'password' => $this->password);

        if (Auth::guard('web')->attempt($creds)) {
            $checkEmailUsername = User::where($fieldType, $this->login_id)->first();
            if ($checkEmailUsername->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been blocked');
            } else {
                return redirect()->route('author.home');
            }
        } else {
            session()->flash('fail', 'Incorrect Email/Username or Password');
        }
        // $this->validate(
        //     [
        //         'email' => 'required|email|exists:users,email',
        //         'password' => 'required|min:5'
        //     ], 
        //     [
        //         'email.required' => 'Enter your email address',
        //         'email.email' => 'Invalid email address',
        //         'email.exists' => 'This email is not registered in database',
        //         'password.required' => 'Password is required'
        //     ]
        // );
        // $creds = array('email'=>$this->email, 'password'=>$this->password);
        // if (Auth::guard('web')->attempt($creds)) {
        //     $checkEmailUser = User::where('email', $this->email)->first();
        //     if ($checkEmailUser->blocked == 1) {
        //         Auth::guard('web')->logout();
        //         return redirect()->route('author.login')->with('fail', 'Your account has been blocked');
        //     } else {
        //         return redirect()->route('author.home');
        //     }
        // }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
