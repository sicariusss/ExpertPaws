<?php
/**
 * @var \App\Models\Product $product
 */

?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('crm.products.index')}}" class="index-title">
            Все товары
        </a>
        {{ Form::open(['url'=>route('crm.products.index'),'method'=>'GET','onchange'=>'this.submit();']) }}
        <div class="row justify-content-center align-items-end pb-5 pt-3">
            <div class="col-lg-8">
                <label for="search" class="search-label">Поиск</label>
                @include('forms._input',[
               'name'=>'search',
               'placeholder' => 'Введите название, производителя или категорию...',
               'value' => $data['search'] ?? null
           ])
            </div>
            <div class="col-lg-auto pt-3 pt-lg-0">
                <a href="{{ route('crm.products.create') }}" class="btn btn-outline-paw">
                    Добавить товар <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        {{ Form::close() }}
        @if(count($products) > 0)
            <div class="row py-1 mx-1 table-title pc-block">
                <div class="col-lg-1">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> №
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Название
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Категория
                    </div>
                </div>
                <div class="col-lg-3">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Производитель
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Цена
                    </div>
                </div>
                <div class="col-lg-2">
                    <div>
                        <i class="fa-solid fa-chevron-right"></i> Действия
                    </div>
                </div>
            </div>
        @endif
        @forelse($products as $key => $product)
            <div class="row py-1 mx-1 align-items-center index-table-row pc-block">
                <div class="col-lg-1">
                    {{ $product->getKey() }}
                </div>
                <div class="col-lg-2">
                    {{ $product->getName() }}
                </div>
                <div class="col-lg-2">
                    {{ $product->getCategory()->getName() }}
                </div>
                <div class="col-lg-3">
                    {{ $product->getManufacturer() ?? '-' }}
                </div>
                <div class="col-lg-2">
                    {{ $product->getPrice()}} ₽
                </div>
                <div class="col-lg-2">
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.products.show', $product)}}" title="Подробная информация"
                           class="btn btn-outline-primary action-btn">
                            <i class="fa-solid fa-barcode"></i>
                        </a>
                        <a href="{{route('crm.products.edit', $product)}}" title="Редактировать"
                           class="btn btn-outline-success action-btn">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete-{{$product->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление товара{{' "' . $product->getName() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row py-3 mx-1 table-mobile mobile-block  {{$key !== 0 ? 'border-top' : ''}}">
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> №:</span> {{ $product->getKey() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Название:</span> {{ $product->getName() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Категория:</span> {{ $product->getCategory()->getName() }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Производитель:</span> {{ $product->getManufacturer() ?? '-' }}
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Цена:</span> {{ $product->getPrice() }} ₽
                </div>
                <div>
                    <span><i class="fa-solid fa-chevron-right"></i> Действия:</span>
                    <div class="btn-group" role="group">
                        <a href="{{route('crm.products.show', $product)}}" title="Подробная информация"
                           class="btn btn-outline-primary action-btn">
                            <i class="fa-solid fa-barcode"></i>
                        </a>
                        <a href="{{route('crm.products.edit', $product)}}" title="Редактировать"
                           class="btn btn-outline-success action-btn">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete-{{$product->getKey()}}" title="Удалить"
                                class="btn btn-outline-danger action-btn"
                                onclick="return confirm('Подтвердите удаление товара{{' "' . $product->getName() . '"'}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{Form::open(['id'=> 'delete-'.$product->getKey(),'method'=>'DELETE', 'url'=>route('crm.products.destroy', $product)])}}
            {{Form::close()}}
        @empty
            @if($data === [])
                <div class="alert text-center">
                    Товары отсутствуют в системе
                </div>
            @else
                <div class="alert text-center">
                    По данному запросу не найдено товаров
                </div>
            @endif
        @endforelse
        <div class="row justify-content-center pt-3">
            <div class="col-auto text-center">
                <div class="row justify-content-center mt-3">
                    {{ $products->appends($data ?? [])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
