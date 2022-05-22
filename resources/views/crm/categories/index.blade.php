<?php
/**
 * @var \App\Models\Category $category
 */

?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.categories.index')}}" class="index-title">
        Все категории
    </a>
    {{ Form::open(['url'=>route('crm.categories.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
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
            <a href="{{ route('crm.categories.create') }}" class="btn btn-outline-paw">
                Добавить категорию <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($categories) > 0)
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
    @forelse($categories as $key => $category)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $category->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $category->getName() }}
            </div>
            <div class="col-lg-6">
                {{ $category->getDescription() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.categories.show', $category)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-list"></i>
                    </a>
                    <a href="{{route('crm.categories.edit', $category)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$category->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление категории{{' "' . $category->getName() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $category->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $category->getName() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $category->getDescription() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.categories.show', $category)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-list"></i>
                    </a>
                    <a href="{{route('crm.categories.edit', $category)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$category->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление категории{{' "' . $category->getName() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$category->getKey(),'method'=>'DELETE', 'url'=>route('crm.categories.destroy', $category)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Категории отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено категорий
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $categories->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
