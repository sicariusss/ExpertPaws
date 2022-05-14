@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::model($image, ['url'=> route('crm.images.update', $image), 'method' => 'PATCH', 'files'=>true])}}
                @include('crm.images._form', $image)
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Изменить изображение</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
