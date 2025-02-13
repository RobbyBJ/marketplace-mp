<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure you have Vite setup -->
    @livewireStyles
    <nav class="bg-red-700 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">SellEase</a>
        </div>
    </nav>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        {{ $slot }}

    </div>
    @livewireScripts
</body>
</html>
