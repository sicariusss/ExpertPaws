<?php
/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.users.index')}}" class="index-title">
        Все пользователи
    </a>
    {{ Form::open(['url'=>route('crm.users.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите фамилию, имя, телефон или email...',
           'value' => $data['search'] ?? null
       ])
        </div>
        <div class="col-lg-auto pt-3 pt-lg-0">
            <a href="{{ route('crm.users.create') }}" class="btn btn-outline-paw">
                Добавить пользователя <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($users) > 0)
        <div class="row py-1 mx-1 table-title pc-block">
            <div class="col-lg-1">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> №
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> ФИО
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Email
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Телефон
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($users as $key => $user)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $user->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $user->getFullName() }}
            </div>
            <div class="col-lg-3">
                {{ $user->getEmail() }}
            </div>
            <div class="col-lg-3">
                {{ $user->getPhone() ?? '-' }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.users.show', $user)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="far fa-user"></i>
                    </a>
                    <a href="{{route('crm.users.edit', $user)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                        <button form="delete-{{$user->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление пользователя{{' "' . $user->getName() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $user->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> ФИО:</span> {{ $user->getFullName() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Email:</span> {{ $user->getEmail() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Телефон:</span> {{ $user->getPhone() ?? '-' }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.users.show', $user)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="far fa-user"></i>
                    </a>
                    <a href="{{route('crm.users.edit', $user)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                        <button form="delete-{{$user->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление пользователя{{' "' . $user->getShortName() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    @endif
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$user->getKey(),'method'=>'DELETE', 'url'=>route('crm.users.destroy', $user)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Пользователи отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено пользователей
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $users->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
