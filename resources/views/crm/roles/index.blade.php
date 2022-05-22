<?php
/**
 * @var \App\Models\Role $role
 */

?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.roles.index')}}" class="index-title">
        Все роли
    </a>
    {{ Form::open(['url'=>route('crm.roles.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите название или отображаемое название...',
           'value' => $data['search'] ?? null
       ])
        </div>
        <div class="col-lg-auto pt-3 pt-lg-0">
            <a href="{{ route('crm.roles.create') }}" class="btn btn-outline-paw">
                Добавить роль <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($roles) > 0)
        <div class="row py-1 mx-1 table-title pc-block">
            <div class="col-lg-1">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> №
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Название
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Отображаемое название
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($roles as $key => $role)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $role->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $role->getName() }}
            </div>
            <div class="col-lg-6">
                {{ $role->getDisplayName() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.roles.show', $role)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fas fa-user-shield"></i>
                    </a>
                    <a href="{{route('crm.roles.edit', $role)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$role->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление роли{{' "' . $role->getDisplayName() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $role->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $role->getName() }}
            </div>
            <div>
                    <span><i
                            class="fa-solid fa-chevron-right"></i> Отображаемое название:</span> {{ $role->getDisplayName() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.roles.show', $role)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fas fa-user-shield"></i>
                    </a>
                    <a href="{{route('crm.roles.edit', $role)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$role->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление роли{{' "' . $role->getDisplayName() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$role->getKey(),'method'=>'DELETE', 'url'=>route('crm.roles.destroy', $role)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Роли отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено ролей
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $roles->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
