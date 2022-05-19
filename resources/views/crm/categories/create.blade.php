@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.categories.create')}}" class="index-title pb-5">
                    Добавить категорию
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="create-category" class="btn btn-outline-paw">Добавить категорию</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.categories.store'), 'files'=>true, 'id'=>'create-category'])}}
                @include('crm.categories._form')
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="create-category" class="btn btn-outline-paw">Добавить категорию</button>
                </div>
            </div>
        </div>
    </div>
@endsection
