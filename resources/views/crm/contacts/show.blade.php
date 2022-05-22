<?php
/**
 * @var \App\Models\Contact $contact
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.contacts.show',$contact)}}" class="index-title pb-5">
                Контакт "{{$contact->getTitle()}}"
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                <a href="{{route('crm.contacts.edit', $contact)}}" title="Редактировать"
                   class="btn btn-outline-success">
                    Редактировать <i class="far fa-edit"></i>
                </a>
                <button form="delete-{{$contact->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление контакта{{' "' . $contact->getTitle() . '"'}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$contact->getKey(),'method'=>'DELETE', 'url'=>route('crm.contacts.destroy', $contact)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center">
        <div class="col-lg-10">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $contact->getKey() }}
                </div>
                @if($contact->getTitle() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $contact->getTitle() }}
                    </div>
                @endif
                @if($contact->getType() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Тип:</span> {!! $contact->getTypeIcon() !!} {{ $contact->getType() }}
                    </div>
                @endif
                @if($contact->getContent() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Контакт:</span> {{ $contact->getContent() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
