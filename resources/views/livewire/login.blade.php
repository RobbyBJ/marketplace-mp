<div class="mt-12 flex flex-col justify-center items-center">

    @error('title') 
        <span class="text-red-500 text-xs">{{ $message }}</span>
    @enderror

    <div>
        @if(session()->has('message'))
        <div class="p-3 bg-green-300 text-green-700 rounded">
            {{ session('message') }}
        </div>
        @endif
    </div>

    <div class="w-full max-w-sm space-y-4">
        <div>
            <input type="text" class="w-full rounded border shadow p-2" placeholder="Username" wire:model.lazy="name">
        </div>

        <div>
            <input type="text" class="w-full rounded border shadow p-2" placeholder="Email" wire:model.lazy="email">
        </div>

        <div>
            <input type="password" class="w-full rounded border shadow p-2" placeholder="Password" wire:model.lazy="password">
        </div>

        <div>
            <button class="p-2 bg-red-700 w-full rounded shadow text-white" wire:click="register">Register</button>
        </div>

    </div>
</div>
