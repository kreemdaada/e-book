<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzerprofil</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('includes.navbar')

<div class="container mt-5">
    <h1 class="text-primary">Benutzerprofil</h1>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Willkommen, {{ auth()->user()->name }}</h4>
            <p>Datum: {{ now()->format('Y-m-d') }}</p>
        </div>
        <div class="card-body">
            <h5 class="card-title">Kommentare:</h5>
            @if($comments->count() > 0)
                <ul class="list-group list-group-flush">
                    @foreach($comments as $comment)
                        <li class="list-group-item">{{ $comment->comment_text }}</li>
                    @endforeach
                </ul>
            @else
                <p>Keine Kommentare gefunden.</p>
            @endif
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <h4>Meine heruntergeladenen Bücher ({{ $downloadedBooksCount }})</h4>
        </div>
        @if($downloadedBooksCount > 0)
            <ul class="list-group list-group-flush">
                @foreach($downloadedBooks as $download)
                    <li class="list-group-item">{{ $download->title }}</li>
                @endforeach
            </ul>
        @else
            <p>Keine heruntergeladenen Bücher gefunden.</p>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
