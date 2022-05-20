<?php
/**
 * @var \App\Models\Gallery $image
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('crm.gallery.index')}}" class="index-title">
            Галерея
        </a>
        {{ Form::open(['url'=>route('crm.gallery.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
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
                <a href="{{ route('crm.gallery.create') }}" class="btn btn-outline-paw">
                    Добавить изображение <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        <div class="row py-1 mx-1 align-items-end justify-content-center gallery-block">
            @forelse($gallery as $key => $image)
                <div class="col-lg-2 pb-5">
                    <div>
                        <img src="{{$image->getImage()}}" alt="gallery-image" width="100%" class="gallery-image">
                    </div>
                    <div class="px-2 py-2">
                        {{ $image->getName() }}
                    </div>
                    <div class="btn-group px-2" role="group">
                        <a href="{{route('crm.gallery.show', $image)}}" title="Подробная информация"
                           class="btn btn-outline-primary action-btn">
                            <i class="fa-regular fa-image"></i>
                        </a>
                        <a href="{{route('crm.gallery.edit', $image)}}" title="Редактировать"
                           class="btn btn-outline-success action-btn">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete-{{$image->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление изображения №{{$image->getKey()}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
                {{Form::open(['id'=> 'delete-'.$image->getKey(),'method'=>'DELETE', 'url'=>route('crm.gallery.destroy', $image), 'style'=>'display:none'])}}
                {{Form::close()}}
            @empty
                @if($data === [])
                    <div class="alert text-center">
                        Изображения отсутствуют в галерее
                    </div>
                @else
                    <div class="alert text-center">
                        По данному запросу не найдено изображений
                    </div>
                @endif
            @endforelse
        </div>
        <div class="row justify-content-center pt-3">
            <div class="col-auto text-center">
                <div class="row justify-content-center mt-3">
                    {{ $gallery->appends($data ?? [])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
