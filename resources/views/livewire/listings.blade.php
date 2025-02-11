<div class='flex justify-center'>
    <div class='w-6/12'>
        <h1 class='my-10 text-3xl'>List Anything</h1>

        <!-- Display validation errors -->
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

        <!-- Success message -->
        <div>
            @if(session()->has('message'))
            <div class='p-3 bg-green-300 text-green-700 rounded'>
                {{ session('message') }}
            </div>
            @endif
        </div>

        <section>
            <input type="file" id='image' wire:model='image'>
        </section>

        <div>
            <h1 class='mt-4'>Title</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="Item you're selling" 
                    wire:model.lazy="title"
                >
            </div>
        </div>

        
        <div>
            <h1 class='mt-4'>Price</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="RM" 
                    wire:model.lazy="price"
                >
            </div>
        </div>

        
        <div>
            <h1 class='mt-4'>Condition</h1>
            <div class='mb-4 flex'>
                <select 
                    class='w-full rounded border shadow p-2 mr-2' 
                    wire:model.lazy="condition"
                >
                    <option value="new" selected>Brand New</option>
                    <option value="used">Like New</option>
                    <option value="used">Lightly Used</option>
                    <option value="used">Well Used</option>
                    <option value="used">Heavy Used</option>
                </select>
            </div>
        </div>

        <div>
            <h1 class='mt-4'>Description</h1>
            <div class='mb-4 flex'>
                <input 
                    type="text" 
                    class='w-full rounded border shadow p-2 mr-2' 
                    placeholder="Describe what you are selling" 
                    wire:model.lazy="description"
                >
            </div>
        </div>

        <button class='p-2 bg-red-700 w-20 rounded shadow text-white' wire:click="addListing">Add</button>

        <!--Display created listings section-->
        @foreach ($listings as $listing)
        <div class='rounded border shadow p-2 my-2'>
            <div class='flex justify-between my-2'>
                <div class='flex'>
                    <p class='font-bold text-lg'>{{ $listing->user->name }}</p>
                    <p class='mx-3 py-1 text-xs text-gray-500 font-semibold'>{{ $listing->created_at->diffForHumans() }}</p>
                </div>
                <i 
                    class='fas fa-times text-red-200 hover:text-red-600 cursor-pointer' 
                    wire:click="delete({{ $listing->id }})"
                ></i>
            </div>

            <div>
                @if ($listing->image)
                    <img
                        class="mx-auto w-1/5 h-auto object-cover"
                        src="{{ asset('storage/' . $listing->image) }}" 
                        alt="Listing Image" 
                        style="max-width: 20%; height: auto; display: block; object-fit: cover;">
                @endif
            </div>

            <p class='text-gray-800'>{{ $listing->body }}</p>
            <p class='text-gray-800'><strong>Title:</strong> {{ ucfirst($listing->title) }}</p>
            <p class='text-gray-800'><strong>Price:</strong> RM{{ number_format($listing->price, 2) }}</p>
            <p class='text-gray-800'><strong>Condition:</strong> {{ ucfirst($listing->condition) }}</p>
            <p class='text-gray-800'><strong>Description:</strong> {{ ucfirst($listing->description) }}</p>
        </div>
        @endforeach
    </div>
</div>