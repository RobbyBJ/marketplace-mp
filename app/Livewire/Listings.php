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

    public $editingListingId = null;
    public $existingImage = null;

    public function mount() {
        $this->listings = Listing::where('user_id', auth()->id())->latest()->get();
    }

    public function addListing() {
        
        $imagePath = $this->image ? $this->image->store('photos', 'public') : null;

        $this->validate([
            'image'=> 'required|image|max:2048',
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
    public function editListing($listingId)
    {
        $listing = Listing::where('user_id', auth()->id())->find($listingId);

        if (!$listing) {
            session()->flash('error', 'You are not authorized to edit this listing.');
            return;
        }

        $this->editingListingId = $listing->id;
        $this->title           = $listing->title;
        $this->price           = $listing->price;
        $this->condition       = $listing->condition;
        $this->description     = $listing->description;
        $this->existingImage   = $listing->image;
    }

    public function updateListing()
    {
        $listing = Listing::where('user_id', auth()->id())->find($this->editingListingId);

        if (!$listing) {
            session()->flash('error', 'Listing not found or you are not authorized.');
            return;
        }

        $rules = [
            'title'       => 'required',
            'price'       => 'required|numeric|min:0',
            'condition'   => 'required|in:new,like_new,used,well_used,damaged',
            'description' => 'required|min:5|max:255',
        ];

        if ($this->image) {
            $rules['image'] = 'image|max:2048';
        }

        $this->validate($rules);

        if ($this->image) {
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $imagePath = $this->image->store('photos', 'public');
        } else {
            $imagePath = $listing->image;
        }

        $listing->update([
            'title'       => $this->title,
            'price'       => $this->price,
            'condition'   => $this->condition,
            'description' => $this->description,
            'image'       => $imagePath,
        ]);

        $this->listings = $this->listings->map(function ($l) use ($listing) {
            return $l->id === $listing->id ? $listing : $l;
        });

        $this->reset(['editingListingId', 'existingImage', 'title', 'price', 'condition', 'description', 'image']);

        session()->flash('message', 'Listing updated successfully!');
    }

  
    public function cancelEdit()
    {
        $this->reset(['editingListingId', 'existingImage', 'title', 'price', 'condition', 'description', 'image']);
    }


    public function back() {
        redirect()->route('home');
    }


    public function render()
    {
        return view('livewire.listings')->layout('layouts.app');
    }
}
