<?php
/**
 * @var \App\Models\Callback $callback
 */

?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.callbacks.index')}}" class="index-title">
        Все обращения
    </a>
    {{ Form::open(['url'=>route('crm.callbacks.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите тему обращения...',
           'value' => $data['search'] ?? null
       ])
        </div>
    </div>
    {{ Form::close() }}
    @if(count($callbacks) > 0)
        <div class="row py-1 mx-1 table-title pc-block">
            <div class="col-lg-1">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> №
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Тема
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Имя отправителя
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Почта отправителя
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($callbacks as $key => $callback)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $callback->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $callback->getSubject() }}
            </div>
            <div class="col-lg-3">
                {{ $callback->getName() }}
            </div>
            <div class="col-lg-3">
                {{ $callback->getEmail() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.callbacks.show', $callback)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-regular fa-comment-dots"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$callback->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление обращения №{{$callback->getKey()}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $callback->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Тема:</span> {{ $callback->getSubject() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Имя отправителя:</span> {{ $callback->getName() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Почта отправителя:</span> {{ $callback->getEmail() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.callbacks.show', $callback)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        <i class="fa-regular fa-comment-dots"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$callback->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление обращения №{{$callback->getKey()}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$callback->getKey(),'method'=>'DELETE', 'url'=>route('crm.callbacks.destroy', $callback)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Обращения отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено обращений
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $callbacks->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
