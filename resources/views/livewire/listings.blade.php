<div class='flex justify-center'>
    <div class='w-6/12'>
        <button >
            <i class="fas fa-arrow-left text-3xl text-gray-800" wire:click="back"></i>
        </button>

        @if($editingListingId)
            <h1 class='mb-6 mt-4 text-3xl'>Edit Listing</h1>
        @else
            <h1 class='mb-6 mt-4 text-3xl'>List Anything</h1>
        @endif

        <!-- Error messages -->
        @error('image') 
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        @error('title') 
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        @error('price') 
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        @error('condition') 
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
        @error('description') 
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror

        <!-- Success messages -->
        <div>
            @if(session()->has('message'))
                <div class='p-3 bg-green-300 text-green-700 rounded'>
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <!-- Image File Input -->
        <section>
            <input type="file" id='image' wire:model='image'>
            @if($editingListingId && $existingImage)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current Image:</p>
                    <img
                        class="mx-auto h-auto object-cover border-2 border-gray-300 rounded-md"
                        src="{{ asset('storage/' . $existingImage) }}" 
                        alt="Current Listing Image" 
                        style="max-width: 20%; height: auto; display: block; object-fit: cover;">
                </div>
            @endif
        </section>

        <!-- Title Input -->
        <div>
            <h1 class='mt-4'>Title</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="Item you're selling" 
                    wire:model="title"
                >
            </div>
        </div>

        <!-- Price Input -->
        <div>
            <h1 class='mt-4'>Price</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="RM" 
                    wire:model="price"
                >
            </div>
        </div>

        <!-- Condition Select -->
        <div>
            <h1 class='mt-4'>Condition</h1>
            <div class='mb-4 flex'>
                <select 
                    class='w-full rounded border shadow p-2 mr-2' 
                    wire:model="condition"
                >   
                    <option value="" disabled selected>Select an Option</option>
                    <option value="new">Brand New</option>
                    <option value="like_new">Like New</option>
                    <option value="used">Lightly Used</option>
                    <option value="well_used">Well Used</option>
                    <option value="damaged">Heavy Used</option>
                </select>
            </div>
        </div>

        <!-- Description Input -->
        <div>
            <h1 class='mt-4'>Description</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="Describe what you are selling" 
                    wire:model="description"
                >
            </div>
        </div>

        <!-- Action Buttons for editing  -->
        @if($editingListingId)
            <button class='mb-4 p-2 bg-blue-700 w-20 rounded shadow text-white' wire:click="updateListing">Update</button>
            <button class='mb-4 p-2 bg-gray-700 w-20 rounded shadow text-white' wire:click="cancelEdit">Cancel</button>
        @else
            <button class='mb-4 p-2 bg-red-700 w-20 rounded shadow text-white' wire:click="addListing">Add</button>
        @endif

        <!-- Listings Display -->
        <div>
            @foreach ($listings as $listing)
                <div class='rounded border shadow p-2 my-2 max-w-2xl mx-auto'>
                    <div class='flex justify-between my-2 items-center'>
                        <div class='flex'>
                            <p class='font-bold text-lg'>{{ $listing->user->name }}</p>
                            <p class='mx-3 py-1 text-xs text-gray-500 font-semibold'>{{ $listing->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2">
                            <!-- Edit Button -->
                            <i 
                                class='fas fa-edit text-blue-500 hover:text-blue-700 cursor-pointer' 
                                wire:click="editListing({{ $listing->id }})"
                            ></i>
                            <!-- Delete Button -->
                            <i 
                                class='fas fa-times text-red-200 hover:text-red-600 cursor-pointer' 
                                wire:click="deleteListing({{ $listing->id }})"
                            ></i>
                        </div>
                    </div>
            
                    <div>
                        @if ($listing->image)
                            <img
                                class="mx-auto h-auto object-cover border-2 border-gray-300 rounded-md"
                                src="{{ asset('storage/' . $listing->image) }}" 
                                alt="Listing Image" 
                                style="max-width: 20%; height: auto; display: block; object-fit: cover;">
                        @endif
                    </div>

                    <p class='text-gray-800'><strong>Title:</strong> {{ ucfirst($listing->title) }}</p>
                    <p class='text-gray-800'><strong>Price:</strong> RM{{ number_format($listing->price, 2) }}</p>
                    <p class='text-gray-800'><strong>Condition:</strong> {{ ucfirst($listing->condition) }}</p>
                    <p class='text-gray-800'><strong>Description:</strong> {{ ucfirst($listing->description) }}</p>
                </div>
            @endforeach
        </div>
        
    </div>
</div>
