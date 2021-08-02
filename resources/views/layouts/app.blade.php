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
    <link href="https://fonts.googleapis.com/css2?family=Gowun+Dodum&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Righteous&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="font-Gowun font-bold">
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
                            <div class="hidden md:block font-Righteous">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    <?php
                                        if(!isset($path) || preg_match('/board/i', $path))
                                            $path = 'board';
                                    ?>
                                    <!-- Current: "bg-purple-900 text-white", Default: "text-purple-300 hover:bg-purple-700 hover:text-white" -->
                                    <a href="{{route('board.index')}}"
                                       class="{{strtolower($path)=='board'?'bg-purple-900':''}} text-white px-3 py-2 rounded-md text-sm font-medium">Boards</a>

                                    <a href="#"
                                       class="{{strtolower($path)=='task'?'bg-purple-900':''}} text-purple-300 hover:bg-purple-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Board
                                        - Tasks</a>

                                </div>
                            </div>
                        @endauth
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Profile dropdown -->
                            <div class="ml-3 relative">
                                @auth

                                    <div class="flex gap-2 items-center">
                                        <div class="text-white text-xs font-Righteous tracking-widest">
                                            {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                                        </div>
                                        <button @click="toggleImageMenu" type="button"
                                                class="max-w-xs bg-purple-800 rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-purple-800 focus:ring-white"
                                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                            <img class="h-8 w-8 rounded-full"
                                                 src="{{asset('images/user.png')}}"
                                                 alt="user avatar">
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
                                                class="block px-4 py-2 text-sm text-purple-700 uppercase font-Righteous"
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
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 font-Righteous">
                        <!-- Current: "bg-purple-900 text-white", Default: "text-purple-300 hover:bg-purple-700 hover:text-white" -->
                        <a href="{{route('board.index')}}"
                           class="bg-purple-900 text-white block px-3 py-2 rounded-md text-base font-medium">Boards</a>

                        <a href="#"
                           class="text-purple-300 hover:bg-purple-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Board
                            - Tasks</a>

                    </div>
                @endauth

                <div class="pt-4 pb-3 border-t border-purple-700">
                    @auth()
                        <div class="flex items-center px-5">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                     src="{{asset('images/user.png')}}"
                                     alt="user avatar">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium leading-none text- tracking-widest text-white">
                                    {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}
                                </div>
                                <div
                                    class="text-sm font-medium leading-none text-purple-400">{{Auth::user()->email}}</div>
                            </div>
                        </div>
                        <div class="mt-3 px-2 space-y-1">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit"
                                        class="block font-Righteous px-3 py-2 rounded-md text-base font-medium text-purple-400 hover:text-white hover:bg-purple-700 uppercase"
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

        <header class="bg-purple-900 border-b border-purple-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @auth()
                    <h1 class="text-md font-bold text-white font-Merienda">
                        @yield('path', $path??'Boards')
                    </h1>
                @else
                    <h3 class="text-md font-bold text-white font-Merienda">
                        Join us and login or get your free account now !
                    </h3>
                @endauth
            </div>
        </header>

        <main class="bg-notehub-white min-h-screen">
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <div class="px-4 py-6 sm:px-0">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>
