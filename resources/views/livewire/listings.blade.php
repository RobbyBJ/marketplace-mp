<div class="fade-up pb-12">

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-1">
            <div class="w-9 h-9 bg-gradient-to-br from-red-500 to-orange-400 rounded-xl flex items-center justify-center shadow-lg">
                <i class="fas fa-{{ $editingListingId ? 'pen' : 'plus' }} text-white text-sm"></i>
            </div>
            <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ $editingListingId ? 'Edit Listing' : 'List Something New' }}
            </h1>
        </div>
        <p class="text-sm ml-12 text-slate-500 dark:text-slate-500">
            {{ $editingListingId ? "Update your item's details below." : 'Fill out the details below to add an item to the marketplace.' }}
        </p>
    </div>

    <!-- Alerts -->
    @if(session()->has('message'))
        <div class="mb-5 flex items-center gap-3 p-4 rounded-xl text-sm
            bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400">
            <i class="fas fa-check-circle flex-shrink-0"></i> {{ session('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="mb-5 flex items-center gap-3 p-4 rounded-xl text-sm
            bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/30 text-red-700 dark:text-red-400">
            <i class="fas fa-exclamation-circle flex-shrink-0"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Form Card -->
    <div class="rounded-2xl p-6 sm:p-8 mb-12 shadow-sm border
        bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-semibold mb-3 text-slate-700 dark:text-slate-300">Item Photo</label>
                <div class="relative h-64 border-2 border-dashed rounded-xl overflow-hidden group transition cursor-pointer
                    border-slate-200 dark:border-slate-600 hover:border-red-400 dark:hover:border-red-500/50
                    bg-slate-50 dark:bg-slate-900">
                    <div class="w-full h-full flex flex-col items-center justify-center">
                        @if ($image)
                            <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover z-10">
                        @elseif($editingListingId && $existingImage)
                            <img src="{{ asset('storage/' . $existingImage) }}" class="absolute inset-0 w-full h-full object-cover z-10 opacity-80 group-hover:opacity-100 transition">
                        @else
                            <div class="text-center pointer-events-none">
                                <i class="fas fa-cloud-upload-alt text-4xl mb-3 transition
                                    text-slate-300 dark:text-slate-600 group-hover:text-red-400 dark:group-hover:text-red-500"></i>
                                <p class="text-sm text-slate-400 dark:text-slate-500">Click or drag to upload a photo</p>
                                <p class="text-xs mt-1 text-slate-300 dark:text-slate-600">PNG, JPG, GIF · max 2 MB</p>
                            </div>
                        @endif
                        <input id="image" wire:model="image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20">
                    </div>
                </div>
                @error('image') <p class="text-red-500 text-xs mt-2"><i class="fas fa-info-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>

            <!-- Details -->
            <div class="space-y-5">

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Title</label>
                    <input
                        id="title" type="text" wire:model="title"
                        placeholder="What are you selling?"
                        class="w-full rounded-xl py-2.5 px-4 text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                            text-slate-900 dark:text-slate-100 placeholder-slate-400
                            @error('title') border-red-400 @enderror"
                    >
                    @error('title') <p class="text-red-500 text-xs mt-1.5"><i class="fas fa-info-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Price</label>
                        <div class="flex rounded-xl overflow-hidden border transition focus-within:ring-2 focus-within:ring-red-500 focus-within:ring-offset-0
                            border-slate-200 dark:border-slate-600 @error('price') border-red-400 @enderror">
                            <span class="inline-flex items-center px-3 text-sm font-semibold border-r select-none
                                bg-slate-100 dark:bg-slate-700 border-slate-200 dark:border-slate-600
                                text-slate-600 dark:text-slate-300">RM</span>
                            <input
                                id="price" type="text" wire:model="price"
                                placeholder="0.00"
                                class="flex-1 py-2.5 px-3 text-sm focus:outline-none
                                    bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 placeholder-slate-400"
                            >
                        </div>
                        @error('price') <p class="text-red-500 text-xs mt-1.5"><i class="fas fa-info-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>

                    <!-- Condition -->
                    <div>
                        <label for="condition" class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Condition</label>
                        <select
                            id="condition" wire:model="condition"
                            class="w-full rounded-xl py-2.5 px-4 text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                                bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                                text-slate-900 dark:text-slate-100
                                @error('condition') border-red-400 @enderror"
                        >
                            <option value="" disabled selected>Select…</option>
                            <option value="new">Brand New</option>
                            <option value="like_new">Like New</option>
                            <option value="used">Lightly Used</option>
                            <option value="well_used">Well Used</option>
                            <option value="damaged">Heavy Used</option>
                        </select>
                        @error('condition') <p class="text-red-500 text-xs mt-1.5"><i class="fas fa-info-circle mr-1"></i>{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Description</label>
                    <textarea
                        id="description" rows="4" wire:model="description"
                        placeholder="Describe your item — condition, size, brand, etc."
                        class="w-full rounded-xl py-2.5 px-4 text-sm transition resize-none focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                            text-slate-900 dark:text-slate-100 placeholder-slate-400
                            @error('description') border-red-400 @enderror"
                    ></textarea>
                    @error('description') <p class="text-red-500 text-xs mt-1.5"><i class="fas fa-info-circle mr-1"></i>{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-5 border-t flex justify-end gap-3 border-slate-100 dark:border-slate-700">
            @if($editingListingId)
                <button class="px-6 py-2.5 rounded-xl font-medium transition text-sm
                    bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600
                    text-slate-700 dark:text-slate-200"
                    wire:click="cancelEdit">
                    Cancel
                </button>
                <button class="px-6 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-medium shadow transition text-sm flex items-center gap-2"
                    wire:click="updateListing">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            @else
                <button class="px-8 py-2.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white rounded-xl font-semibold shadow-lg hover:shadow-red-500/30 transition text-sm flex items-center gap-2"
                    wire:click="addListing">
                    <i class="fas fa-plus"></i> Post Listing
                </button>
            @endif
        </div>
    </div>

    <!-- My Active Listings -->
    <div>
        <h2 class="text-xl font-bold mb-6 flex items-center gap-3 text-slate-900 dark:text-white">
            <span>My Active Listings</span>
            <span class="text-sm font-medium px-3 py-0.5 rounded-full
                bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                text-slate-500 dark:text-slate-400">{{ $listings->count() }}</span>
        </h2>

        @if($listings->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach ($listings as $listing)
                    <div class="rounded-2xl overflow-hidden card-hover hover:-translate-y-1 transition duration-300 flex flex-col group relative
                        bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">

                        <!-- Hover Actions -->
                        <div class="absolute top-3 right-3 z-30 flex gap-2 opacity-0 group-hover:opacity-100 transition">
                            <button class="w-8 h-8 bg-blue-500 hover:bg-blue-400 text-white rounded-full shadow-lg flex items-center justify-center transition"
                                wire:click="editListing({{ $listing->id }})" title="Edit">
                                <i class="fas fa-pen text-xs"></i>
                            </button>
                            <button class="w-8 h-8 bg-red-500 hover:bg-red-400 text-white rounded-full shadow-lg flex items-center justify-center transition"
                                wire:click="deleteListing({{ $listing->id }})" title="Delete">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </div>

                        <!-- Image -->
                        <div class="relative h-52 overflow-hidden flex-shrink-0 bg-slate-100 dark:bg-slate-900">
                            @if ($listing->image)
                                <img
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-500 {{ $editingListingId === $listing->id ? 'opacity-40 grayscale' : '' }}"
                                    src="{{ asset('storage/' . $listing->image) }}"
                                    alt="{{ $listing->title }}"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-image text-3xl text-slate-300 dark:text-slate-700"></i>
                                </div>
                            @endif

                            <!-- Condition Badge -->
                            <div class="absolute top-3 left-3">
                                @php
                                    $conditionColors = [
                                        'new'       => 'bg-emerald-500/90 text-white',
                                        'like_new'  => 'bg-sky-500/90 text-white',
                                        'used'      => 'bg-amber-500/90 text-white',
                                        'well_used' => 'bg-orange-500/90 text-white',
                                        'damaged'   => 'bg-red-600/90 text-white',
                                    ];
                                    $color = $conditionColors[$listing->condition] ?? 'bg-slate-600/90 text-white';
                                    $label = str_replace('_', ' ', $listing->condition);
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $color }} backdrop-blur-sm shadow">
                                    {{ ucwords($label) }}
                                </span>
                            </div>

                            <!-- Price Badge -->
                            <div class="absolute bottom-3 right-3">
                                <span class="bg-red-600 text-white text-sm font-extrabold px-3 py-1 rounded-lg shadow-lg">
                                    RM{{ number_format($listing->price, 2) }}
                                </span>
                            </div>

                            @if($editingListingId === $listing->id)
                                <div class="absolute inset-0 flex items-center justify-center z-20 bg-white/60 dark:bg-slate-900/50">
                                    <span class="bg-blue-600 px-3 py-1.5 rounded-lg text-xs font-bold text-white shadow">
                                        <i class="fas fa-pen mr-1"></i> Editing
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4 flex-grow flex flex-col bg-white dark:bg-slate-800">
                            <h3 class="text-sm font-bold line-clamp-1 mb-1 group-hover:text-red-500 transition
                                text-slate-900 dark:text-white">
                                {{ ucfirst($listing->title) }}
                            </h3>
                            <p class="text-xs line-clamp-2 flex-grow mb-3 text-slate-500 dark:text-slate-400">
                                {{ ucfirst($listing->description) }}
                            </p>
                            <div class="pt-3 border-t text-xs border-slate-100 dark:border-slate-700 text-slate-400 dark:text-slate-500">
                                Listed {{ $listing->created_at->calendar() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="text-center py-20 border border-dashed rounded-2xl
                border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                <div class="w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-4 border
                    bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700">
                    <i class="fas fa-box-open text-2xl text-slate-300 dark:text-slate-600"></i>
                </div>
                <h3 class="text-base font-semibold mb-1 text-slate-700 dark:text-slate-300">No listings yet</h3>
                <p class="text-sm text-slate-400 dark:text-slate-600">Use the form above to add your first item.</p>
            </div>
        @endif
    </div>

</div>
