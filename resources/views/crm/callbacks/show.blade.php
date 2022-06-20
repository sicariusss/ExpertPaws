<?php
/**
 * @var \App\Models\Callback $callback
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.callbacks.show',$callback)}}" class="index-title pb-5">
                Обращение №{{$callback->getKey()}}
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                <button form="delete-{{$callback->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление обращения №{{$callback->getKey()}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
                @endif
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$callback->getKey(),'method'=>'DELETE', 'url'=>route('crm.callbacks.destroy', $callback)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center">
        <div class="col-lg-10">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $callback->getKey() }}
                </div>
                @if($callback->getUser() !== null)
                    <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> Отправитель:</span> {{ $callback->getUser()->getName() }}
                        <a href="{{route('crm.users.show',$callback->getUser())}}"><i
                                class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </div>
                @endif
                @if($callback->getName() !== null)
                    <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> Имя отправителя:</span> {{ $callback->getName() }}
                    </div>
                @endif
                @if($callback->getEmail() !== null)
                    <div>
                        <span><i
                                class="fa-solid fa-chevron-right"></i> Почта отправителя:</span> {{ $callback->getEmail() }}
                    </div>
                @endif
                @if($callback->getSubject() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Тема:</span> {{ $callback->getSubject() }}
                    </div>
                @endif
                @if($callback->getMessage() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Сообщение:</span> {{ $callback->getMessage() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
