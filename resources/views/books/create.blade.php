@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Book</h1>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="author">Author:</label><br>
            <select id="author" name="author_id">
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <button type="submit">Create Book</button>
        </form>
    </div>
@endsection
