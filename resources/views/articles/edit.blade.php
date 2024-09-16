@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <h1>Edit Article</h1>
    
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="subSection">

            <label for="title">Title</label><br>
            <input id="title" name="title" type="text" value="{{ $article->title }}" required><br>
            @error("title")
                <div class="error">{{ $message }}</div><br>
            @enderror

            <label for="body">Body</label><br>
            <textarea id="body" name="body" required>{{ $article->body }}</textarea><br>
            @error("body")
                <div class="error">{{ $message }}</div><br>
            @enderror

            <label for="imagefile">Image</label><br>
            @if($article->imagefile)
                <div>
                    <img class="editImg" src="{{ url('storage/'.$article->imagefile) }}"><br>
                    <button class="imgDelButton" type="submit" name="removeImg" value="remove" onclick="return confirm('Are you sure you wish to delete this image? \nThis action cannot be undone.')">Delete Image</button>
                    <br><br>
                    <span class="extralabel">replace image</span>
                </div>
            @endif
            <input type="file" id="imagefile" name="imagefile"><br>
            @error("imagefile")
                <div class="error">{{ $message }}</div><br>
            @enderror
            <br>
            
            <label for="premium">Premium only</label><br>
            <input type="hidden" name="premium" value="0">                              <!-- this is disgusting there has to be a better way? -->
            <input id="premium" name="premium" type="checkbox" value="1" @if($article->premium)checked @endif><br>
            @error("premium")
                <div class="error">{{ $message }}</div><br>
            @enderror

            <label for="category">Categories</label><br>
            <select name="category_id[]" id="category" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{($article->category->contains($category)) ? "selected" : "" }} >{{ $category->name }}</option> 
                @endforeach
            </select>
            @error("category")
                <div class="error">{{ $message }}</div><br>
            @enderror

            <br>
            <br>
            <button type="submit" name="save" value="save">Save</button> 
        </div>

    </form>

@endsection