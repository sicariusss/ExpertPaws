<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="usersDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Пользователи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="usersDropdown">
                        <a href="{{route('crm.users.index')}}" class="dropdown-item">
                            Пользователи
                        </a>
                        <a href="{{route('crm.roles.index')}}" class="dropdown-item">
                            Роли
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="coursesDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Обучение
                    </a>
                    <div class="dropdown-menu" aria-labelledby="coursesDropdown">
                        <a href="{{route('crm.courses.index')}}" class="dropdown-item">
                            Курсы
                        </a>
                        <a href="{{route('crm.lessons.index')}}" class="dropdown-item">
                            Уроки
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="shopDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Магазин
                    </a>
                    <div class="dropdown-menu" aria-labelledby="shopDropdown">
                        <a href="{{route('crm.products.index')}}" class="dropdown-item">
                            Товары
                        </a>
                        <a href="{{route('crm.categories.index')}}" class="dropdown-item">
                            Категории
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crm.gallery.index') }}">Галерея</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('crm.contacts.index') }}">Контакты</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="resourcesDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Ресурсы
                    </a>
                    <div class="dropdown-menu" aria-labelledby="resourcesDropdown">
                        <a href="{{route('crm.images.index')}}" class="dropdown-item">
                            Изображения
                        </a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
