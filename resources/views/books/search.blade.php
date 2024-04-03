@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-primary">Suchergebnisse</h1>
        @if($books->isEmpty())
            <p>Keine Bücher gefunden.</p>
        @else
            <ul class="list-group">
                @foreach($books as $book)
                    <li class="list-group-item">
                        <h3>{{ $book->title }}</h3>
                        <p><strong>Autor:</strong> {{ $book->author }}</p>
                        <p><strong>Beschreibung:</strong> {{ $book->description }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
