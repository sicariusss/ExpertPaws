@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::model($gallery, ['url'=> route('crm.gallery.update', $gallery), 'method' => 'PATCH', 'files'=>true])}}
                @include('crm.gallery._form', $gallery)
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
