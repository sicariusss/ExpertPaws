@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.products.create')}}" class="index-title pb-5">
                Добавить товар
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-product" class="btn btn-outline-paw">Добавить товар</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.products.store'), 'files'=>true, 'id'=>'create-product'])}}
            @include('crm.products._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-product" class="btn btn-outline-paw">Добавить товар</button>
            </div>
        </div>
    </div>
@endsection
