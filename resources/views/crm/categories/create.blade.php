@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.categories.store'), 'files'=>true])}}
                @include('crm.categories._form')
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Добавить категорию</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection
