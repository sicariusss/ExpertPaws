@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.images.edit',$image)}}" class="index-title pb-5">
                Изменить {{$image->getTypeName()}}
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="edit-image" class="btn btn-outline-paw">Изменить изображение</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::model($image, ['url'=> route('crm.images.update', $image), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-image'])}}
            @include('crm.images._form', $image)
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="edit-image" class="btn btn-outline-paw">Изменить изображение</button>
            </div>
        </div>
    </div>
@endsection
