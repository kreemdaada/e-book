@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create New Book</h1>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title"><br>
            <label for="author">Author:</label><br>
            <input type="text" name="author" value="{{ old('author') }}" class="form-control" placeholder="Autorname" required>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <button type="submit">Create Book</button>
        </form>
    </div>
@endsection
