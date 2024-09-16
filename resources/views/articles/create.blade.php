@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

        <h1>Write an Article</h1>
        
        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="subSection">
                
                <label for="title">Title</label><br>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required><br>
                @error("title")
                    <div class="error">{{ $message }}</div><br>
                @enderror

                <label for="body">Body</label><br>
                <textarea id="body" name="body" required>{{ old('body') }}</textarea><br>
                @error("body")
                    <div class="error">{{ $message }}</div><br>
                @enderror

                <label for="imagefile">Image</label><br>
                <input type="file" name="imagefile" value="{{ old('imagefile') }}"><br>
                @error("imagefile")
                    <div class="error">{{ $message }}</div><br>
                @enderror

                <label for="premium">Premium only</label><br>
                <input type="hidden" name="premium" value="0">                              <!-- this is disgusting there has to be a better way? -->
                <input id="premium" name="premium" type="checkbox" value="1"><br>
                @error("premium")
                    <div class="error">{{ $message }}</div><br>
                @enderror

                <label for="category">Categories</label><br>
                <select name="category_id[]" id="category" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option> 
                    @endforeach
                </select>
                @error("category")
                    <div class="error">{{ $message }}</div><br>
                @enderror

                <br>
                <br>
                <button type="submit">Save</button>
            </div>
        </form>

@endsection