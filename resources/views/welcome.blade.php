<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SellEase — Your Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 40%, #0f172a 100%); }
        .gradient-text {
            background: linear-gradient(90deg, #f87171, #fb923c, #f87171);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer { to { background-position: 200% center; } }
        .dark-input { background: #1e293b; border: 1px solid #334155; color: #e2e8f0; }
        .dark-input::placeholder { color: #64748b; }
        .dark-input:focus { border-color: #ef4444; outline: none; box-shadow: 0 0 0 3px rgba(239,68,68,0.2); }
    </style>
    <livewire:styles />
</head>
<body class="text-slate-100 antialiased min-h-screen flex items-center justify-center px-4">
    <livewire:login />
    <livewire:scripts />
</body>
</html>