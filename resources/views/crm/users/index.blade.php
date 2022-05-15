<?php
/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">
        <div class="index-title">
            Все пользователи
        </div>
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
            <div class="col-lg-auto">
                <a href="{{ route('crm.users.create') }}" class="btn btn-outline-paw">
                    Добавить пользователя&nbsp;<i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        @if(count($users) > 0)
            <div class="row py-1 mx-1 table-title">
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
        @forelse($users as $user)
            <div class="row py-1 mx-1 align-items-center index-table-row">
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
                        <a href="{{route('crm.users.show', $user)}}" class="btn btn-outline-primary py-1">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                        <a href="{{route('crm.users.edit', $user)}}" class="btn btn-outline-success py-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button form="delete-{{$user->getKey()}}" class="btn btn-outline-danger py-1"
                                onclick="return confirm('Подтвердите удаление пользователя{{' "' . $user->getName() . '"'}}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{Form::open(['id'=> 'delete-'.$user->getKey(),'method'=>'DELETE', 'url'=>route('crm.users.destroy', $user)])}}
            {{Form::close()}}
        @empty
            @if($data === [])
                <div class="alert alert-secondary  text-center">
                    Пользователи отсутствуют в системе
                </div>
            @else
                <div class="alert alert-secondary  text-center">
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
    </div>
@endsection
