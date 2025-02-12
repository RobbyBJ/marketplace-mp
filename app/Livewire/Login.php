<?php

namespace App\Livewire;

use Livewire\Component;

class Login extends Component
{   

    public $users;
    public $name;
    public $email;
    public $password;

    public function register() {
        $this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6|confirmed'

        ]);

        $createdUser = User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password

        ]);

        $this->users->prepend($createdUser);
        $this->description = "";
        session()->flash('message', 'User added successfully!');

    }

    public function render()
    {
        return view('livewire.login');
    }
}
