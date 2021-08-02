@extends('layouts.app')

@section('layout')
    <div class="bg-notehub-white min-h-screen flex items-center justify-center">
        <div>
            <tasks-component :tasks="{{$tasks->values()->toJson()}}" :in_share_mode="true" />
        </div>
    </div>
@endsection
