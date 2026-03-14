<div class="fade-up">

    <!-- ========== HERO ========== -->
    <div class="relative rounded-3xl overflow-hidden mb-8
        bg-gradient-to-br from-red-900 via-indigo-950 to-slate-900
        dark:from-red-900 dark:via-indigo-950 dark:to-slate-900
        light-hero">
        <style>
            html:not(.dark) .light-hero {
                background: linear-gradient(135deg, #fef2f2 0%, #eff6ff 50%, #f0fdf4 100%) !important;
            }
        </style>

        <!-- Grid texture -->
        <div class="absolute inset-0 opacity-10 dark:opacity-10"
             style="background-image: radial-gradient(circle, #94a3b8 1px, transparent 1px); background-size: 28px 28px;"></div>

        <!-- Glowing blobs (dark only) -->
        <div class="absolute -top-8 -left-8 w-72 h-72 bg-red-600 rounded-full opacity-20 blur-3xl pointer-events-none hidden dark:block"></div>
        <div class="absolute -bottom-12 right-0 w-64 h-64 bg-purple-700 rounded-full opacity-20 blur-3xl pointer-events-none hidden dark:block"></div>

        <!-- Light blobs -->
        <div class="absolute -top-8 -left-8 w-72 h-72 bg-red-200 rounded-full opacity-40 blur-3xl pointer-events-none block dark:hidden"></div>
        <div class="absolute -bottom-12 right-0 w-64 h-64 bg-blue-200 rounded-full opacity-40 blur-3xl pointer-events-none block dark:hidden"></div>

        <div class="relative z-10 px-6 sm:px-12 py-14 text-center">
            <!-- Live badge -->
            <div class="inline-flex items-center gap-2 bg-white/20 dark:bg-white/10 text-green-700 dark:text-green-400 text-xs font-semibold px-3 py-1.5 rounded-full mb-5 border border-green-400/30 dark:border-green-400/20">
                <span class="relative flex w-2 h-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full w-2 h-2 bg-green-400"></span>
                </span>
                Live Marketplace
            </div>

            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight tracking-tight
                text-slate-800 dark:text-white">
                Discover What's <span class="gradient-text">Selling</span>
            </h1>
            <p class="text-base md:text-lg max-w-xl mx-auto mb-8
                text-slate-600 dark:text-slate-400">
                Browse real listings from your community — or turn your unused items into cash in minutes.
            </p>

            <!-- Search bar -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 max-w-2xl mx-auto">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                    <input
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        class="w-full pl-11 pr-4 py-3.5 rounded-xl text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-white/80 dark:bg-slate-800 border border-slate-200 dark:border-slate-700
                            text-slate-900 dark:text-slate-100 placeholder-slate-400"
                        placeholder="Search for items, brands, descriptions..."
                    >
                </div>
                <button
                    class="w-full sm:w-auto flex items-center justify-center gap-2 px-8 py-3.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400 text-white font-semibold rounded-xl shadow-lg hover:shadow-red-500/30 transition duration-200 whitespace-nowrap"
                    wire:click="sell"
                >
                    <i class="fas fa-plus text-sm"></i> Start Selling
                </button>
            </div>
        </div>

        <!-- Stats strip -->
        <div class="relative z-10 border-t border-black/10 dark:border-white/10 px-6 sm:px-12 py-4 flex flex-wrap items-center justify-center gap-6 text-sm
            text-slate-600 dark:text-slate-400">
            <div class="flex items-center gap-2">
                <i class="fas fa-tag text-red-500"></i>
                <span><strong class="text-slate-900 dark:text-white font-semibold">{{ \App\Models\Listing::count() }}</strong> active listings</span>
            </div>
            <div class="w-px h-4 bg-slate-300 dark:bg-slate-700 hidden sm:block"></div>
            <div class="flex items-center gap-2">
                <i class="fas fa-users text-purple-500"></i>
                <span><strong class="text-slate-900 dark:text-white font-semibold">{{ \App\Models\User::count() }}</strong> sellers</span>
            </div>
            <div class="w-px h-4 bg-slate-300 dark:bg-slate-700 hidden sm:block"></div>
            <div class="flex items-center gap-2">
                <i class="fas fa-shield-alt text-green-500"></i>
                <span>Trusted community marketplace</span>
            </div>
        </div>
    </div>

    <!-- ========== SEARCH RESULT LABEL ========== -->
    @if($search)
        <div class="mb-5 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <i class="fas fa-search text-slate-400"></i>
            <span>Results for</span>
            <span class="bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-800 dark:text-white px-3 py-0.5 rounded-full font-semibold">"{{ $search }}"</span>
            <button wire:click="$set('search', '')" class="ml-2 text-red-500 hover:text-red-400 transition">
                <i class="fas fa-times-circle"></i> Clear
            </button>
        </div>
    @endif

    <!-- ========== LISTINGS GRID ========== -->
    @if($listings->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 mb-8">
            @foreach ($listings as $listing)
                <div class="rounded-2xl overflow-hidden card-hover hover:-translate-y-1 transition duration-300 flex flex-col group
                    bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm">

                    <!-- Image (fixed height) -->
                    <div class="relative h-52 bg-slate-100 dark:bg-slate-900 overflow-hidden flex-shrink-0">
                        @if ($listing->image)
                            <img
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                                src="{{ asset('storage/' . $listing->image) }}"
                                alt="{{ $listing->title }}"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-slate-300 dark:text-slate-700"></i>
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
                    </div>

                    <!-- Content -->
                    <div class="p-4 flex-grow flex flex-col bg-white dark:bg-slate-800">
                        <h2 class="text-sm font-bold line-clamp-1 group-hover:text-red-500 transition mb-1
                            text-slate-900 dark:text-white"
                            title="{{ ucfirst($listing->title) }}">
                            {{ ucfirst($listing->title) }}
                        </h2>
                        <p class="text-xs line-clamp-2 flex-grow mb-3 text-slate-500 dark:text-slate-400">
                            {{ ucfirst($listing->description) }}
                        </p>

                        <!-- Footer -->
                        <div class="pt-3 border-t border-slate-100 dark:border-slate-700 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-red-500 to-orange-400 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($listing->user->name, 0, 1)) }}
                                </div>
                                <span class="text-xs truncate max-w-[90px] text-slate-600 dark:text-slate-300">{{ $listing->user->name }}</span>
                            </div>
                            <span class="text-xs text-slate-400 dark:text-slate-500">
                                {{ $listing->created_at->shortRelativeToNowDiffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 mb-10">
            {{ $listings->links() }}
        </div>

    @else
        <!-- Empty state -->
        <div class="text-center py-24 border border-dashed rounded-2xl
            border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
            <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-5 border
                bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700">
                <i class="fas fa-box-open text-3xl text-slate-300 dark:text-slate-600"></i>
            </div>
            <h3 class="text-lg font-bold mb-2 text-slate-800 dark:text-slate-200">No listings found</h3>
            <p class="text-sm text-slate-500">Try adjusting your search, or be the first to list something!</p>
            @if($search)
                <button wire:click="$set('search', '')" class="mt-4 text-red-500 hover:text-red-400 font-medium text-sm transition">
                    <i class="fas fa-times mr-1"></i> Clear search
                </button>
            @endif
        </div>
    @endif

</div>
