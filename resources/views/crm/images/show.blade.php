<?php
/**
 * @var \App\Models\Image $image
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">

        <div class="row py-1 mx-1">
            <div class="col-lg-1">
                <h5 class="font-weight-bold">
                    №
                </h5>
            </div>
            <div class="col-lg-3">
                <h5 class="font-weight-bold">
                    Тип
                </h5>
            </div>
            <div class="col-lg-2">
                <h5 class="font-weight-bold">
                    Действия
                </h5>
            </div>
        </div>
        <div class="row py-1 mx-1 border-top align-items-center">
            <div class="col-lg-1">
                {{ $image->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $image->getType() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.images.edit', $image)}}" class="btn btn-outline-primary py-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button form="delete-{{$image->getKey()}}" class="btn btn-outline-danger py-1"
                            onclick="return confirm('Подтвердите удаление изображения{{' "' . $image->getType() . '"'}}')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$image->getKey(),'method'=>'DELETE', 'url'=>route('crm.images.destroy', $image)])}}
        {{Form::close()}}
    </div>
@endsection