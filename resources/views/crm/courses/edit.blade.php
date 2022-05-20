@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.courses.edit',$course)}}" class="index-title pb-5">
                    Изменить курс "{{$course->getTitle()}}"
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-course" class="btn btn-outline-paw">Изменить курс</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($course, ['url'=> route('crm.courses.update', $course), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-course'])}}
                @include('crm.courses._form', $course)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-course" class="btn btn-outline-paw">Изменить курс</button>
                </div>
            </div>
        </div>
    </div>
@endsection
