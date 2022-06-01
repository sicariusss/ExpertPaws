<?php
/**
 * @var \App\Models\Review $review
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.reviews.show',$review)}}" class="index-title pb-5">
                Отзыв №{{$review->getKey()}}
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                <a href="{{route('crm.reviews.edit', $review)}}" title="Редактировать"
                   class="btn btn-outline-success">
                    Редактировать <i class="far fa-edit"></i>
                </a>
                <button form="delete-{{$review->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление отзыва №{{$review->getKey()}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$review->getKey(),'method'=>'DELETE', 'url'=>route('crm.reviews.destroy', $review)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center flex-lg-row-reverse">
        <div class="{{$review->isGallery() ? 'col-lg-5' : 'col-lg-10'}}">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $review->getKey() }}
                </div>
                @if($review->getUser() !== null)
                    <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> Пользователь:</span> {{ $review->getUser()->getName() }}
                        <a href="{{route('crm.users.show',$review->getUser())}}"><i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </div>
                @endif
                @if($review->getAnon() !== null)
                    <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> Анонимно:</span> {{ $review->getAnon() ? '+' : '-' }}
                    </div>
                @endif
                <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> В галерее:</span> {{ $review->isGallery() ? '+' : '-' }}
                </div>
                <div>
                    <div class="row">
                        <div class="col-auto" style="display: inline-flex">
                            <span class="pe-2"><i class="fa-solid fa-chevron-right"></i> Опубликован:</span>
                            {{Form::model($review, ['url'=> route('crm.review.publish', $review), 'method' => 'PATCH','onchange'=>'this.submit();'])}}
                            {{Form::hidden('published',0)}}
                            @include('forms._checkbox', [
                'name'=>'published',
                'value' => 1,
                'checked' => $review->isPublished(),
            ])
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
                @if($review->getDescription() !== null)
                    <div>
                <span><i
                        class="fa-solid fa-chevron-right"></i> Отзыв:</span> {{ $review->getDescription() }}
                    </div>
                @endif
            </div>
        </div>
        @if($review->isGallery())
            <div class="col-lg-3 pt-3">
                <label for="image">Изображение</label>
                <img src="{{$review->getImage()}}" id="image" width="100%"
                     height="auto" alt="image"/>
            </div>
        @endif
    </div>
@endsection
