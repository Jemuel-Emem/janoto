<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JANOLO</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Figtree:400,500,600&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none;
        }

        #logo {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 30px;
            font-style: normal;
            color: #009688;
        }

        body {
            color: #fff;
        }

        .header {
            background-color: #20333d;
            color: #fff;
            border-bottom: 3px solid #009688;
        }

        .header a {
            color: #acad93;
            transition: color 0.3s ease;
        }

        .header a:hover {
            color: #009688;
        }

        .header a.active {
            font-weight: bold;
            color: #009688;
        }

        /* .main {
            background-color: #50646c;
            border: 1px solid #009688;
            color: #f8f8f8;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        } */

        .nav-item {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-align: center;
        }

        .nav-item:hover {
            background-color: #009688;
            color: #fff;
        }

        .dropdown {
            background-color: #20333d;
            color: #fff;
            border: 1px solid #818287;
            border-radius: 5px;
        }

        .dropdown a {
            color: #009688;
        }

        .dropdown a:hover {
            background-color: #009688;
            color: #fff;
        }

        .footer {
            background-color: #20333d;
            color: #acad93;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }

        #logotext{

            font-family: 'Pacifico', cursive; /* Custom script-style font */
                color: #0f766e; /* Dark green shade */
                font-size: 2rem; /* Adjust font size */
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
                display: block;
        }


        @media (max-width: 768px) {
            .header {
                padding: 1rem;
            }

            .nav-item {
                padding: 0.75rem 1rem;
            }

            .nav-item:hover {
                background-color: #009688;
                color: #fff;
            }

            /* Hamburger Menu */
            .header .hamburger {
                display: block;
                cursor: pointer;
            }

            .header .nav-links {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #20333d;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                z-index: 10;
            }

            .header .nav-links.open {
                display: flex;
            }

            .header .nav-links a {
                padding: 1rem;
                width: 100%;
                text-align: center;
                border-bottom: 1px solid #818287;
            }

            .header .nav-links a:hover {
                background-color: #009688;
                color: #fff;
            }
            .footer {
            background-color: #20333d;
            color: #acad93;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }

            .header .dropdown {
                width: 100%;
            }

            .main {
                padding: 1rem;
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
</head>

<body class="font-sans antialiased h-screen bg-gradient-to-r from-green-500 to-white">

    @livewireScripts
    <div class="header w-full mx-auto">
        <div class="relative flex flex-col items-center p-5 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="flex items-center justify-between w-full">
                <a class="text-lg tracking-tight uppercase focus:outline-none focus:ring lg:text-2xl" href="/">
                    <span id="logo" class="flex items-center">
                        <img src="{{ asset('images/dental.png') }}" alt="Dental Logo" class="w-12 h-12 mr-2">
                        <span class="logotext" id="logotext">JANOLO</span>
                    </span>
                </a>
                <!-- Hamburger Icon -->
                <button class="hamburger text-grayishyellow md:hidden" @click="open = !open">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <!-- Navigation Links -->
            <nav class="nav-links flex-col items-center hidden md:flex md:flex-row">
                <a href="{{ route('user-dashboard') }}" class="nav-item text-grayishyellow">Home</a>
                <a href="{{ route('user.services') }}" class="nav-item text-grayishyellow">Services</a>
                <a href="{{ route('user.appointment') }}" class="nav-item text-grayishyellow">Appointment</a>
                <a href="{{ route('user.faqs') }}" class="nav-item text-grayishyellow">FAQS</a>
                <a href="{{ route('user.terms') }}" class="nav-item text-grayishyellow">Terms&Condition</a>
                <div class="relative">

                    <button
                        class="text-grayishyellow bg-darkgreen px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-darkgreen"
                        onclick="toggleDropdown()">
                        Settings
                    </button>
                    <div
                        id="dropdownMenu"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 hidden z-10">
                        <a href="{{ route('logout') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            Logout
                        </a>
                        <a href="{{ route('user.profile') }}"
                           class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            Profile
                        </a>
                    </div>
                </div>
            </nav>
            <div class="relative mt-4 md:mt-0 md:ml-5" x-data="{ dropdownOpen: false }" @click.away="dropdownOpen = false">
                {{-- <button @click="dropdownOpen = !dropdownOpen" class="flex items-center text-sm font-medium text-grayishyellow hover:text-white">
                    <span class="mr-2">{{ Auth::user()->name }}</span>
                    <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5.293 9.293a1 1 0 011.414 0L10 12.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button> --}}
                {{-- <div x-show="dropdownOpen" class="dropdown absolute right-0 mt-2 w-48 py-2">
                    <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="flex justify-center mt-8 p-4">
        <div class="main w-full sm:max-w-8xl ">
            <main>
                {{ $slot }}
            </main>



        </div>


    </div>


    <script>
        document.querySelector('.hamburger').addEventListener('click', function() {
            const navLinks = document.querySelector('.nav-links');
            navLinks.classList.toggle('open');
        });

        function toggleDropdown() {
        const dropdown = document.getElementById('dropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function (e) {
        const dropdown = document.getElementById('dropdownMenu');
        const button = e.target.closest('button');
        if (!button && dropdown && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    });
    </script>


</body>

</html>
