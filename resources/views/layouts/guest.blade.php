<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#22305D] via-[#EBE2E1] to-[#C81617]/80 text-gray-900">

    <div class="min-h-screen flex flex-col justify-center items-center px-4">
        <!-- Logo -->
        <div class="mb-6">
            <a href="/">
                <x-application-logo class="w-24 h-24 fill-current text-[#030304]" />
            </a>
        </div>

        <!-- Card Container con animación -->
        <div
            data-aos="fade-up"
            data-aos-duration="1000"
            class="w-full max-w-md backdrop-blur-md bg-[#EBE2E1]/60 border border-white/30 shadow-2xl rounded-2xl p-8"
        >
            {{ $slot }}
        </div>
    </div>

</body>
</html>
