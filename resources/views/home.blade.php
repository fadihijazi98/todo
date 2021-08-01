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
                <search-bar endpoint='/board/search' csrf="{{csrf_token()}}" />
            </div>
        </div>
    </div>
@endsection
