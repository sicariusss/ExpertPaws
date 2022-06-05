<?php
/**
 * @var \App\Models\Chapter $chapter
 */
?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.chapters.index')}}" class="index-title">
        Все главы
    </a>
    {{ Form::open(['url'=>route('crm.chapters.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
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
            <a href="{{ route('crm.chapters.create') }}" class="btn btn-outline-paw">
                Добавить главу <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($chapters) > 0)
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
                    <i class="fa-solid fa-chevron-right"></i> Курс
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($chapters as $key => $chapter)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $chapter->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $chapter->getTitle() }}
            </div>
            <div class="col-lg-6">
                {{ $chapter->getCourse()->getTitle() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.chapters.show', $chapter)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-list-ol"></i>
                    </a>
                    <a href="{{route('crm.chapters.edit', $chapter)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$chapter->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление главы{{' "' . $chapter->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $chapter->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $chapter->getTitle() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Курс:</span> {{ $chapter->getCourse()->getTitle() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.chapters.show', $chapter)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-list-ol"></i>
                    </a>
                    <a href="{{route('crm.chapters.edit', $chapter)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$chapter->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление главы{{' "' . $chapter->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$chapter->getKey(),'method'=>'DELETE', 'url'=>route('crm.chapters.destroy', $chapter)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Главы отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено глав
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $chapters->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection

