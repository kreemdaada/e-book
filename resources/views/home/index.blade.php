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
    <h5>willkomen zurück, <h3 class="text-secondary">{{ auth()->user()->name }}</h3></h5>
    @endauth
    <div class="card mt-3">
        <div class="card-header">
           <h4> Unsere Bücher</h4>
        </div>
        @foreach($books as $book)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5 class="card-title text-success">{{ $book->title }}</h5>
                <h4 class="card-text">{{ $book->description }}</h4>
                <h4 class="card-text text-success">{{ $book->author }}</h4>
                <button class="btn btn-primary mr-2">Like</button>
                <button class="btn btn-secondary">Comment</button>
            </li>
            <li class="list-group-item">
                <h5 class="card-title text-success">{{ $book->title }}</h5>
                <h4 class="card-text">{{ $book->description }}</h4>
                <h4 class="card-text text-success">{{ $book->author }}</h4>
                <button class="btn btn-primary mr-2">Like</button>
                <button class="btn btn-secondary">Comment</button>
            </li>
        </ul>
        @endforeach
    </div>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
