<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;


class Login extends Component
{   

    public $users;
    public $name;
    public $email;
    public $password;

    public function mount() {
        $default = User::latest()->get();
        $this->users = $default;
    }

    public function register() {
        
        $this->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6'

        ]);

        $createdUser = User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>bcrypt($this->password)

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
