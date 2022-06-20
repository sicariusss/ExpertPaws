<?php

use Illuminate\Support\Facades\Auth;

?>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container py-1">
        <a class="navbar-brand px-3" href="{{ url('/') }}">
            <i class="fa-solid fa-paw"></i>&nbsp;{{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Меню') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('crm.users.index') || Route::is('crm.roles.index') ? 'active' : '' }}"
                       type="button" id="usersDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Пользователи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="usersDropdown">
                        <a href="{{route('crm.users.index')}}"
                           class="dropdown-item {{ Route::is('crm.users.index') ? 'active' : '' }}">
                            Пользователи
                        </a>
                        <a href="{{route('crm.roles.index')}}"
                           class="dropdown-item {{ Route::is('crm.roles.index') ? 'active' : '' }}">
                            Роли
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('crm.courses.index') || Route::is('crm.chapters.index') || Route::is('crm.lessons.index') ? 'active' : '' }}"
                       type="button" id="coursesDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Обучение
                    </a>
                    <div class="dropdown-menu" aria-labelledby="coursesDropdown">
                        <a href="{{route('crm.courses.index')}}"
                           class="dropdown-item {{ Route::is('crm.courses.index') ? 'active' : '' }}">
                            Курсы
                        </a>
                        <a href="{{route('crm.chapters.index')}}"
                           class="dropdown-item {{ Route::is('crm.chapters.index') ? 'active' : '' }}">
                            Главы
                        </a>
                        <a href="{{route('crm.lessons.index')}}"
                           class="dropdown-item {{ Route::is('crm.lessons.index') ? 'active' : '' }}">
                            Уроки
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('crm.contacts.index') ? 'active' : '' }}"
                       href="{{ route('crm.contacts.index') }}">Контакты</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ Route::is('crm.callbacks.index') || Route::is('crm.reviews.index') ? 'active' : '' }}"
                       type="button" id="callbackDropdown" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Обратная связь
                    </a>
                    <div class="dropdown-menu" aria-labelledby="callbackDropdown">
                        <a href="{{route('crm.callbacks.index')}}"
                           class="dropdown-item {{ Route::is('crm.callbacks.index') ? 'active' : '' }}">
                            Обращения
                        </a>
                        <a href="{{route('crm.reviews.index')}}"
                           class="dropdown-item {{ Route::is('crm.reviews.index') ? 'active' : '' }}">
                            Отзывы
                        </a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle nav-user" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->getShortName() }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a href="{{route('crm.users.show',Auth::user())}}" class="dropdown-item">
                            Профиль
                        </a>
                        <a href="{{ route('log-viewer::logs.list') }}" class="dropdown-item">
                            Логи
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
