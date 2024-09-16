@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div class="hCenter">
        <br>
        <h1>
            Buy <span class="gold shiny">Premium</span> now! 
        </h1>
        <br>
        <h2>
            and get acess to all <span class="gold shiny">Premium</span> content on Blog.
            <br>
            Currently free for an unlimited time
        </h2>
        <br>

        <form action="{{ route('users.premium.update') }}" method="POST">
            @csrf
            <input type="hidden" name="premium" value="1"> 
            <button class="goldButton shiny" type="submit" >Buy now!</button>
        </form>

        <br>
        <br>
    </div>

@endsection