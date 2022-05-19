<?php
/**
 * @var \App\Models\User $user
 */

/**
 * TODO: не редактируется из-за display:none обязательных полей
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.users.show',$user)}}" class="index-title pb-5">
                    Пользователь "{{$user->getShortName()}}"
                </a>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.users.edit', $user)}}" title="Редактировать" class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$user->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление пользователя{{' "' . $user->getShortName() . '"'}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$user->getKey(),'method'=>'DELETE', 'url'=>route('crm.users.destroy', $user)])}}
        {{Form::close()}}

        <div class="row pt-5 justify-content-center">
            <div class="col-5">
                <div class="row py-3 mx-1 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $user->getKey() }}
                    </div>
                    @if($user->getSurname() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Фамилия:</span> {{ $user->getSurname() }}
                    </div>
                    @endif
                    @if($user->getName() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Имя:</span> {{ $user->getName() }}
                    </div>
                    @endif
                    @if($user->getPatronymic() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Отчество:</span> {{ $user->getPatronymic() }}
                    </div>
                    @endif
                    @if($user->getEmail() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Email:</span> {{ $user->getEmail() }}
                    </div>
                    @endif
                    @if($user->getPhone() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Телефон:</span> {{ $user->getPhone() }}
                    </div>
                    @endif
                    @if($user->getAddress() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Адрес:</span> {{ $user->getAddress() }}
                    </div>
                    @endif
                    @if($user->getRole() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Роль:</span> {{ $user->getRole()->getDisplayName() }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-3">
                <label for="photo">Фото профиля</label>
                <img src="{{$user->getPhoto()}}" id="photo" width="100%"
                     height="auto" alt="photo"/>
            </div>
        </div>
    </div>
@endsection
