<?php
/**
 * @var \App\Models\Course $course
 */

?>
@extends('layouts.app')
@section('content')
    <div class="row justify-content-between align-items-center">
        <div class="col-auto">
            <a href="{{route('crm.courses.show',$course)}}" class="index-title pb-5">
                Курс "{{$course->getTitle()}}"
            </a>
        </div>
        <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
            <div class="btn-group" role="group">
                <a href="{{route('crm.courses.edit', $course)}}" title="Редактировать"
                   class="btn btn-outline-success">
                    Редактировать <i class="far fa-edit"></i>
                </a>
                <button form="delete-{{$course->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                        onclick="return confirm('Подтвердите удаление курса{{' "' . $course->getTitle() . '"'}}')">
                    Удалить <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
    {{Form::open(['id'=> 'delete-'.$course->getKey(),'method'=>'DELETE', 'url'=>route('crm.courses.destroy', $course)])}}
    {{Form::close()}}

    <div class="row pt-4 pt-lg-5 justify-content-center flex-lg-row-reverse">
        <div class="col-lg-5">
            <div class="row py-lg-5 mx-1 show-data">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $course->getKey() }}
                </div>
                @if($course->getTitle() !== null)
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $course->getTitle() }}
                    </div>
                @endif
                @if($course->getPrice() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Цена:</span> {{ $course->getPrice() }} ₽
                    </div>
                @endif
                @if($course->getSchool() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Направление:</span> {{ $course->getSchool() }}
                    </div>
                @endif
                @if($course->getHours() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Объем программы:</span> {{ $course->getPrice() }}
                        ч.
                    </div>
                @endif
                @if($course->getShortDescription() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Короткое описание:</span> {{ $course->getShortDescription() }}
                    </div>
                @endif
                @if($course->getFullDescription() !== null)
                    <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Полное описание:</span> {{ $course->getFullDescription() }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 pt-3">
            <label for="preview">Превью курса</label>
            <img src="{{$course->getPreview()}}" id="preview" width="100%"
                 height="auto" alt="preview"/>
        </div>
    </div>
@endsection
