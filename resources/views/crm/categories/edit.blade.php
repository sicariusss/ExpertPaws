@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                {{Form::model($category, ['url'=> route('crm.categories.update', $category), 'method' => 'PATCH', 'files'=>true])}}
                @include('crm.categories._form', $category)
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <button class="btn btn-success">Изменить категорию</button>
                    </div>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
@endsection