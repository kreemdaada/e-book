<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Books</title>

</head>
<body>
<div class="container">
        <h1 class="mt-5 mb-4">PDF Books</h1>
        <ul class="list-group">
            @foreach($books as $book)
            <li class="list-group-item">
                <h4 class="font-weight-bold">{{ $book->title }}</h4>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p>{{ $book->description }}</p>
            </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
