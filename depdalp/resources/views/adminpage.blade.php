<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between">
            <div class="text-lg font-bold">Simple Website</div>
            <ul class="flex space-x-4">
                <li><a href="/home" class="hover:underline">Home</a></li>
                <li><a href="/userPage" class="hover:underline">User</a></li>
                <li><a href="/adminPage" class="hover:underline">Admin</a></li>
            </ul>
        </div>
    </nav>

    <!-- Admin Page Content -->
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center">Admin Dashboard</h1>
        <p class="text-center mt-4">Manage site settings and user information here.</p>
    </div>
</body>
</html>