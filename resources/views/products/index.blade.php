<!-- jede seite von view braucht eine route damit das zu controller -> model -> database -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Aufgabe</title>
</head>
<body>
    <h1>Product</h1>
    
    @if(session()->has('erfolgreich'))
    <div>
        {{ session('erfolgreich') }}
    </div>
    @endif
    <div>
    <table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Menge</th>
            <th>Beschreibung</th>
            <th>Preis</th>
            <th>Aktionen</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->menge }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <a href="{{ route('product.edit', ['product' => $product->id]) }}" class="btn btn-primary">Bearbeiten</a>
                    <form action="{{ route('product.destroy', ['product' => $product->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Löschen</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
            </div>
</body>
</html>
