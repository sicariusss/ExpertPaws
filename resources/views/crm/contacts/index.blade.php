<?php
/**
 * @var \App\Models\Contact $contact
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container wrapper-primary">
        {{ Form::open(['url'=>route('crm.contacts.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
        <div class="row justify-content-center pb-5 pt-3">
            <div class="col-lg-8">
                @include('forms._input',[
               'name'=>'search',
               'placeholder' => 'Введите тип, название или контакт...',
               'value' => $data['search'] ?? null
           ])
            </div>
            <div class="col-lg-auto">
                <a href="{{ route('crm.contacts.create') }}" class="btn btn-outline-success">
                    Добавить роль&nbsp;<i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        @if(count($contacts) > 0)
            <div class="row py-1 mx-1">
                <div class="col-lg-1">
                    <h5 class="font-weight-bold">
                        №
                    </h5>
                </div>
                <div class="col-lg-3">
                    <h5 class="font-weight-bold">
                        Название
                    </h5>
                </div>
                <div class="col-lg-2">
                    <h5 class="font-weight-bold">
                        Действия
                    </h5>
                </div>
            </div>
        @endif
        @forelse($contacts as $contact)
            <div class="row py-1 mx-1 border-top align-items-center">
                <div class="col-lg-1">
                    {{ $contact->getKey() }}
                </div>
                <div class="col-lg-3">
                    {{ $contact->getTitle() }}
                </div>
                <div class="col-lg-2">
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.contacts.edit', $contact)}}" class="btn btn-outline-primary py-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button form="delete-{{$contact->getKey()}}" class="btn btn-outline-danger py-1"
                                onclick="return confirm('Подтвердите удаление контакта{{' "' . $contact->getTitle() . '"'}}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{Form::open(['id'=> 'delete-'.$contact->getKey(),'method'=>'DELETE', 'url'=>route('crm.contacts.destroy', $contact)])}}
            {{Form::close()}}
        @empty
            @if($data === [])
                <div class="alert alert-secondary  text-center">
                    Контакты отсутствуют в системе
                </div>
            @else
                <div class="alert alert-secondary  text-center">
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
    </div>
@endsection