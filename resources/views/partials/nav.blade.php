<?php

use Illuminate\Http\Client\Request;
use Illuminate\Routing\Route;

?>
<nav class="navigation">
    <div class="sitename">Blog</div>
        <a class="navButton <?= request()->is("articles") ? "selectedButton" : "" ?>" href="{{ route('articles.index') }}">Articles</a>
        @auth
            <a class="navButton <?= request()->is("categories") ? "selectedButton" : "" ?>" href="{{ route('categories.index') }}">Categories</a>
        @endauth
    </div>
    
    @guest
    <div class="login">
        <span>Login</span>
        <br><br>
        <form action="/login" method="POST">
            @csrf
            <table>
                @error("email")
                    <tr><div class="error">{{ $message }}</div></tr>
                @enderror
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input id="email" name="email" type="email" autocomplete="off" required></td>
                </tr>
                @error("password")
                    <tr><div class="error">{{ $message }}</div></tr>
                @enderror
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input id="password" name="password" type="password" autocomplete="off" required></td>
                </tr>
                <tr>
                <td><button type="submit">Login</button></td>
                </tr>
            </table>
        </form>
    </div>
    @endguest
    
    @auth 
    <div class="logout">
        
        @if(Auth::user()->premium)
            <span class="premiumMark">&#9733;</span>
        @endif
        <span>{{ Auth::user()->name }}</span>
        <br>

        <a href="{{ route('users.index') }}">My Articles</a>
        <br>

        <form action="{{ route('articles.index') }}" method="POST">
            @csrf
            <input type="hidden" name="premium" id="premium" value="1" />
            <button type="submit">Premium</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
    @endauth
</nav>