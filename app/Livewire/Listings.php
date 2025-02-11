<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Listing;
use Livewire\Component;


class Listings extends Component
{   
    public $listings;
    public $newListing;


    public function mount() {
        $default = Listing::latest()->get();
        $this->listings = $default;
    }

    public function addListing() {
        
        $this->validate(['newListing' => 'required|min:5|max:255']);

        $createdListing = Listing::create(['body' => $this->newListing, 'user_id' => 1]);
        $this->listings->prepend($createdListing);
        $this->newListing = "";
        session()->flash('message', 'Listing added succesfully!');
    }   

    public function delete($listingId) {
        $listing = Listing::find($listingId);
        $listing->delete();
        $this->listings = $this->listingss->reject(fn($c) => $c->id === $listingId);

    }

    public function render()
    {
        return view('livewire.listings');
    }
}
