@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.categories.edit',$category)}}" class="index-title pb-5">
                    Изменить категорию "{{$category->getName()}}"
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-category" class="btn btn-outline-paw">Изменить категорию</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($category, ['url'=> route('crm.categories.update', $category), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-category'])}}
                @include('crm.categories._form', $category)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-category" class="btn btn-outline-paw">Изменить категорию</button>
                </div>
            </div>
        </div>
    </div>
@endsection
