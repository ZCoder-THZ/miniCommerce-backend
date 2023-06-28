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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        #mmap {

            height: 200px;



        }
    </style>
</head>

<body class="font-sans antialiased overflow-x-hidden">

    <div class="flex items-center justify-between md:justify-end lg:justify-end bg-slate-600 ">
        <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
            aria-controls="sidebar-multi-level-sidebar" type="button"
            class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                </path>
            </svg>
        </button>


        <div class=" bg-gray-200 flex justify-center items-center dark:bg-gray-500">
            <div x-data="{ open: false }"
                class="bg-white dark:bg-gray-800 w-64  shadow flex justify-center items-center">
                <div @click="open = !open" class="relative border-b-4 border-transparent py-3"
                    :class="{ 'border-indigo-700 transform transition duration-300 ': open }"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100">
                    <div class="flex justify-center items-center space-x-3 cursor-pointer">
                        <div class="w-12 h-12 rounded-full overflow-hidden border-2 dark:border-white border-gray-900">

                            @if (Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                    class="w-full h-full object-cover" alt="">
                            @else
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/Windows_10_Default_Profile_Picture.svg"
                                    class="w-full h-full object-cover" alt="">
                            @endif

                        </div>
                        <div class="font-semibold dark:text-white text-gray-900 text-lg">
                            <div class="cursor-pointer">{{ Auth::user()->name }}</div>
                        </div>
                    </div>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute w-60 px-5 py-3 dark:bg-gray-800 bg-white rounded-lg shadow border dark:border-transparent mt-5">
                        <ul class="space-y-3 dark:text-white">
                            <li class="font-medium">
                                <a href="{{ route('getProfile') }}"
                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                    <div class="mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    Account
                                </a>
                            </li>
                            <li class="font-medium">
                                <a href="#"
                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-indigo-700">
                                    <div class="mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    Setting
                                </a>
                            </li>
                            <hr class="dark:border-gray-700">
                            <li class="font-medium">
                                <a href="#"
                                    class="flex items-center transform transition-colors duration-200 border-r-4 border-transparent hover:border-red-600">
                                    <div class="mr-3 text-red-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                    </div>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit">Logout</button>
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <aside id="sidebar-multi-level-sidebar"
        class="fixed top-0 left-0 z-40 w-64  h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-blue-200  ">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('itemList') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100 {{ request()->route()->getName() == 'itemList'? 'bg-blue-500': '' }}">
                        <svg aria-hidden="true"
                            class="w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Items</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('category#getCategoryList') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 {{ request()->route()->getName() == 'category#getCategoryList'? 'bg-blue-500': '' }}">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        <span class="flex-1 ml-3 whitespace-nowrap">Categories</span>
                        <span
                            class="inline-flex items-center justify-center px-2 ml-3 text-sm font-medium text-gray-800 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-300">Pro</span>
                    </a>
                </li>

            </ul>
            <div class="bg-blue-500 py-3 flex justify-center text-white rounded-md mt-12">

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </aside>


    <main>
        @yield('content')
    </main>

    <div id="mmap">


    </div>

    @livewireScripts

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script> --}}
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor', {
            height: 300, // Set the height of the editor
            toolbar: 'Basic', // Use the 'Basic' toolbar configuration
            language: 'en' // Set the language to English
        });
    </script>

    {{-- <script src="../path/to/flowbite/dist/flowbite.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>



</body>

</html>
