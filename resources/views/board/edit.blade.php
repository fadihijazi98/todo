@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <form action="{{route('board.store')}}" method="post" class="mt-8 space-y-6">
                @csrf

                <input name="user_id" value="{{Auth::id()}}" hidden>

                <div class="rounded-md shadow-sm -space-y-px">
                    <div class="">
                        <label for="name" class="sr-only">name</label>
                        <input id="name" name="name" type="text" autocomplete="name" required value="{{$board->name}}"
                               class="appearance-none rounded-none relative block w-full px-3 py-2
                                   border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm
                                   @error('name') border border-red-500 @enderror"
                               placeholder="board name">

                        @error('name')
                        <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="">
                        <label for="description" class="sr-only">description</label>
                        <input id="description" name="description" type="text" autocomplete="description"
                               class="appearance-none rounded-none relative block w-full px-3 py-2
                                   border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-sm
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"

                               value="{{ $board->description }}"
                               placeholder="description. maximum 255 char.">
                    </div>
                </div>

                <div class="">
                    <label for="color" class="sr-only">color</label>
                    <select id="color" name="color_id" autocomplete="color"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md
                                 shadow-sm focus:outline-none focus:ring-indigo-500
                                  focus:border-indigo-500 sm:text-sm @error('color_id') border border-red-500 @enderror">
                        @foreach($colors as $color)
                            <option value="{{$color->id}}" {{$color->id==$board->color_id?'selected':''}}>
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('color_id')
                    <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                    @enderror
                </div>


                <div class="flex items-center justify-end">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                            lets go ..
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update, Go
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
