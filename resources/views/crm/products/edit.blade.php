@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::model($product, ['url'=> route('crm.products.update', $product), 'method' => 'PATCH', 'files'=>true])}}
                @include('crm.products._form', $product)
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Изменить товар</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
