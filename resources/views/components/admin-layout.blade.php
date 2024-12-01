<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>JANOLO</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <style>
        [x-cloak] {
            display: none;
        }

        #logo {
            font-family: "Anton", sans-serif;
            font-weight: 600;
            font-size: 30px;
            font-style: normal;
        }

        #logotext{

font-family: 'Pacifico', cursive; /* Custom script-style font */
    color: white; /* Dark green shade */
    font-size: 2rem; /* Adjust font size */

    display: block;
}

    </style>




    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @wireUiScripts
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50">
    <x-notifications position="top-right" />

    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-700 rounded-lg sm:hidden hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar"
        class="border fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-teal-600">
            <ul class="space-y-2 font-medium">
                <a href="{{ route('Admindashboard') }}">
                    <div class="flex flex-col items-center h-full px-3 overflow-y-auto rounded-lg">
                        <div class="">
                            <img src="{{ asset('images/dental.png') }}" alt="Violation Photo" class="w-16 h-16">
                        </div>
                        <div class="text-center mt-2">
                            <label for="" class="font-black text-white " id="logotext">JANOLO</label>
                        </div>
                    </div>
                </a>

                <li>
                    <a href="{{ route('Admindashboard')    }}"
                        class="flex items-center p-2 text-white hover:text-teal-800 rounded-lg hover:bg-teal-100 group">
                        <i class="ri-dashboard-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.add-service') }}"
                        class="flex items-center p-2 text-white hover:text-teal-800 rounded-lg hover:bg-teal-100 group">
                        <i class="ri-add-box-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Add Services</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.appointment') }}"
                        class="flex items-center p-2 text-white hover:text-teal-800 rounded-lg hover:bg-teal-100 group">
                        <i class="ri-contract-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.schedule') }}"
                        class="flex items-center p-2 text-white hover:text-teal-800 rounded-lg hover:bg-teal-100 group">
                        <i class="ri-calendar-schedule-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.faq') }}"
                        class="flex items-center p-2 text-white hover:text-teal-800 rounded-lg hover:bg-teal-100 group">
                        <i class="ri-information-fill"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">FAQ</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="flex justify-between text-gray-800 p-10">
        <div class="ml-72">
            {{-- Add your logo or branding --}}
        </div>
        <div>
            <span class="text-teal-700 font-bold">{{ Auth::user()->name }}</span>
            <x-dropdown>
                <x-dropdown.item label="Logout" href="{{ route('logout') }}" />
            </x-dropdown>
        </div>
    </div>

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-gray-300 rounded-lg bg-white">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
