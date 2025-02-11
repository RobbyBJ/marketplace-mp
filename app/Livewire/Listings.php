<?php

namespace App\Livewire;

use App\Models\Listing;
use Livewire\Component;
use Livewire\WithFileUploads;


class Listings extends Component
{  
    use WithFileUploads;

    public $listings;
    public $image;
    public $title;
    public $price;
    public $condition;
    public $description;

    public function mount() {
        $default = Listing::latest()->get();
        $this->listings = $default;
    }

    public function addListing() {
        
        $imagePath = $this->image ? $this->image->store('photos', 'public') : null;

        $this->validate([
            'image'=> 'nullable|image|max:2048',
            'title' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used,refurbished',
            'description' => 'required|min:5|max:255'
        
        ]);
        

        $createdListing = Listing::create([
            'image'=> $imagePath,
            'title' => $this->title,
            'price' => $this->price,
            'condition' => $this->condition,
            'description' => $this->description, 
            'user_id' => 1
        
        ]);

        $this->listings->prepend($createdListing);
        $this->description = "";
        session()->flash('message', 'Listing added succesfully!');
    }   

    public function delete($listingId) {
        $listing = Listing::find($listingId);
        $listing->delete();
        $this->listings = $this->listings->reject(fn($c) => $c->id === $listingId);

    }

    public function render()
    {
        return view('livewire.listings');
    }
}
