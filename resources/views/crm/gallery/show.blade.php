<?php
/**
 * @var \App\Models\Gallery $gallery
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.gallery.show',$gallery)}}" class="index-title pb-5">
                    Изображение галереи №{{$gallery->getKey()}}
                </a>
            </div>
            <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.gallery.edit', $gallery)}}" title="Редактировать" class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$gallery->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление изображения №{{$gallery->getKey()}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$gallery->getKey(),'method'=>'DELETE', 'url'=>route('crm.gallery.destroy', $gallery)])}}
        {{Form::close()}}

        <div class="row pt-4 pt-lg-5 justify-content-center flex-lg-row-reverse">
            <div class="col-lg-5">
                <div class="row py-lg-5 mx-1 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $gallery->getKey() }}
                    </div>
                    @if($gallery->getName() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $gallery->getName() }}
                        </div>
                    @endif
                    @if($gallery->getDescription() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $gallery->getDescription() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-5 pt-3">
                <label for="image">Изображение</label>
                <img src="{{$gallery->getImage()}}" id="image" width="100%"
                     height="auto" alt="image"/>
            </div>
        </div>
    </div>
@endsection
