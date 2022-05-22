@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.lessons.create')}}" class="index-title pb-5">
                Добавить урок
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-lesson" class="btn btn-outline-paw">Добавить урок</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.lessons.store'), 'id'=>'create-lesson'])}}
            @include('crm.lessons._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-lesson" class="btn btn-outline-paw">Добавить урок</button>
            </div>
        </div>
    </div>
@endsection
