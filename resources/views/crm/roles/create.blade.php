@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.roles.create')}}" class="index-title pb-5">
                Создать роль
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="create-role" class="btn btn-outline-paw">Добавить роль</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::open(['method'=>'POST', 'url'=>route('crm.roles.store'), 'id'=>'create-role'])}}
            @include('crm.roles._form')
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="create-role" class="btn btn-outline-paw">Добавить роль</button>
            </div>
        </div>
    </div>
@endsection
