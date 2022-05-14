@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.images.store'), 'files'=>true])}}
                @include('crm.images._form')
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Добавить изображение</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
