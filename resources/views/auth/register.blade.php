<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registierung</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="form-group">
        <label for="email" class="form-label">E-Mail Adresse</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">Passwort</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="form-label">Passwort bestätigen</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>
<!-- Verstecktes Feld für is_author -->
    <input type="hidden" name="is_author" value="0">
<!-- Verstecktes Feld für is_author -->

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="is_author" name="is_author" value="1">
        <label class="form-check-label" for="is_author">Registriere mich als Autor</label>
    </div>

    <button type="submit" class="btn btn-primary">Registrieren</button>
</form>

                    <div class="form-group">
                        <button type="button" onclick="window.location='{{ route('login') }}'" class="btn btn-success mt-4">Login</button>
                    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
