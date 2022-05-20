@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.gallery.edit',$gallery)}}" class="index-title pb-5">
                    Изменить изображение №{{$gallery->getKey()}} в галерее
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-gallery" class="btn btn-outline-paw">Изменить изображение</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($gallery, ['url'=> route('crm.gallery.update', $gallery), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-gallery'])}}
                @include('crm.gallery._form', $gallery)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-gallery" class="btn btn-outline-paw">Изменить изображение</button>
                </div>
            </div>
        </div>
    </div>
@endsection
