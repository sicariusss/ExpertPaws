<?php
/**
 * @var \App\Models\Lesson $lesson
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.lessons.show',$lesson)}}" class="index-title pb-5">
                Урок "{{$lesson->getTitle()}}"
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                <a href="{{route('crm.lessons.edit', $lesson)}}" title="Редактировать"
                   class="btn btn-outline-success">
                    Редактировать <i class="far fa-edit"></i>
                </a>
                <button form="delete-{{$lesson->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление урока{{' "' . $lesson->getTitle() . '"'}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$lesson->getKey(),'method'=>'DELETE', 'url'=>route('crm.lessons.destroy', $lesson)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center">
        <div class="col-lg-10">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $lesson->getKey() }}
                </div>
                @if($lesson->getCourse() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Курс:</span> {{ $lesson->getCourse()->getTitle() }}
                    </div>
                @endif
                @if($lesson->getTitle() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $lesson->getTitle() }}
                    </div>
                @endif
                @if($lesson->getDescription() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $lesson->getDescription() }}
                    </div>
                @endif
                @if($lesson->getContent() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Контент:</span> {{ $lesson->getContent() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
