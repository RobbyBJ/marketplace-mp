<div class='flex justify-center'>
    <div class='w-6/12'>
        <h1 class='my-10 text-3xl'>List Anything</h1>
        @error('newListing') 
        <span class="text-red-500 text-xs">{{$message}}</span>
        @enderror

        <div>
            @if(session()->has('message'))
            <div class='p-3 bg-green-300 text-greeen-700 rounded'>
                {{session('message')}}
            </div>
            @endif
        </div>

        <section>
            <input type="file" id='image'>
        </section>

        <div>
            <h1 class='mt-4'>Price</h1>
            <div class='mb-4 flex'>
                <input type="text" class='w-full rounded border shadow p-2 mr-2' placeholder="RM" wire:model.lazy="addPrice">
                <div class='py-2'>
                </div>
            </div>
        </div>

        <div>
            <h1 class='mt-4'>Condition</h1>
            <div class='mb-4 flex'>
                <input type="text" class='w-full rounded border shadow p-2 mr-2' placeholder="New/Used" wire:model.lazy="addCondition">
                <div class='py-2'>
                </div>
            </div>
        </div>

        <div>
            <h1 class='mt-4'>Description</h1>
            <div class='mb-4 flex'>
                <input type="text" class='w-full rounded border shadow p-2 mr-2' placeholder="Describe what you are selling" wire:model.lazy="newListing">
                <div class='py-2'>
                </div>
            </div>
        </div>

        <button class='p-2 bg-blue-500 w-20 rounded shadow text-white' wire:click="addListing">Add</button>

        @foreach ($listings as $listing)
        <div class='rounded border shadow p-2 my-2'>
            <div class='flex justify-between my-2'>
                <div class='flex'>
                    <p class='font-bold text-lg'>{{$listing->user->name}}</p>
                    <p class='mx-3 py-1 text-xs text-gray-500 font-semibold'>{{$listing->created_at->diffForHumans()}}</p>
                </div>
                <i class='fas fa-times text-red-200 hover:text-red-600 cursor-pointer' wire:click="delete({{$listing->id}})"></i>
            </div>
            <p class='text-gray-800'>{{$listing->body}}</p>
        </div>
        @endforeach
    </div>
</div>
