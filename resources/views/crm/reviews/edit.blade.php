@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.reviews.edit',$review)}}" class="index-title pb-5">
                Изменить отзыв №{{$review->getKey()}}
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="edit-review" class="btn btn-outline-paw">Изменить отзыв</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::model($review, ['url'=> route('crm.reviews.update', $review), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-review'])}}
            @include('crm.reviews._form', $review)
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="edit-review" class="btn btn-outline-paw">Изменить отзыв</button>
            </div>
        </div>
    </div>
@endsection
