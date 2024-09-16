@extends('layouts.app')

@section('title', 'Page Title')

@section('content')

    <h2 class="noMargin">Filters</h2>
    <form action="{{ route('articles.index.search') }}" method="POST">
        @csrf
        <div class="filter">
            <label for="category">Category</label><br>
            <select name="category_id" id="category" onchange="this.form.submit()" required>
                <option value=> All Categories </option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{($category->id == $category_id) ? "selected" : "" }} >{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter">
            <label for="premium">Premium Only</label><br>
            <input id="premium" name="premium" type="checkbox" value="1" @if($premium)checked @endif onchange="this.form.submit()"><br>
        </div>
    </form>

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
                <div class="articleAuthor">{{ $article->user->name }}</div>
                <div class="articleDate">{{ $article->created_at->format("d-m-Y") }}</div>
                <div class="articleCommentCounter">{{ count($article->comment) }} comments</div>
                @if(count($article->category) > 0)
                    <div class="articleCategories">Categories: @foreach($article->category as $category) {{$category->name}}  @endforeach </div>
                @endif
            </a>
        </div>
    @endforeach

@endsection