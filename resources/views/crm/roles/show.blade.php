<?php
/**
 * @var \App\Models\Role $role
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.roles.show',$role)}}" class="index-title pb-5">
                    Роль "{{$role->getDisplayName()}}"
                </a>
            </div>
            <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.roles.edit', $role)}}" title="Редактировать" class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$role->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление роли{{' "' . $role->getDisplayName() . '"'}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$role->getKey(),'method'=>'DELETE', 'url'=>route('crm.roles.destroy', $role)])}}
        {{Form::close()}}

        <div class="row pt-4 pt-lg-5 justify-content-center">
            <div class="col-lg-10">
                <div class="row py-lg-5 mx-1 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $role->getKey() }}
                    </div>
                    @if($role->getName() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $role->getName() }}
                        </div>
                    @endif
                    @if($role->getDisplayName() !== null)
                        <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Отображаемое название:</span> {{ $role->getDisplayName() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
