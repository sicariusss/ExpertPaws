<?php
/**
 * @var \App\Models\Contact $contact
 */
?>
@extends('layouts.app')
@section('content')
    <a href="{{route('crm.contacts.index')}}" class="index-title">
        Все контакты
    </a>
    {{ Form::open(['url'=>route('crm.contacts.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
    <div class="row justify-content-center align-items-end pb-5 pt-3">
        <div class="col-lg-8">
            <label for="search" class="search-label">Поиск</label>
            @include('forms._input',[
           'name'=>'search',
           'placeholder' => 'Введите название или тип...',
           'value' => $data['search'] ?? null
       ])
        </div>
        <div class="col-lg-auto pt-3 pt-lg-0">
            <a href="{{ route('crm.contacts.create') }}" class="btn btn-outline-paw">
                Добавить контакт <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    {{ Form::close() }}
    @if(count($contacts) > 0)
        <div class="row py-1 mx-1 table-title pc-block">
            <div class="col-lg-1">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> №
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Название
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Тип
                </div>
            </div>
            <div class="col-lg-3">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Контакт
                </div>
            </div>
            <div class="col-lg-2">
                <div>
                    <i class="fa-solid fa-chevron-right"></i> Действия
                </div>
            </div>
        </div>
    @endif
    @forelse($contacts as $key => $contact)
        <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
            <div class="col-lg-1">
                {{ $contact->getKey() }}
            </div>
            <div class="col-lg-3">
                {{ $contact->getTitle() }}
            </div>
            <div class="col-lg-3">
                {{ $contact->getType() }}
            </div>
            <div class="col-lg-3 text-break">
                {{ $contact->getContent() }}
            </div>
            <div class="col-lg-2">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.contacts.show', $contact)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        {!! $contact->getTypeIcon() !!}
                    </a>
                    <a href="{{route('crm.contacts.edit', $contact)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$contact->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление контакта{{' "' . $contact->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $contact->getKey() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $contact->getTitle() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Тип:</span> {{ $contact->getType() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Контакт:</span> {{ $contact->getContent() }}
            </div>
            <div>
                <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                <div class="btn-group" role="group">
                    <a href="{{route('crm.contacts.show', $contact)}}" title="Подробная информация"
                       class="btn btn-outline-primary action-btn">
                        {!! $contact->getTypeIcon() !!}
                    </a>
                    <a href="{{route('crm.contacts.edit', $contact)}}" title="Редактировать"
                       class="btn btn-outline-success action-btn">
                        <i class="far fa-edit"></i>
                    </a>
                    @if(Auth::user()->getRoleId() === \App\Models\Role::DEVELOPER || Auth::user()->getRoleId() === \App\Models\Role::ADMIN)
                    <button form="delete-{{$contact->getKey()}}" title="Удалить"
                            class="btn btn-outline-danger action-btn"
                            onclick="return confirm('Подтвердите удаление контакта{{' "' . $contact->getTitle() . '"'}}')">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$contact->getKey(),'method'=>'DELETE', 'url'=>route('crm.contacts.destroy', $contact)])}}
        {{Form::close()}}
    @empty
        @if($data === [])
            <div class="alert text-center">
                Контакты отсутствуют в системе
            </div>
        @else
            <div class="alert text-center">
                По данному запросу не найдено контактов
            </div>
        @endif
    @endforelse
    <div class="row justify-content-center pt-3">
        <div class="col-auto text-center">
            <div class="row justify-content-center mt-3">
                {{ $contacts->appends($data ?? [])->links() }}
            </div>
        </div>
    </div>
@endsection
