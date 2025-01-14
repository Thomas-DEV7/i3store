<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>i3 Store - @yield('title')</title>
    @vite('resources/css/app.css') <!-- Incluindo CSS compilado -->
</head>
<body>
    <header class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">i3 Store</h1>
            <nav>
                <a href="/" class="text-white mx-2">Home</a>
                <a href="/login" class="text-white mx-2">Login</a>
                <a href="/register" class="text-white mx-2">Registrar</a>
            </nav>
        </div>
    </header>
    <main class="container mx-auto my-8">
        @yield('content')
    </main>
    <footer class="bg-gray-800 text-white p-4 text-center">
        &copy; {{ date('Y') }} i3 Store. Todos os direitos reservados.
    </footer>
</body>
</html>
