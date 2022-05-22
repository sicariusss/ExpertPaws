@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.lessons.edit',$lesson)}}" class="index-title pb-5">
                Изменить урок "{{$lesson->getTitle()}}"
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="edit-lesson" class="btn btn-outline-paw">Изменить урок</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::model($lesson, ['url'=> route('crm.lessons.update', $lesson), 'method' => 'PATCH', 'id'=>'edit-lesson'])}}
            @include('crm.lessons._form', $lesson)
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="edit-lesson" class="btn btn-outline-paw">Изменить урок</button>
            </div>
        </div>
    </div>
@endsection
