<div class="min-h-screen flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md fade-up">

        {{-- Branding --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2.5 group mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-orange-400 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                    <i class="fas fa-store text-white"></i>
                </div>
                <span class="text-2xl font-extrabold gradient-text">SellEase</span>
            </a>
            <h1 class="text-2xl font-bold mt-2 text-slate-900 dark:text-white">Create your account</h1>
            <p class="text-sm mt-1 text-slate-500">Join thousands of sellers on SellEase today</p>
        </div>

        {{-- Success --}}
        @if(session()->has('message'))
            <div class="mb-4 flex items-center gap-3 p-4 rounded-xl text-sm
                bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/30 text-emerald-700 dark:text-emerald-400">
                <i class="fas fa-check-circle flex-shrink-0"></i>
                <span>{{ session('message') }}</span>
            </div>
        @endif

        {{-- Card --}}
        <div class="rounded-2xl p-8 shadow-xl space-y-5 border
            bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700">

            {{-- Username --}}
            <div>
                <label class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-user text-sm"></i>
                    </span>
                    <input
                        type="text" wire:model="name" placeholder="yourname"
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                            text-slate-900 dark:text-slate-100 placeholder-slate-400
                            @error('name') border-red-400 @enderror"
                    >
                </div>
                @error('name')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-info-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Email address</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-envelope text-sm"></i>
                    </span>
                    <input
                        type="text" wire:model="email" placeholder="you@example.com"
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                            text-slate-900 dark:text-slate-100 placeholder-slate-400
                            @error('email') border-red-400 @enderror"
                    >
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-info-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold mb-1.5 text-slate-700 dark:text-slate-300">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fas fa-lock text-sm"></i>
                    </span>
                    <input
                        type="password" wire:model="password" placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl text-sm transition focus:outline-none focus:ring-2 focus:ring-red-500
                            bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-600
                            text-slate-900 dark:text-slate-100 placeholder-slate-400
                            @error('password') border-red-400 @enderror"
                    >
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1"><i class="fas fa-info-circle"></i> {{ $message }}</p>
                @enderror
            </div>

            {{-- Terms note --}}
            <p class="text-xs text-slate-400">
                By registering, you agree to our
                <span class="text-red-500 font-medium">Terms of Service</span> and
                <span class="text-red-500 font-medium">Privacy Policy</span>.
            </p>

            {{-- Submit --}}
            <div x-data @keydown.enter.window="$wire.register">
                <button wire:click="register" wire:loading.attr="disabled"
                    class="w-full flex justify-center items-center gap-2 py-2.5 text-white font-semibold rounded-xl shadow-lg hover:shadow-red-500/30 transition duration-200 text-sm disabled:opacity-60
                        bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-400">
                    <span wire:loading.remove wire:target="register">Create account</span>
                    <span wire:loading wire:target="register" class="flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                        </svg>
                        Creating account...
                    </span>
                </button>
            </div>

        </div>

        {{-- Footer --}}
        <p class="mt-6 text-center text-sm text-slate-500">
            Already have an account?
            <a href="/login" class="font-semibold text-red-500 hover:text-red-400 transition">Sign in here</a>
        </p>

    </div>
</div>
