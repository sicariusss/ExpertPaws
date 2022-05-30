<?php
/**
 * @var \App\Models\Review $review
 */
?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.reviews.index')}}" class="index-title">
        Все отзывы
    </a>
    {{ Form::open(['url'=>route('crm.reviews.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите заголовок...',
           'value' => $data['search'] ?? null
       ])
        </div>
        <div class="col-lg-auto pt-3 pt-lg-0">
            <a href="{{ route('crm.reviews.create') }}" class="btn btn-outline-paw">
                Добавить отзыв <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($reviews) > 0)
        <div class="row py-1 mx-1 table-title pc-block">
            <div class="col-lg-1">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> №
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Заголовок
                </div>
            </div>
            <div class="col-lg-4">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Отзыв
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Изображение
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($reviews as $key => $review)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $review->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $review->getTitle() }}
            </div>
            <div class="col-lg-4">
                {{ substr($review->getDescription(), 0, 50) . '...' }}
            </div>
            <div class="col-lg-2">
                {{ $review->isGallery() ? '+' : '-' }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.reviews.show', $review)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-quote-left"></i>
                    </a>
                    <a href="{{route('crm.reviews.edit', $review)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$review->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление отзыва №{{$review->getKey()}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $review->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $review->getTitle() }}
            </div>
            <div>
                <span><i
                        class="fa-solid fa-chevron-right"></i> Отзыв:</span> {{ substr($review->getDescription(), 0, 50) . '...' }}
            </div>
            <div>
                <span><i
                        class="fa-solid fa-chevron-right"></i> Изображение:</span> {{ $review->isGallery() ? '+' : '-' }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.reviews.show', $review)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-solid fa-quote-left"></i>
                    </a>
                    <a href="{{route('crm.reviews.edit', $review)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$review->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление отзыва №{{$review->getKey()}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$review->getKey(),'method'=>'DELETE', 'url'=>route('crm.reviews.destroy', $review)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Отзывы отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено отзывов
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $reviews->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
