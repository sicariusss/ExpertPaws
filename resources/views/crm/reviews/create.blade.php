@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.reviews.create')}}" class="index-title pb-5">
                Добавить отзыв
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-review" class="btn btn-outline-paw">Добавить отзыв</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.reviews.store'), 'files'=>true, 'id'=>'create-review'])}}
            @include('crm.reviews._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-review" class="btn btn-outline-paw">Добавить отзыв</button>
            </div>
        </div>
    </div>
@endsection
