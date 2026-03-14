<!DOCTYPE html>
<html lang="en" x-data="themeManager()" x-bind:class="{ 'dark': isDark }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SellEase' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ── Backgrounds ── */
        body { transition: background 0.3s, color 0.3s; }

        /* Dark body gradient */
        html.dark body {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #0f172a 100%);
            color: #e2e8f0;
        }
        /* Light body gradient */
        html:not(.dark) body {
            background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 40%, #f8fafc 100%);
            color: #0f172a;
        }

        /* ── Navbar ── */
        html.dark .glass-nav {
            background: rgba(15, 23, 42, 0.80);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(248, 113, 113, 0.15);
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }
        html:not(.dark) .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
        }

        /* ── Nav links ── */
        html.dark .nav-link  { color: #94a3b8; }
        html:not(.dark) .nav-link { color: #475569; }
        .nav-link { transition: color 0.2s, text-shadow 0.2s; }
        .nav-link:hover { color: #f87171; }
        html.dark .nav-link:hover { text-shadow: 0 0 12px rgba(248,113,113,0.5); }

        /* ── Gradient text (logo) ── */
        .gradient-text {
            background: linear-gradient(90deg, #f87171, #fb923c, #f87171);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer { to { background-position: 200% center; } }

        /* ── Cards ── */
        html.dark .card-hover:hover {
            box-shadow: 0 0 0 1px rgba(248,113,113,0.3), 0 20px 40px rgba(0,0,0,0.4);
        }
        html:not(.dark) .card-hover:hover {
            box-shadow: 0 0 0 1px rgba(248,113,113,0.2), 0 12px 32px rgba(0,0,0,0.12);
        }

        /* ── Fade-in ── */
        .fade-up { animation: fadeUp 0.5s ease both; }
        @keyframes fadeUp { from { opacity:0; transform:translateY(16px); } to { opacity:1; transform:translateY(0); } }

        /* ── Scrollbar ── */
        html.dark ::-webkit-scrollbar-track  { background: #0f172a; }
        html.dark ::-webkit-scrollbar-thumb  { background: #334155; }
        html:not(.dark) ::-webkit-scrollbar-track { background: #f1f5f9; }
        html:not(.dark) ::-webkit-scrollbar-thumb { background: #cbd5e1; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #ef4444; }

        /* ── Theme toggle button ── */
        .theme-toggle {
            width: 2.25rem; height: 2.25rem;
            border-radius: 0.625rem;
            display: flex; align-items: center; justify-content: center;
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }
        html.dark .theme-toggle { background: rgba(255,255,255,0.07); color: #fbbf24; }
        html.dark .theme-toggle:hover { background: rgba(255,255,255,0.12); }
        html:not(.dark) .theme-toggle { background: rgba(15,23,42,0.06); color: #64748b; }
        html:not(.dark) .theme-toggle:hover { background: rgba(15,23,42,0.10); color: #1e293b; }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="antialiased min-h-screen">

    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-400 rounded-lg flex items-center justify-center shadow-lg group-hover:scale-110 transition">
                        <i class="fas fa-store text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-extrabold gradient-text tracking-tight">SellEase</span>
                </a>

                <!-- Nav Links -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <a href="{{ route('home') }}" class="nav-link text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition">
                        <i class="fas fa-compass mr-1.5 opacity-70"></i> Explore
                    </a>

                    @auth
                        <a href="{{ route('listings') }}" class="nav-link text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition">
                            <i class="fas fa-box mr-1.5 opacity-70"></i> My Listings
                        </a>

                        <div class="flex items-center gap-3 border-l border-slate-200 dark:border-slate-700 pl-4 ml-1">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-red-500 to-orange-400 flex items-center justify-center text-white text-xs font-bold shadow">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300 hidden sm:block">{{ auth()->user()->name }}</span>
                            <form method="POST" action="#">
                                @csrf
                                <button type="submit" title="Logout" class="w-8 h-8 rounded-lg hover:bg-red-500/10 dark:hover:bg-red-500/20 text-slate-400 hover:text-red-500 flex items-center justify-center transition">
                                    <i class="fas fa-sign-out-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="nav-link text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/5 transition">Sign in</a>
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-4 py-2 rounded-lg shadow-lg hover:shadow-red-500/30 transition duration-200">
                                Get Started
                            </a>
                        </div>
                    @endauth

                    <!-- Theme Toggle -->
                    <button @click="toggle()" class="theme-toggle" :title="isDark ? 'Switch to light mode' : 'Switch to dark mode'">
                        <i :class="isDark ? 'fas fa-sun' : 'fas fa-moon'" class="text-base"></i>
                    </button>
                </div>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 dark:border-slate-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 bg-gradient-to-br from-red-500 to-orange-400 rounded-md flex items-center justify-center">
                        <i class="fas fa-store text-white text-xs"></i>
                    </div>
                    <span class="font-bold text-slate-700 dark:text-slate-300">SellEase</span>
                </div>
                <p class="text-sm text-slate-400 dark:text-slate-600">© {{ date('Y') }} SellEase Marketplace. All rights reserved.</p>
                <div class="flex gap-5 text-sm text-slate-400 dark:text-slate-600">
                    <a href="#" class="hover:text-red-500 transition">Privacy</a>
                    <a href="#" class="hover:text-red-500 transition">Terms</a>
                    <a href="#" class="hover:text-red-500 transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts

    <script>
        function themeManager() {
            return {
                isDark: localStorage.getItem('theme') === 'dark' || 
                        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                toggle() {
                    this.isDark = !this.isDark;
                    localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                },
                init() {
                    // Sync on system preference change
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                        if (!localStorage.getItem('theme')) {
                            this.isDark = e.matches;
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>
