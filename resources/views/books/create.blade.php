@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create New Book</h1>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="{{ old('author') }}" class="form-control" placeholder="Autorname" required>
        </div>
        <div class="form-group">
            <label for="description">Beschreibung:</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Book</button>
    </form>
</div>
@endsection
