@extends('layouts.dashboard')

@section('content')
    <div class="">
        <div class="flex flex-col-reverse sm:flex-row flex-row justify-center py-12 px-4 sm:px-6 lg:px-8 gap-3">
            <div class="">
                <form action="{{route('task.update', $task)}}" method="post" class="mt-8 space-y-6">
                    @csrf
                    @method('put')

                    <input name="user_id" value="{{Auth::id()}}" hidden>

                    <div class="rounded-md shadow-sm -space-y-px">
                        <div class="">
                            <label for="title" class="sr-only">name</label>
                            <input id="title" name="title" type="text" autocomplete="name" required
                                   value="{{$task->title}}"
                                   class="appearance-none rounded-none relative block w-full px-3 py-2
                                   border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md
                                   focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm
                                   @error('name') border border-red-500 @enderror"
                                   placeholder="task title">

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

                                   value="{{ $task->description }}"
                                   placeholder="description. maximum 255 char.">
                        </div>
                    </div>

                    <div class="">
                        <label for="priority" class="sr-only">priority</label>
                        <select id="priority" name="priority" autocomplete="priority"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md
                                 shadow-sm focus:outline-none focus:ring-indigo-500
                                  focus:border-indigo-500 sm:text-sm @error('priority') border border-red-500 @enderror">
                            <option class="text-yellow-600" value="low" {{$task->priority=='low'?'selected':''}}>
                                LOW
                            </option>
                            <option class="text-blue-600" value="mid" {{$task->priority=='mid'?'selected':''}}>
                                MID
                            </option>
                            <option class="text-red-600" value="high" {{$task->priority=='high'?'selected':''}}>
                                HIGH
                            </option>

                        </select>

                        @error('priority')
                        <span class="text-red-500 text-sm inline-block pb-4 px-1" role="alert">
                                        {{ $message }}
                                </span>
                        @enderror
                    </div>

                    <div class="">
                        <label for="status" class="sr-only">priority</label>
                        <select id="status" name="status" autocomplete="status"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md
                                 shadow-sm focus:outline-none focus:ring-indigo-500
                                  focus:border-indigo-500 sm:text-sm @error('status') border border-red-500 @enderror">
                            <option class="" value="pending" {{$task->status=='pending'?'selected':''}}>
                                pending
                            </option>
                            <option class="" value="completed" {{$task->status=='completed'?'selected':''}}>
                                completed
                            </option>
                        </select>

                        @error('status')
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

            <form action="{{route('task.destroy', $task)}}" method="post">
                @csrf
                @method('delete')

                <button class="w-10 h-10 flex items-center justify-center border border-red-600 rounded-full">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash"
                         role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                         class="text-notehub-red w-4">
                        <path fill="currentColor"
                              d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"
                              class=""></path>
                    </svg>
                </button>
            </form>

        </div>
    </div>
@endsection
