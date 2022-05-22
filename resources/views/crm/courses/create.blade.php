@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.courses.create')}}" class="index-title pb-5">
                Добавить курс
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-course" class="btn btn-outline-paw">Добавить курс</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.courses.store'), 'files'=>true, 'id'=>'create-course'])}}
            @include('crm.courses._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-course" class="btn btn-outline-paw">Добавить курс</button>
            </div>
        </div>
    </div>
@endsection
