<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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

    public function login() {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Login successful!');
        } else {
            // Add an error message for invalid credentials
            $this->addError('email', 'Invalid credentials');
            return back()->with('error', 'Invalid email or password. Please try again.');
        }
    }
    public function render()
    {
        return view('livewire.login')->layout('layouts.app');
    }
}
