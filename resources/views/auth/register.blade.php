<!-- resources/views/auth/register.blade.php -->
<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

    <label for="email">E-Mail Adresse</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>

    <label for="password">Passwort</label>
    <input id="password" type="password" name="password" required>

    <label for="password-confirm">Passwort bestätigen</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <div class="form-group row">
    <label for="is_author" class="col-md-4 col-form-label text-md-right">Registriere mich als Autor</label>

    <div class="col-md-6">
        <input id="is_author" type="checkbox" class="form-control" name="is_author" value="1">
    </div>
</div>


    <button type="submit">
        Registrieren
    </button>
</form>
