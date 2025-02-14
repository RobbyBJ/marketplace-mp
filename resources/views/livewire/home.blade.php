<div>
    <div class="mt-12 flex items-center justify-center">
        <button class="p-2 bg-red-700 rounded shadow text-white rounded-xs" wire:click="sell">
            Start Selling
        </button>
    </div>
    <div class="text-center pt-6 pb-8">
        <h1 class="text-4xl font-bold text-red mb-4 ">
            Welcome to the Marketplace
        </h1>
        <h3 class="text-sm font-semibold text-gray-500">
            Here you can see what others are putting up for sale!
        </h3>
    </div>
    @foreach ($listings as $listing)
    <div class='rounded border shadow p-2 my-2 max-w-2xl mx-auto'>
        <div class='flex justify-between my-2'>
            <div class='flex'>
                <p class='font-bold text-lg'>{{ $listing->user->name }}</p>
                <p class='mx-3 py-1 text-xs text-gray-500 font-semibold'>{{ $listing->created_at->diffForHumans() }}</p>
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

        <p class='text-gray-800'>{{ $listing->body }}</p>
        <p class='text-gray-800'><strong>Title:</strong> {{ ucfirst($listing->title) }}</p>
        <p class='text-gray-800'><strong>Price:</strong> RM{{ number_format($listing->price, 2) }}</p>
        <p class='text-gray-800'><strong>Condition:</strong> {{ ucfirst($listing->condition) }}</p>
        <p class='text-gray-800'><strong>Description:</strong> {{ ucfirst($listing->description) }}</p>
    </div>
    @endforeach

    {{$listings->links()}}
</div>
