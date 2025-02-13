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
    public $condition = "";
    public $description;

    public function mount() {
        $this->listings = Listing::where('user_id', auth()->id())->latest()->get();
    }

    public function addListing() {
        
        $imagePath = $this->image ? $this->image->store('photos', 'public') : null;

        $this->validate([
            'image'=> 'nullable|image|max:2048',
            'title' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,like_new,used,well_used,damaged',
            'description' => 'required|min:5|max:255'
        
        ]);
        

        $createdListing = Listing::create([
            'image'=> $imagePath,
            'title' => $this->title,
            'price' => $this->price,
            'condition' => $this->condition,
            'description' => $this->description, 
            'user_id' => auth()->id()
        
        ]);

        $this->listings->prepend($createdListing);
        $this->reset(['title', 'price', 'condition', 'description', 'image']);
        session()->flash('message', 'Listing added successfully!');
    }   

    public function delete($listingId) {
        $listing = Listing::where('user_id', auth()->id())->find($listingId);

        if ($listing) {
            $listing->delete();
            $this->listings = $this->listings->reject(fn($c) => $c->id === $listingId);
            session()->flash('message', 'Listing deleted successfully!');
        } 
        
        else {
        session()->flash('error', 'You are not authorized to delete this listing.');
        }

    }


    public function render()
    {
        return view('livewire.listings')->layout('layouts.app');
    }
}
