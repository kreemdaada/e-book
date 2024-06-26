@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-primary">Bücherliste</h1>
        <ul class="list-group">
            @foreach($books as $book)
                <li class="list-group-item">
                    <h3>{{ $book->title }}</h3>
                    <p><strong>Autor:</strong> {{ $book->author }}</p>
                    <p><strong>Beschreibung:</strong> {{ $book->description }}</p>
                    <div class="btn-group" role="group" aria-label="Buch-Optionen">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary mx-2 my-1">Bearbeiten</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mx-2 my-1">Löschen</button>
                        </form>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <a href="{{ route('books.index') }}" class="btn btn-success">Neues Buch erstellen</a>
            </li>
        </ul>
    </div>
@endsection
