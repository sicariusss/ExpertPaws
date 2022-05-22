@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.users.edit',$user)}}" class="index-title pb-5">
                Изменить пользователя "{{$user->getShortName()}}"
            </a>
        </div>
        <div class="col-auto pc-block">
            <button form="edit-user" class="btn btn-outline-paw">Изменить пользователя</button>
        </div>
    </div>
    <div class="row justify-content-center pt-4">
        <div class="col-12">
            {{Form::model($user, ['url'=> route('crm.users.update', $user), 'method' => 'PATCH', 'files'=>true, 'id'=>'edit-user'])}}
            @include('crm.users._form', $user)
            {{Form::close()}}
            <div class="col-auto mobile-block pt-3">
                <button form="edit-user" class="btn btn-outline-paw">Изменить пользователя</button>
            </div>
        </div>
    </div>
@endsection
