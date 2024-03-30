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
    <h1>Welcome to the Homepage</h1>
    <p>This is a simple homepage with Bootstrap navigation.</p>

    @auth
    <p>Hello, {{ auth()->user()->name }}</p>
    @endauth


    <div class="card mt-3">
        <div class="card-header">
            Featured Books
        </div>
        @foreach($books as $book)
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">{{ $book->description }}</p>
                <p class="card-text">{{ $book->author }}</p>
                <button class="btn btn-primary mr-2">Like</button>
                <button class="btn btn-secondary">Comment</button>
            </li>
            <li class="list-group-item">
                <h5 class="card-title">{{ $book->title }}</h5>
                <p class="card-text">{{ $book->description }}</p>
                <p class="card-text">{{ $book->author }}</p>
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
