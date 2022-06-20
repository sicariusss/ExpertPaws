<?php
/**
 * @var \App\Models\Lesson $lesson
 */
?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.lessons.index')}}" class="index-title">
        Все уроки
    </a>
    {{ Form::open(['url'=>route('crm.lessons.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите название...',
           'value' => $data['search'] ?? null
       ])
        </div>
        <div class="col-lg-auto pt-3 pt-lg-0">
            <a href="{{ route('crm.lessons.create') }}" class="btn btn-outline-paw">
                Добавить урок <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($lessons) > 0)
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
                    <i class="fa-solid fa-chevron-right"></i> Описание
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($lessons as $key => $lesson)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $lesson->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $lesson->getTitle() }}
            </div>
            <div class="col-lg-6">
                {{ $lesson->getDescription() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.lessons.show', $lesson)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-laptop-file"></i>
                    </a>
                    <a href="{{route('crm.lessons.edit', $lesson)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$lesson->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление урока{{' "' . $lesson->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $lesson->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $lesson->getTitle() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $lesson->getDescription() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.lessons.show', $lesson)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-laptop-file"></i>
                    </a>
                    <a href="{{route('crm.lessons.edit', $lesson)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$lesson->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление урока{{' "' . $lesson->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$lesson->getKey(),'method'=>'DELETE', 'url'=>route('crm.lessons.destroy', $lesson)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Уроки отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено уроков
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $lessons->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection

