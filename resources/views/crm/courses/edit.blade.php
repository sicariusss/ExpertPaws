@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::model($course, ['url'=> route('crm.courses.update', $course), 'method' => 'PATCH', 'files'=>true])}}
                @include('crm.courses._form', $course)
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Изменить курс</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
