@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.products.store'), 'files'=>true])}}
                @include('crm.products._form')
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Добавить товар</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
