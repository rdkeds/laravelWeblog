<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->category_id;
        $premium = $request->premium;

        if($premium !== null){
            if(!Auth::check() || !Auth::user()->premium) {
                return redirect()->route("users.premium");
            }
        }

        $articles = Article::when($category_id, function($query, int $category_id) {
            $query->whereRelation("category", "category_id", $category_id );
        })->when($premium, function($query) {
            $query->where("premium", 1);
        })->with("category")->orderByDesc("created_at")->get();
        
        return view("articles.index", compact("articles", "categories", "category_id", "premium"));
    }

    public function create()
    {
        if(Auth::check()){
            $categories = Category::all();
            return view("articles.create", compact("categories"));
        }

        return redirect()->intended("/");
    }

    public function store(StoreArticleRequest $request) {

        if(Auth::check()){

            $validated = $request->validated();

            $validated["user_id"] = Auth::id();

            if(isset($validated["imagefile"])){
                $path = $validated["imagefile"]->store("public");
                $validated["imagefile"] = basename($path);
            }

            $article = Article::create($validated);

            if(isset($validated["category_id"])){
                $article->category()->attach($validated["category_id"]);
            }
        
            return redirect()->route("articles.show", compact("article"));

        }

        return redirect()->intended("/");

    }

    public function show(Article $article)
    {
        if(!$article->premium || Auth::check() && Auth::user()->premium || Auth::check() && $article->user_id == Auth::id()){
            $comments = $article->comment()->orderByDesc("created_at")->get();
            return view("articles.show", compact("article", "comments"));
        }

        return redirect()->route("users.premium");
    }

    public function edit(Article $article) {
        
        if(Auth::check() && $article->user_id == Auth::id()){
            $categories = Category::all();
            return view("articles.edit", compact("article", "categories")); 
        }

        return redirect()->intended("/");
    }


    public function update(UpdateArticleRequest $request, Article $article) {

        if(Auth::check() && $article->user_id == Auth::id()){

            if(isset($request["save"])){

                $validated = $request->validated();

                $validated["user_id"] = Auth::id();

                if(isset($validated["imagefile"])){
                    if(isset($article["imagefile"])){
                        $this->destroyImg($article["imagefile"]);
                    }
                    $path = $validated["imagefile"]->store("public");
                    $validated["imagefile"] = basename($path);
                }

                $article->update($validated);

                if(isset($validated["category_id"])){
                    $article->category()->sync($validated["category_id"]);
                }

                return redirect()->route("articles.show", compact("article"));
            } 
            else if (isset($request["removeImg"])){
                $this->destroyImg($article["imagefile"]);
                $article["imagefile"] = null;
                $article->save();
            }

            $categories = Category::all();
            return view("articles.edit", compact("article", "categories"));

        }

        return redirect()->intended("/");
    
    }

    public function destroy(Article $article) {

        if(Auth::check() && $article->user_id == Auth::id()){
            
            if(isset($article["imagefile"])){
                $this->destroyImg($article["imagefile"]);
            }

            foreach($article->comment()->get() as $comment){
                $comment->delete();
            }

            $article->delete();
            return redirect()->route("users.index");
        }

        return redirect()->intended("/");
        
    }

    private function destroyImg(string $filename){
        //if statement exists to not delete test image files used for factory generated posts
        if(strlen($filename) > 5){
            Storage::delete("public/". $filename);
        }
    }

}
