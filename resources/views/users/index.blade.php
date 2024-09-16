@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <br>
    <a class="button" href="{{ route('articles.create') }}">Write a new article</a>

    @foreach($articles as $article)
        <div class="subSection">
            <a href="{{ route('articles.show', $article->id) }}">
                @if($article->imagefile)
                    <img class="articleImg" src="{{ url('storage/'.$article->imagefile) }}">
                @endif

                <div class="articleTitle">
                    @if($article->premium)
                        <span class="premiumMark">&#9733;</span>
                    @endif
                    {{ $article->title }}
                </div>
                <div class="articleListBody">{!! nl2br($article->body) !!}</div>
                <div class="articleDate">{{ $article->created_at->format("d-m-Y") }}</div>
                <div class="articleCommentCounter">{{ count($article->comment) }} comments</div>
                @if(count($article->category) > 0)
                    <div class="articleCategories">Categories: @foreach($article->category as $category) {{$category->name}}  @endforeach </div>
                @endif
            </a>
            <br>
            <br>
            <div class="articleOptions">
                <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                    <a class="button" href="{{ route('articles.edit', $article->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you wish to delete this article? \nThis action cannot be undone.')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach

@endsection