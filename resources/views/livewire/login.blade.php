<div class='mt-12 flex justify-center '>

    <div>
        @if(session()->has('message'))
        <div class='p-3 bg-green-300 text-green-700 rounded'>
            {{ session('message') }}
        </div>
        @endif
    </div>

    <div class="mb-4 flex">
        <input type="text" class="w-full rounded border shadow p-2 mr-2" placeholder="Username" wire:model.lazy="name">
    </div>

    <div class="mb-4 flex">
        <input type="text" class="w-full rounded border shadow p-2 mr-2" placeholder="Email" wire:model.lazy="email">
    </div>

    <div class="mb-4 flex">
        <input type="text" class="w-full rounded border shadow p-2 mr-2" placeholder="Password" wire:model.lazy="password">
    </div>

    <div>
        <button class='p-2 bg-red-700 w-20 rounded shadow text-white' wire:click="register">Add</button>
    </div>

</div>
