<div class="mt-12 flex flex-col justify-center items-center">

    @if(session('error'))
        <div class="p-3 bg-red-300 text-red-700 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="p-3 bg-green-300 text-green-700 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="w-full max-w-sm space-y-4">
   
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

        <div>
            <a href="/register" class="text-xs hover:underline">Not a member? Register here!</a>
        </div>

        <div x-data  @keydown.enter.window="$wire.login">
            <button class="p-2 bg-red-700 w-full rounded shadow text-white" wire:click="login">Login</button>
        </div>
    </div>
</div>