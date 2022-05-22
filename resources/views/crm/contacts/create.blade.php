@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.courses.create')}}" class="index-title pb-5">
                Добавить контакт
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-contact" class="btn btn-outline-paw">Добавить контакт</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.contacts.store'), 'id'=>'create-contact'])}}
            @include('crm.contacts._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-contact" class="btn btn-outline-paw">Добавить контакт</button>
            </div>
        </div>
    </div>
@endsection
