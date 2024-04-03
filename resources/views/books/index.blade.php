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
                        @if ($book->author_id == auth()->user()->id)
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Bearbeiten</a>
                        @else
                            <button type="button" class="btn btn-primary disabled" disabled>Bearbeiten</button>
                            <p class="text-danger">Sie haben keine Berechtigung, dieses Buch zu bearbeiten.</p>
                        @endif
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Löschen</button>
                        </form>
                    </div>
                </li>
            @endforeach
            <li class="list-group-item">
                <a href="{{ route('books.create') }}" class="btn btn-success">Neues Buch erstellen</a>
            </li>
        </ul>
    </div>
@endsection
