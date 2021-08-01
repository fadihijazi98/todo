@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex items-center justify-center bg-white py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8">
                <div>
                    <h1 class="text-3xl text-center py-3 uppercase text-purple-800 font-Merienda">
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                        Get your free account
                    </h2>
                    <p class="mt-2 text-center text-sm text-gray-600">
                        Or
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Free Sign in
                        </a>
                    </p>
                </div>
                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="">
                            <label for="name" class="sr-only">name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required
                                   class="appearance-none rounded-none relative block w-full px-3 py-2
                                   border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm
                                   @error('name') border border-red-500 @enderror"

                                   value="{{ old('name') }}"
                                   placeholder="First, last name">

                            @error('name')
                            <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" name="email" type="email" autocomplete="email" required
                                   class="appearance-none rounded-none relative block w-full px-3 py-2
                                   border border-gray-300 placeholder-gray-500 text-gray-900
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm
                                   @error('email') border border-red-500 @enderror"

                                   value="{{ old('email') }}"
                                   placeholder="Email address">

                            @error('email')
                            <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                   required
                                   class="appearance-none @error('password') border border-red-500 @enderror rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                   placeholder="Password">

                            @error('password')
                            <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div>
                            <label for="password-confirm" class="sr-only">Password</label>
                            <input id="password-confirm" name="password_confirmation" type="password"
                                   autocomplete="new-password"
                                   required
                                   class="appearance-none @error('password') border border-red-500 @enderror rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                   placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <div class="text-sm">
                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                your tasks wait you !
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit"
                                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Register
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
