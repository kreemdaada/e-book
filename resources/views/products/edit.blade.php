<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Edit Product</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Edit Product</h2>
        <div>
            @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif
        </div>
        <form method="post" action="{{ route('product.update', ['product'=>$product]) }}">
            @csrf 
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label for="menge" class="form-label">Menge</label>
                <input type="number" class="form-control" id="menge" name="menge" value="{{ $product->menge }}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Beschreibung</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Preis</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
            </div>
            <button type="submit" class="btn btn-primary">Bearbeiten</button>
        </form>
    </div>
</body>
</html>
