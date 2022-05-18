@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.users.create')}}" class="index-title pb-5">
                    Создать пользователя
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="create-user" class="btn btn-outline-paw">Добавить пользователя</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::open(['method'=>'POST', 'url'=>route('crm.users.store'), 'files'=>true, 'id'=>'create-user'])}}
                @include('crm.users._form')
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="create-user" class="btn btn-outline-paw">Добавить пользователя</button>
                </div>
            </div>
        </div>
    </div>
@endsection
