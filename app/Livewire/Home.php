<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;

class Home extends Component
{   

    public function sell() {
        return redirect()->route('listings');
    }

    public function render()
    {
        return view('livewire.home', [
        
            'listings' => Listing::latest()->paginate(3)

        ])->layout('layouts.app');
    }
}
