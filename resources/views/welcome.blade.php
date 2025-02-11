<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"
        integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <livewire:styles />
</head>
<body>
    <nav class="bg-red-700 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-2xl font-bold">SellEase</a>
            <ul class="flex space-x-10">
                <li><a href="#" class="hover:underline">Home</a></li>
                <li><a href="#" class="hover:underline">About</a></li>
                <li><a href="#" class="hover:underline">Services</a></li>
                <li><a href="#" class="hover:underline">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mx-auto mt-10 px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-gray-800">Welcome to SellEase</h1>
            <p class="mt-4 text-gray-600"> Where Selling Meets Easing - Your Marketplace, Your Way.</p>
            <a href="#" class="mt-6 inline-block bg-red-700 text-white px-6 py-2 rounded-lg hover:bg-red-900">Get Started</a>
        </div>
    </div>
    <livewire:listings />
    <livewire:scripts />
</body>
</html>