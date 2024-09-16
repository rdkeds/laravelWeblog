<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

//session
Route::post("/login", [SessionController::class, "authenticate"])->name("login.authenticate");
Route::post("/logout", [SessionController::class, "logout"])->name("logout");

//articles
Route::get("/articles", [ArticleController::class, "index"])->name("articles.index");
Route::post("/articles", [ArticleController::class, "index"])->name("articles.index.search");
Route::get("/articles/{article}", [ArticleController::class, "show"])->name("articles.show");

//articles user related
Route::get("/user/articles", [UserController::class, "index"])->name("users.index");
Route::get("/user/articles/create", [ArticleController::class, "create"])->name("articles.create");
Route::post("/user/articles", [ArticleController::class, "store"])->name("articles.store");
Route::get("/user/articles/{article}/edit", [ArticleController::class, "edit"])->name("articles.edit");
Route::put("/user/articles/{article}", [ArticleController::class, "update"])->name("articles.update");
Route::delete("/user/articles/{article}", [ArticleController::class, "destroy"])->name("articles.destroy");

//premium
Route::get("/user/premium", [UserController::class, "premium"])->name("users.premium");
Route::post("/users/premium", [UserController::class, "updatePremium"])->name("users.premium.update");

//comments
Route::post("/comment", [CommentController::class, "store"])->name("comments.store");
Route::delete("/comment/{comment}", [CommentController::class, "destroy"])->name("comments.destroy");

//categories
Route::get("/categories", [CategoryController::class, "index"])->name("categories.index");
Route::post("/categories", [CategoryController::class, "store"])->name("categories.store");


//reroutes
Route::redirect("/", "/articles");