@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.products.edit',$product)}}" class="index-title pb-5">
                    Изменить товар "{{$product->getName()}}"
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-product" class="btn btn-outline-paw">Изменить товар</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($product, ['url'=> route('crm.products.update', $product), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-product'])}}
                @include('crm.products._form', $product)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-product" class="btn btn-outline-paw">Изменить товар</button>
                </div>
            </div>
        </div>
    </div>
@endsection
