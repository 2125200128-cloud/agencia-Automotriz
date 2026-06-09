<!DOCTYPE html>
<html lang="es">

<head>
    @include('plantilla.header')
</head>

<body class="min-h-screen bg-[#090909] text-[#9E9EA2]">
    @include('plantilla.navbar')
    <main>
        @yield('dinamico')
    </main>
    @include('plantilla.footer')
</body>

</html>
