<!-- resources/views/includes/navbar.blade.php -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('about.index') }}">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('books.index') }}">Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Authors</a>
            </li>
            <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link">Logout</button>
            </form>
            </li>
        </ul>
    </div>
</nav>
