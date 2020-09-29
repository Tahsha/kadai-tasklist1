
@extends('layouts.app')
@section('content')
    @if (Auth::check())
        @include('tasks.index')
           
    @else
        <div class="center jumbotron ">
            <div class="text-center">
                <h1>Welcome to the Tasklist</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-info']) !!}
            </div>
        </div>
        <div class="text-center">
            <p class="text-success">You can use this app to manage your tasks!</p>
        </div>
    @endif
@endsection