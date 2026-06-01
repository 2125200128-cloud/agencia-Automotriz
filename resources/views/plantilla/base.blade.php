<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla.header')
</head>

<body class="min-h-screen bg-black text-white">
    @include('plantilla.navbar')

    <main>
        @yield('dinamico')
    </main>

    @include('plantilla.footer')
</body>

</html>

