@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.images.create')}}" class="index-title pb-5">
                    Добавить изображение
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="create-image" class="btn btn-outline-paw">Добавить изображение</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.images.store'), 'files'=>true, 'id'=>'create-image'])}}
                @include('crm.images._form')
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="create-image" class="btn btn-outline-paw">Добавить изображение</button>
                </div>
            </div>
        </div>
    </div>
@endsection
