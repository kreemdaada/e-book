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

            <div class="form-group">
            <label for="description">Beschreibung:</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>
            <button type="submit">Create Book</button>
        </form>
    </div>
@endsection
