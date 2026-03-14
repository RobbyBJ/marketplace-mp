<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;

class Home extends Component
{   
    public $search = '';

    public function sell() {
        return redirect()->route('listings');
    }

    public function render()
    {
        $listings = Listing::with('user')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(9);

        return view('livewire.home', [
            'listings' => $listings
        ])->layout('layouts.app');
    }
}
