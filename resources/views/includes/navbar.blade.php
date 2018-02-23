<!-- Hamburger menu -->
<div class="regular-menu" id="menu-container">
    <i id="hamburger"><i class="fa fa-bars"></i></i>
</div>

<!-- Navigation menu -->
<nav id="nav-menu" class="nav-closed">
    <a href="{{ url('/') }}" title="На главную" id="logo" class="logo-closed">
        <h2>{{ config('app.name', 'Delicious Food') }}</h2>
    </a>
    <ul>
        <li><a href="{{ url('/search') }}" title="Поиск"><i class="fa fa-search"></i></a></li>
        <li><a href="{{ url('/') }}" title="На главную">Главная</a></li>
        <li><a href="{{ url('/recipes') }}" title="Рецепты">Рецепты</a></li>
        @guest
            <li><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
        @else
            <li>
                <a href="{{ url('/dashboard') }}">
                    {{ ucfirst(Auth::user()->name) }}
                </a>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    Выйти
                </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                 </form>
            </li>
        @endguest
    </ul>
</nav>