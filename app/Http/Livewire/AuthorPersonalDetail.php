<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class AuthorPersonalDetail extends Component
{
    public function render()
    {
        return view('livewire.author-personal-detail');
    }

    public $author, $name, $username, $email, $bio;

    public function mount()
    {
        $this->author = User::find(auth('web')->id());
        $this->name = $this->author->name;
        $this->username = $this->author->username;
        $this->email = $this->author->email;
        $this->bio = $this->author->bio;
    }

    public function UpdateDetails()
    {
        $this->validate([
            'name' => 'required|string',
            'username' => 'required|unique:users,username,'.auth('web')->id()
        ]);

        User::find(auth()->id())->update([
            'name' => $this->name,
            'username' => $this->username,
            'bio' => $this->bio,
        ]);
        $this->emit('updateAuthorProfileHeader');
        $this->emit('updateTopHeader');
        $this->showToastr('info','Your profile has been successfully updated');
    }

    public function showToastr($type, $message)
    {
        return $this->dispatchBrowserEvent('showToastr', [
            'type' => $type,
            'message' => $message
        ]);
    }
}
