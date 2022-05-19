<?php
/**
 * @var \App\Models\Product $product
 */
?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a href="{{route('crm.products.show',$product)}}" class="index-title pb-5">
                    Товар "{{$product->getName()}}"
                </a>
            </div>
            <div class="col-auto px-4 px-lg-0 pt-3 pt-lg-0">
                <div class="btn-group" role="group">
                    <a href="{{route('crm.products.edit', $product)}}" title="Редактировать" class="btn btn-outline-success">
                        Редактировать <i class="far fa-edit"></i>
                    </a>
                    <button form="delete-{{$product->getKey()}}" title="Удалить" class="btn btn-outline-danger"
                            onclick="return confirm('Подтвердите удаление товара{{' "' . $product->getName() . '"'}}')">
                        Удалить <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        {{Form::open(['id'=> 'delete-'.$product->getKey(),'method'=>'DELETE', 'url'=>route('crm.products.destroy', $product)])}}
        {{Form::close()}}

        <div class="row pt-4 pt-lg-5 justify-content-center flex-lg-row-reverse">
            <div class="col-lg-5">
                <div class="row py-lg-5 mx-1 show-data">
                    <div>
                        <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $product->getKey() }}
                    </div>
                    @if($product->getName() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $product->getName() }}
                        </div>
                    @endif
                    @if($product->getDescription() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Описание:</span> {{ $product->getDescription() }}
                        </div>
                    @endif
                    @if($product->getPrice() !== null)
                        <div>
                            <span><i
                                    class="fa-solid fa-chevron-right"></i> Цена:</span> {{ $product->getPrice() }} ₽
                        </div>
                    @endif
                    @if($product->getManufacturer() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Производитель:</span> {{ $product->getManufacturer() }}
                        </div>
                    @endif
                    @if($product->getCategory() !== null)
                        <div>
                            <span><i class="fa-solid fa-chevron-right"></i> Категория:</span> {{ $product->getCategory()->getName() }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 pt-3">
                <label for="preview">Превью товара</label>
                <img src="{{$product->getPreview()}}" id="preview" width="100%"
                     height="auto" alt="preview"/>
            </div>
        </div>
    </div>
@endsection
