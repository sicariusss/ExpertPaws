<?php
/**
 * @var \App\Models\Course $course
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('crm.courses.index')}}" class="index-title">
            Все курсы
        </a>
        {{ Form::open(['url'=>route('crm.courses.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
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
                <a href="{{ route('crm.courses.create') }}" class="btn btn-outline-paw">
                    Добавить курс <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        @if(count($courses) > 0)
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
                <div class="col-lg-3">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Описание
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Цена
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Действия
                    </div>
                </div>
            </div>
        @endif
        @forelse($courses as $key => $course)
            <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
                <div class="col-lg-1">
                    {{ $course->getKey() }}
                </div>
                <div class="col-lg-3">
                    {{ $course->getTitle() }}
                </div>
                <div class="col-lg-3">
                    {{ $course->getShortDescription() }}
                </div>
                <div class="col-lg-3">
                    {{ $course->getPrice() }} ₽
                </div>
                <div class="col-lg-2">
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.courses.show', $course)}}" title="Подробная информация"
                           class="btn btn-outline-primary action-btn">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </a>
                        <a href="{{route('crm.courses.edit', $course)}}" title="Редактировать"
                           class="btn btn-outline-success action-btn">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete-{{$course->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление курса{{' "' . $course->getTitle() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $course->getKey() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $course->getTitle() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $course->getShortDescription() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Цена:</span> {{ $course->getPrice() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.courses.show', $course)}}" title="Подробная информация"
                           class="btn btn-outline-primary action-btn">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </a>
                        <a href="{{route('crm.courses.edit', $course)}}" title="Редактировать"
                           class="btn btn-outline-success action-btn">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete-{{$course->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление курса{{' "' . $course->getTitle() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{Form::open(['id'=> 'delete-'.$course->getKey(),'method'=>'DELETE', 'url'=>route('crm.courses.destroy', $course)])}}
            {{Form::close()}}
        @empty
            @if($data === [])
                <div class="alert text-center">
                    Курсы отсутствуют в системе
                </div>
            @else
                <div class="alert text-center">
                    По данному запросу не найдено курсов
                </div>
            @endif
        @endforelse
        <div class="row justify-content-center pt-3">
            <div class="col-auto text-center">
                <div class="row justify-content-center mt-3">
                    {{ $courses->appends($data ?? [])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
