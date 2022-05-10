<?php
/**
 * @var \App\Models\User $user
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">
        {{ Form::open(['url'=>route('crm.users.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
        <div class="row justify-content-center pb-5 pt-3">
            <div class="col-lg-8">
                @include('forms._input',[
               'name'=>'search',
               'placeholder' => 'Введите ФИО, телефон или email...',
               'value' => $frd['search'] ?? null
           ])
            </div>
            <div class="col-lg-auto">
                <a href="{{ route('crm.users.create') }}" class="btn btn-outline-success">
                    Добавить пользователя&nbsp;<i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        @if(count($users) > 0)
            <div class="row py-1 mx-1">
                <div class="col-lg-1">
                    <h5 class="font-weight-bold">
                        №
                    </h5>
                </div>
                <div class="col-lg-3">
                    <h5 class="font-weight-bold">
                        Имя
                    </h5>
                </div>
                <div class="col-lg-2">
                    <h5 class="font-weight-bold">
                        Действия
                    </h5>
                </div>
            </div>
        @endif
        @forelse($users as $user)
            <div class="row py-1 mx-1 border-top align-items-center">
                <div class="col-lg-1">
                    {{ $user->getKey() }}
                </div>
                <div class="col-lg-3">
                    {{ $user->getName() }}
                </div>
                <div class="col-lg-2">
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.users.edit', $user)}}" class="btn btn-outline-primary py-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button form="delete-{{$user->getKey()}}" class="btn btn-outline-danger py-1"
                                onclick="return confirm('Подтвердите удаление пользователя{{' "' . $user->getName() . '"'}}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{Form::open(['id'=> 'delete-'.$user->getKey(),'method'=>'DELETE', 'url'=>route('crm.users.destroy', $user)])}}
            {{Form::close()}}
        @empty
            @if($frd === [])
                <div class="alert alert-secondary  text-center">
                    Пользователи отсутствуют в системе
                </div>
            @else
                <div class="alert alert-secondary  text-center">
                    По данному запросу не найдено пользователей
                </div>
            @endif
        @endforelse
        <div class="row justify-content-center pt-3">
            <div class="col-auto text-center">
                <div class="row justify-content-center mt-3">
                    {{ $users->appends($frd ?? [])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
