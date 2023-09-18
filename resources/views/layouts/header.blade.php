<header>
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <a class="btn btn-primary " href="{{ route('search') }}" role="button">
            レシピ検索
        </a>

        <a class="btn btn-primary" href="{{ route('posts.index') }}" role="button">
            投稿一覧
        </a>
        

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto mr-5 mt-2">
            <!-- Authentication Links -->
            @auth
            <a class="btn btn-primary" href="{{ route('posts.create') }}">
                投稿する
            </a>
            @endauth
            @guest
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @else
            <li class="nav-item mr-5">
                <a class="nav-link" href="{{ route('mypage') }}">
                    <i class="fas fa-user mr-1"></i><label>マイページ</label>
                </a>
            </li>
            @endguest
        </ul>
        </div>
    </div>
</nav>
</header>