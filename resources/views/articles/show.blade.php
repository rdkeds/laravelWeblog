@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <div class="subSection">
        @if($article->imagefile)
            <img class="articleImg" src="{{ url('storage/'.$article->imagefile) }}">
        @endif
        <div class="articleTitle">{{ $article->title }}</div><br>
        <div class="articleBody">{!! nl2br($article->body) !!}</div><br>
        <div class="articleAuthor">This article was authored by: {{ $article->user->name }}</div>
        <div class="articleDate">{{ $article->created_at->format("d-m-Y") }}</div>
        @if(count($article->category) > 0)
            <div class="articleCategories">Categories: @foreach($article->category as $category) {{$category->name}}  @endforeach </div>
        @endif
    </div>
    <br>

    <h1>Comments</h1>

    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="comment">

                <label for="body">Leave a comment</label><br>
                <textarea id="body" name="body" required>{{ old('body') }}</textarea><br>
                @error("body")
                    <div class="error">{{ $message }}</div><br>
                @enderror 
                <input type="hidden" name="article_id" value="{{$article->id}}">

                <button type="submit">Comment</button>
            </div>
        </form>
    @endauth
        
    @guest 
        <div class="comment">
            Please login at the top right to leave a comment
        </div>
    @endguest

    @foreach($comments as $comment)
    <div class="comment">
        <div class="commentName">{{ $comment->user->name }}</div>
        <div class="commentBody">{{ $comment->body }}</div>
        <div class="commentDate">{{ $comment->created_at->format("d-m-Y") }}</div>
        @if($comment->user_id === Auth::id())
        <div class="commentDelete">
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Are you sure you wish to delete this comment? \nThis action cannot be undone.')">Delete</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach

@endsection