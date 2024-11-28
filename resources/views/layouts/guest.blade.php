<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>JANOLO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=pacifico|figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .logo-text {
                font-family: 'Pacifico', cursive; /* Custom script-style font */
                color: #0f766e; /* Dark green shade */
                font-size: 2rem; /* Adjust font size */
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
                display: block;
            }

            .logo-wrapper {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .logo-image {
                width: 10rem; /* Adjust image size */
                height: 5rem;
            }

            /* Add styles for the background with opacity */
            .bg-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-image: url('{{ asset('images/bg.png') }}');
                background-size: cover;
                background-position: center;
                z-index: -1;
                opacity: 0.2;
            }


            .content-wrapper {
                position: relative;
                z-index: 1;
            }

            /* To ensure the text remains clear */
            .bg-opacity-content {
                background-color: rgba(255, 255, 255, 0.8); /* Optional: add a light semi-transparent background */
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-cyan-100">

        <div class="bg-overlay"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 content-wrapper">
            <div class="logo-wrapper ">
                <a href="/" wire:navigate>
                    <img src="{{ asset('images/dental.png') }}" class="logo-image" alt="Dental Logo">
                    <span class="logo-text">JANOLO</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-opacity-content">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
