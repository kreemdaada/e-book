<!-- resources/views/auth/login.blade.php -->
<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">E-Mail Adresse</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

    <label for="password">Passwort</label>
    <input id="password" type="password" name="password" required>

    <button type="submit">
        Anmelden
    </button>
</form>
