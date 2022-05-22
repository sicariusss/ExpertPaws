@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.gallery.create')}}" class="index-title pb-5">
                Добавить изображение в галерею
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-gallery" class="btn btn-outline-paw">Добавить изображение</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.gallery.store'), 'files'=>true, 'id'=>'create-gallery'])}}
            @include('crm.gallery._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-gallery" class="btn btn-outline-paw">Добавить изображение</button>
            </div>
        </div>
    </div>
@endsection
