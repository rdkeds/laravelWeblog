<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Article;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(StoreCommentRequest $request)
    {
        if(Auth::check()){

            $article = Article::find($request["article_id"]);

            if( !$article->premium || Auth::user()->premium || $article->user_id === Auth::id()){

                $validated = $request->validated();

                $validated["user_id"] = Auth::id();
    
                Comment::create($validated);
            
                return redirect()->back();
            }

        }

        return redirect()->intended("/");
    }

    public function destroy(Comment $comment) {

        if(Auth::check() && $comment->user_id == Auth::id()){
            $comment->delete();
            return redirect()->back();
        }

        return redirect()->intended("/");
        
    }
}
