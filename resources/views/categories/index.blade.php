@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div class="subSection">
        <h1>All existing categories</h1>
        <ul>
        @foreach($categories as $category)
            <li>{{$category->name}}</li>
        @endforeach
        </ul>
    </div>

    <div class="subSection">
        <h1>Add a new category</h1>
        
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label for="name">Name</label><br>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required><br>
            @error("name")
                <div class="error">{{ $message }}</div><br>
            @enderror

            <br>
            <button type="submit">Save</button>
        </form>

    </div>

@endsection