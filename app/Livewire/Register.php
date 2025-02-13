<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Register extends Component
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
                'password'=>Hash::make($this->password)
    
            ]);
    
            $this->users->prepend($createdUser);
            $this->reset(['name', 'email', 'password']);
            session()->flash('message', 'User added successfully!');
            redirect()->route('login')->with('success', 'Registration successful!');
    
    }
    public function render()
    {
        return view('livewire.register')->layout('layouts.app');
    }
}
