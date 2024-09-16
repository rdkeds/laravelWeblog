<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $categories = Category::get();
            return view("categories.index",  compact("categories"));
        }
    }

    public function store(StoreCategoryRequest $request)
    {
        if(Auth::check()){

            $validated = $request->validated();

            Category::create($validated);
        
            return redirect()->route("categories.index");

        }

        return redirect()->intended("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
