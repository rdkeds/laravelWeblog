<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class UserController extends Controller
{

    public function index()
    {
        if(Auth::check()){
            //intelliphense does not like anything Auth::user() related
            $articles = Auth::user()->article()->with("category")->orderByDesc("created_at")->get();
            return view("users.index", compact("articles"));
        }

        return redirect()->intended("/");
    }

    public function premium()
    {
        if(Auth::check() && Auth::user()->premium) {
            return redirect()->route("articles.index");
        }
        else if (Auth::check()){
            return view("users.premium.buy");
        }
        
        return view("users.premium.loginrequest");
        
    }

    public function updatePremium() {

        Auth::user()->premium = 1;
        Auth::user()->save();                           //intelliphense does not like anything Auth::user() related

        return redirect()->route("users.premium");
    }
}
