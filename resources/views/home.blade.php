@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex flex-col sm:flex-row gap-8">
            <div class="bg-green-500 text-white p-8 rounded-sm font-bold">
                Good Job
                <span
                    class="tracking-widest font-extrabold inline-block px-4 p-2 bg-green-600 rounded-sm mr-1 font-Righteous">
                {{ explode(' ', \Illuminate\Support\Facades\Auth::user()->name)[0] }} !
                </span>
                <br/>
                You have
                <span class="font-Righteous tracking-widest">
                    {{ $completed_tasks }}
                </span>
                tasks completed this day.
            </div>
            <div class="bg-purple-800 text-white p-16 rounded-sm font-bold sm:m-0 mt-2">
                <span
                    class="tracking-widest font-extrabold inline-block px-4 p-2 bg-purple-900 rounded-sm mr-1 font-Righteous">
                {{ explode(' ', \Illuminate\Support\Facades\Auth::user()->name)[0] }}
                </span>
                You have
                <span class="font-Righteous tracking-widest">
                    {{ $pending_tasks }}
                </span>
                tasks pending (todo).
            </div>
        </div>

        <div class="mt-8">
            <h1 class="text-purple-800 text-xl">
                # Your Task Boards
            </h1>
            <div>
                <search-bar endpoint='/board/search' csrf="{{csrf_token()}}"/>
            </div>
            <div class="mt-8 grid grid-cols-2 gap-8">
                @foreach($boards as $board)
                    <div class="bg-white my-4 p-6 rounded-sm">
                        <div class="flex justify-between items-center">
                            <a href="/board/{{$board->id}}" class="text-purple-800 tracking-wide text-lg">
                                Board: {{ $board->name }}
                            </a>
                            <form action="{{ route('board.destroy', $board) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="bg-notehub-white w-10 h-10 rounded-full flex items-center justify-center">
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
                        <div class="text-notehub-grey">
                            {{$board->description}}
                        </div>
                        <div class="mt-8 flex flex-col sm:flex-row gap-2">
                            <div class="bg-purple-900 px-4 p-1 rounded-sm text-white">
                                {{ $board->count_tasks }} tasks
                            </div>
                            <div class="bg-green-500 mx-4 px-4 p-1 rounded-sm text-white">
                                {{ $board->count_completed_tasks }} completed
                            </div>
                            <div class="bg-red-500 px-4 p-1 rounded-sm text-white">
                                {{ $board->count_pending_tasks }} pending
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                {{ $boards->links() }}
            </div>

        </div>
    </div>
@endsection
