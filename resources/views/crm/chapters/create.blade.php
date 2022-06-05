<?php
/**
 * @var \App\Models\Chapter $chapter
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.chapters.create')}}" class="index-title pb-5">
                Добавить главу
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-chapter" class="btn btn-outline-paw">Добавить главу</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.chapters.store'), 'id'=>'create-chapter'])}}
            @include('crm.chapters._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-chapter" class="btn btn-outline-paw">Добавить главу</button>
            </div>
        </div>
    </div>
@endsection
