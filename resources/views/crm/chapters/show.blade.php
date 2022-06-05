<?php
/**
 * @var \App\Models\Chapter $chapter
 */
?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.chapters.show',$chapter)}}" class="index-title pb-5">
                Глава "{{$chapter->getTitle()}}"
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                <a href="{{route('crm.chapters.edit', $chapter)}}" title="Редактировать"
                   class="btn btn-outline-success">
                    Редактировать <i class="far fa-edit"></i>
                </a>
                <button form="delete-{{$chapter->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление главы{{' "' . $chapter->getTitle() . '"'}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$chapter->getKey(),'method'=>'DELETE', 'url'=>route('crm.chapters.destroy', $chapter)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center">
        <div class="col-lg-8">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $chapter->getKey() }}
                </div>
                @if($chapter->getCourse() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Курс:</span> {{ $chapter->getCourse()->getTitle() }}
                    </div>
                @endif
                @if($chapter->getTitle() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $chapter->getTitle() }}
                    </div>
                @endif
                @if($chapter->getLessons()->isNotEmpty())
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Уроки:</span>
                        @foreach($chapter->getLessons() as $key => $lesson)
                            <div>
                                {{ $key+1 . '. ' . $lesson->getTitle() }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pt-3">
            <label for="icon">Иконка главы</label>
            <img src="{{$chapter->getIcon()}}" id="icon" width="100%"
                 height="auto" alt="icon"/>
        </div>
    </div>
@endsection
