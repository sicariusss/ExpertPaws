@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.roles.edit',$role)}}" class="index-title pb-5">
                    Изменить роль "{{$role->getDisplayName()}}"
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-role" class="btn btn-outline-paw">Изменить роль</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($role, ['url'=> route('crm.roles.update', $role), 'method' => 'PATCH', 'id'=>'edit-role'])}}
                @include('crm.roles._form', $role)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-role" class="btn btn-outline-paw">Изменить роль</button>
                </div>
            </div>
        </div>
    </div>
@endsection
