<div class="mt-12 flex flex-col justify-center items-center">

    @error('title') 
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror

    <div>
        @if(session()->has('message'))
        <div class="mt-4 p-3 bg-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
        @endif
    </div>

    <h1 class="mb-12 font-bold text-4xl text-gray-800 underline decoration-red-500">Register Today!</h1>

    <div class="w-full max-w-sm space-y-4">
        <div>
            <input type="text" class="w-full rounded border shadow p-2" placeholder="Username" wire:model="name">
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input type="text" class="w-full rounded border shadow p-2" placeholder="Email" wire:model="email">
            @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <input type="password" class="w-full rounded border shadow p-2" placeholder="Password" wire:model="password">
            @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div  x-data  @keydown.enter.window="$wire.register">
            <button class="p-2 bg-red-700 w-full rounded shadow text-white" wire:click="register">Register</button>
        </div>

    </div>
</div>
