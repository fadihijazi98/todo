<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') . ', welcome' }}</title>

    <!-- fonts.google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@700&family=Righteous&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body class="font-Righteous">
<!-- START HEADER -->
<header>
    <nav class="container flex items-center py-4 mt-4 sm:mt-12 border-b-2">
        <!-- logo -->
        <div class="py-1 font-Merienda text-2xl text-nothub-purple">
            <a href="/">
                To
                <span class="text-notehub-grey">
                        Do
                    </span>
            </a>
        </div>

        <!--  MENU ITEMS -->
        <ul
            class="sm:flex flex-1 justify-end items-center gap-12 font-Righteous tracking-widest text-notehub-blue uppercase text-xs hidden">
            <li>
                <a href="/">
                    Home
                </a>
            </li>
            <li>
                <a href="#feature">
                    Feature
                </a>
            </li>
            <li>
                <a href="{{route('login')}}" class="bg-notehub-red text-white p-3 rounded-sm click:bg-red-600">
                    login
                </a>
            </li>
        </ul>

        <div class="sm:hidden flex flex-1 justify-end" onclick="">
            <button class="mx-7" onclick="openMenuDrawer()">
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="bars" role="img"
                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-5 text-notehub-red">
                    <path fill="currentColor"
                          d="M442 114H6a6 6 0 0 1-6-6V84a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6zm0 160H6a6 6 0 0 1-6-6v-24a6 6 0 0 1 6-6h436a6 6 0 0 1 6 6v24a6 6 0 0 1-6 6z"
                          class=""></path>
                </svg>
            </button>
        </div>

        <!-- drawer -->
        <div id="menu" class="hidden">
            <div class="fixed z-40 inset-0 bg-purple-800 opacity-90 flex justify-center items-center">
                <div class="absolute text-white right-32 top-32">
                   <button class="w-16 h-16 bg-purple-900 flex items-center justify-center rounded-full" onclick="closeMenuDrawer()">
                       <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="times" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"
                            class="w-4">
                           <path fill="currentColor"
                                 d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z"
                                 class=""></path>
                       </svg>
                   </button>
                </div>

                <div class="relative">
                    <ul class="text-4xl text-white space-y-7">
                        <li>
                            <a href="#" class="hover:text-purple-300" onclick="closeMenuDrawer()">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#feature" class="hover:text-purple-300" onclick="closeMenuDrawer()">
                                Feature
                            </a>
                        </li>

                        <li>
                            <a href="{{route('login')}}"
                               class="bg-purple-100 p-2 rounded-sm text-purple-800 inline-block mt-5 hover:text-purple-700">
                                LOGIN
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- END HEADER -->

<!-- Hero -->
<section class="relative">
    <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
        <!-- Content -->
        <div class="flex flex-1 flex-col items-center lg:items-start">
            <h2 class="text-notehub-blue text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                A Simple TODO App
            </h2>
            <p class="text-notehub-grey text-lg text-center lg:text-left mb-6">
                A clean and simple interface to organize your tasks. Open a new browser tab and see your sites
                load instantly. Try it for free.
            </p>
            <div class="flex justify-center flex-wrap gap-6">
                <a href="{{route('register')}}">
                    <button type="button" class="btn btn-purple hover:bg-notehub-white hover:text-black">
                        Sign-up now !
                    </button>
                </a>
            </div>
        </div>
        <!-- Image -->
        <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
            <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full" src="{{ asset('images/hero-bg.png') }}"
                 alt=""/>
        </div>
    </div>
    <!-- Rounded Rectangle -->
    <div
        class="
            hidden
            md:block
            overflow-hidden
            bg-nothub-purple
            rounded-l-full
            absolute
            h-80
            w-2/4
            top-32
            right-0
            lg:
            -bottom-28
            lg:-right-36
          "
    ></div>
</section>

<!-- Features -->
<section class="bg-notehub-white py-20 mt-20 lg:mt-60 mb-10" id="feature">
    <!-- Heading -->
    <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
        <h1 class="text-3xl text-center text-notehub-blue">Features</h1>
        <p class="text-center text-notehub-grey mt-4">
            Our aim is to make it quick and easy for you to organize your tasks. Your TO-DO tasks sync between
            your devices so you can access them on the go.
        </p>
    </div>
    <!-- Feature #1 -->
    <div class="relative mt-20 lg:mt-24">
        <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
            <!-- Image -->
            <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
                <img
                    class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full"
                    src="{{ asset('images/illustration-features-tab-1.png') }}"
                    alt=""
                />
            </div>
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <h1 class="text-3xl text-notehub-blue">Todo is a drageable</h1>
                <p class="text-notehub-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                    you can drag your tasks as you want or sort by priorities of tasks.
                </p>
                <button type="button" class="btn btn-purple hover:bg-notehub-white hover:text-black">More Info</button>
            </div>
        </div>
        <!-- Rounded Rectangle -->
        <div
            class="
              hidden
              lg:block
              overflow-hidden
              bg-nothub-purple
              rounded-r-full
              absolute
              h-80
              w-2/4
              -bottom-24
              -left-36
            "
        ></div>
    </div>
    <!-- Feature #2 -->
    <div class="relative mt-20 lg:mt-52">
        <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
            <!-- Image -->
            <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
                <img
                    class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full"
                    src="{{asset('images/illustration-features-tab-2.png')}}"
                    alt=""
                />
            </div>
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <h1 class="text-3xl text-notehub-blue">Support Search</h1>
                <p class="text-notehub-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                    you can pick your task from collections of tasks or bord from collections of boards by typing in search-bar
                </p>
                <button type="button" class="btn btn-purple hover:bg-notehub-white hover:text-black">More Info</button>
            </div>
        </div>
        <!-- Rounded Rectangle -->
        <div
            class="
              hidden
              lg:block
              overflow-hidden
              bg-nothub-purple
              rounded-l-full
              absolute
              h-80
              w-2/4
              -bottom-24
              -right-36
            "
        ></div>
    </div>
    <!-- Feature #3 -->
    <div class="relative mt-20 lg:mt-52">
        <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
            <!-- Image -->
            <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
                <img
                    class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full"
                    src="{{asset('images/illustration-features-tab-3.png')}}"
                    alt=""
                />
            </div>
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
                <h1 class="text-3xl text-notehub-blue">Share your board</h1>
                <p class="text-notehub-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                    Easily share you tasks in board with others. Create a shareable link that you can send at the
                    click of a button.
                </p>
                <button type="button" class="btn btn-purple hover:bg-notehub-white hover:text-black">More Info</button>
            </div>
        </div>
        <!-- Rounded Rectangle -->
        <div
            class="
              hidden
              lg:block
              overflow-hidden
              bg-nothub-purple
              rounded-r-full
              absolute
              h-80
              w-2/4
              -bottom-24
              -left-36
            "
        ></div>
    </div>
</section>

</body>

<script defer>
    function openMenuDrawer()
    {
        document.getElementById('menu').style.display = "block";
    }

    function closeMenuDrawer()
    {
        document.getElementById('menu').style.display = "none";
    }
</script>

</html>
