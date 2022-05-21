@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.courses.edit',$contact)}}" class="index-title pb-5">
                    Изменить контакт "{{$contact->getTitle()}}"
                </a>
            </div>
            <div class="col-auto pc-block">
                <button form="edit-contact" class="btn btn-outline-paw">Изменить контакт</button>
            </div>
        </div>
        <div class="row justify-content-center pt-4">
            <div class="col-12">
                {{Form::model($contact, ['url'=> route('crm.contacts.update', $contact), 'method' => 'PATCH', 'id'=>'edit-contact'])}}
                @include('crm.contacts._form', $contact)
                {{Form::close()}}
                <div class="col-auto mobile-block pt-3">
                    <button form="edit-contact" class="btn btn-outline-paw">Изменить контакт</button>
                </div>
            </div>
        </div>
    </div>
@endsection
