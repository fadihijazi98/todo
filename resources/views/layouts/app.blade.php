<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Righteous&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="font-Righteous">
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div>
        <nav class="bg-purple-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 text-white font-Merienda uppercase">
                            <a href="/">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        @auth()
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <!-- Current: "bg-purple-900 text-white", Default: "text-purple-300 hover:bg-purple-700 hover:text-white" -->
                                    <a href="#"
                                       class="bg-purple-900 text-white px-3 py-2 rounded-md text-sm font-medium">Boards</a>

                                    <a href="#"
                                       class="text-purple-300 hover:bg-purple-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Tasks</a>

                                    <a href="#"
                                       class="text-purple-300 hover:bg-purple-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Completed
                                        tasks</a>

                                    <a href="#"
                                       class="text-purple-300 hover:bg-purple-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Pending
                                        tasks</a>
                                </div>
                            </div>
                        @endauth
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                @auth

                                    <div>
                                        <button @click="toggleImageMenu" type="button"
                                                class="max-w-xs bg-purple-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-purple-800 focus:ring-white"
                                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                            <img class="h-8 w-8 rounded-full"
                                                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                 alt="user avatar image">
                                        </button>
                                    </div>
                                @else
                                    <a href="{{route('login')}}"
                                       class="px-4 py-2 text-sm text-white uppercase"
                                       role="menuitem" tabindex="-1" id="user-menu-item-2">login
                                    </a>
                                    <a href="{{route('register')}}"
                                       class="px-4 py-2 text-sm text-white uppercase"
                                       role="menuitem" tabindex="-1" id="user-menu-item-2">register
                                    </a>
                                @endauth

                                <div v-if="imageMenuVisibility" id="sub-menu"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                     tabindex="-1">
                                    <form action="{{route('logout')}}" method="post">
                                        @csrf
                                        <button type="submit"
                                                class="block px-4 py-2 text-sm text-purple-700 uppercase"
                                                role="menuitem" tabindex="-1" id="user-menu-item-2">sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="-mr-2 flex md:hidden" @click="toggleMenuInSmallScreen">
                        <!-- Mobile menu button -->
                        <button type="button"
                                class="bg-purple-800 inline-flex items-center justify-center p-2 rounded-md text-purple-400 hover:text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-purple-800 focus:ring-white"
                                aria-controls="mobile-menu" aria-expanded="false">
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="md:hidden" id="mobile-menu" v-if="menuInSmallScreenVisibility">

                @auth()
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <!-- Current: "bg-purple-900 text-white", Default: "text-purple-300 hover:bg-purple-700 hover:text-white" -->
                        <a href="#"
                           class="bg-purple-900 text-white block px-3 py-2 rounded-md text-base font-medium">Boards</a>

                        <a href="#"
                           class="text-purple-300 hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Tasks</a>

                        <a href="#"
                           class="text-purple-300 hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Completed
                            tasks</a>

                        <a href="#"
                           class="text-purple-300 hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Pending
                            tasks</a>
                    </div>
                @endauth

                <div class="pt-4 pb-3 border-t border-purple-700">
                    @auth()
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                     alt="">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text-white">user</div>
                                <div class="text-sm font-medium leading-none text-purple-400">user@example.com</div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-purple-400 hover:text-white hover:bg-purple-700 uppercase"
                                        role="menuitem" tabindex="-1" id="user-menu-item-2">sign out
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-3 px-2 space-y-1">
                            <a href="{{route('login')}}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-purple-400 hover:text-white hover:bg-purple-700 uppercase"
                               role="menuitem" tabindex="-1" id="user-menu-item-2">
                                log in
                            </a>
                            <a href="{{route('register')}}"
                               class="block px-3 py-2 rounded-md text-base font-medium text-purple-400 hover:text-white hover:bg-purple-700 uppercase"
                               role="menuitem" tabindex="-1" id="user-menu-item-2">
                                register
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>

        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-purple-900 font-Merienda">
                    Boards
                </h1>
            </div>
        </header>

        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <!-- Replace with your content -->
                <div class="px-4 py-6 sm:px-0">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
                <!-- /End replace -->
            </div>
        </main>
    </div>
</div>
</body>
</html>