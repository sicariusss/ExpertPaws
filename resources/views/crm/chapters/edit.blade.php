<?php
/**
 * @var \App\Models\Chapter $chapter
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.chapters.edit',$chapter)}}" class="index-title pb-5">
                Изменить главу "{{$chapter->getTitle()}}"
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="edit-chapter" class="btn btn-outline-paw">Изменить главу</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::model($chapter, ['url'=> route('crm.chapters.update', $chapter), 'method' => 'PATCH', 'id'=>'edit-chapter'])}}
            @include('crm.chapters._form', $chapter)
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="edit-chapter" class="btn btn-outline-paw">Изменить главу</button>
            </div>
        </div>
    </div>
@endsection
