<?php
/**
 * @var \App\Models\Category $category
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
                    Название
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
                {{ $category->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $category->getName() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.categories.edit', $category)}}" class="btn btn-outline-primary py-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button form="delete-{{$category->getKey()}}" class="btn btn-outline-danger py-1"
                            onclick="return confirm('Подтвердите удаление категории{{' "' . $category->getName() . '"'}}')">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$category->getKey(),'method'=>'DELETE', 'url'=>route('crm.categories.destroy', $category)])}}
        {{Form::close()}}
    </div>
@endsection
