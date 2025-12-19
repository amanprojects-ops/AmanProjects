<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="text-center px-4">
        <h1 class="text-9xl font-bold text-gray-300">403</h1>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Access Denied</h2>
        <p class="text-gray-600 mb-8">You don't have permission to access this page.</p>
        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Go Home</a>
    </div>
</body>
</html>
