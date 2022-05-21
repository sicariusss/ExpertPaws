<?php
/**
 * @var \App\Models\Image $image
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.images.show',$image)}}" class="index-title pb-5">
                    {{$image->getTypeName()}}
                </a>
            </div>
            <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.images.edit', $image)}}" title="Редактировать" class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$image->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление {{$image->getTypeName()}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$image->getKey(),'method'=>'DELETE', 'url'=>route('crm.images.destroy', $image)])}}
        {{Form::close()}}

        <div class="row pt-4 pt-lg-5 justify-content-center">
            <div class="col-md-6 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $image->getKey() }}
                    </div>
                    @if($image->getTypeName() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Тип:</span> {{ $image->getTypeName() }}
                        </div>
                    @endif
                <img class="pt-3" src="{{$image->getPath()}}" id="image" width="100%"
                     height="auto" alt="image"/>
            </div>
        </div>
    </div>
@endsection
