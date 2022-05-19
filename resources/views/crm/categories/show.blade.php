<?php
/**
 * @var \App\Models\Category $category
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.categories.show',$category)}}" class="index-title pb-5">
                    Категория "{{$category->getName()}}"
                </a>
            </div>
            <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.categories.edit', $category)}}" title="Редактировать"
                       class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$category->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление категории{{' "' . $category->getName() . '"'}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$category->getKey(),'method'=>'DELETE', 'url'=>route('crm.categories.destroy', $category)])}}
        {{Form::close()}}

        <div class="row pt-4 pt-lg-5 justify-content-center flex-lg-row-reverse">
            <div class="col-lg-5">
                <div class="row py-lg-5 mx-1 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $category->getKey() }}
                    </div>
                    @if($category->getName() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $category->getName() }}
                        </div>
                    @endif
                    @if($category->getDescription() !== null)
                        <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $category->getDescription() }}
                        </div>
                    @endif
                    @if($category->getParent() !== null)
                        <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Надкатегория:</span> {{ $category->getParent()->getName() }}
                        </div>
                    @endif
                    @if($category->getChildren()->isNotEmpty())
                        <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Подкатегории:</span> {{ $category->getChildrenString() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 pt-3">
                <label for="preview">Превью категории</label>
                <img src="{{$category->getPreview()}}" id="preview" width="100%"
                     height="auto" alt="preview"/>
            </div>
        </div>
    </div>
@endsection
