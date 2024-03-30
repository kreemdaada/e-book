@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Buch bearbeiten</h1>
        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PUT') 
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}">
            </div>
            <!-- Weitere Formularfelder hier einfügen, je nach Bedarf -->
            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>
@endsection
