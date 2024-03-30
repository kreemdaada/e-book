@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bücherliste</h1>
        <ul>
            @foreach($books as $book)
                <li>{{ $book->title }}</li>
                <li>{{ $book->author }}</li>
                <li>{{ $book->description }}</li>
                <li>
                    <a href="{{ route('books.edit', $book->id) }}">Bearbeiten</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Löschen</button>
                    </form>
                </li>
            @endforeach
            <li>
                <a href="{{ route('books.create') }}">Neues Buch erstellen</a>
            </li>
        </ul>
    </div>
@endsection
