<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('includes.navbar')

<div class="container mt-5">
    <h1 class="text-danger">E-Book Lesen und Hochladen.</h1>
    @auth
    <h5>Willkommen zurück, <span class="text-secondary">{{ auth()->user()->name }}</span></h5>
    @endauth
    <div class="card mt-3">
        <div class="card-header">
           <h4> Unsere Bücher</h4>
        </div>
        
        @isset($books)
            @if($books->count() > 0)
                @foreach($books as $book)
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="card-title text-success">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->description }}</p>
                            <p class="card-text text-success">{{ $book->author }}</p>
                            <form action="{{ route('like', ['bookId' => $book->id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Like</button>
                            </form>
                            <span>{{ $book->likes()->count() }} Likes</span>
                            <form action="{{ route('comment', ['bookId' => $book->id]) }}" method="post">
                                @csrf
                                <textarea name="comment" rows="3" cols="50" class="form-control mt-3" placeholder="Kommentar hinzufügen"></textarea>
                                <button type="submit" class="btn btn-success mt-3">Kommentieren</button>
                            </form>
                            <div class="mt-3">
                                <h5>Kommentare:</h5>
                                @foreach($book->comments as $comment)
                                    <p>{{ $comment->content }}</p>
                                @endforeach
                            </div>
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('pdf.download') }}">
                                <button type="button" class="btn btn-primary">PDF speichern</button>
                            </a>
                        </li>
                        </li>
                    </ul>
                @endforeach
            @else
                <p>Es sind keine Bücher verfügbar.</p>
            @endif
        @else
            <p>Es sind keine Bücher verfügbar.</p>
        @endisset
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
