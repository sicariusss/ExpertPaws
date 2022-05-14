<?php
/**
 * @var \App\Models\Product $product
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'name',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($product) ? $product->getName() : ''
])

@include('forms._input', [
    'label' => 'Описание',
    'name' => 'description',
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($product) ? $product->getDescription() : ''
])

@include('forms._input', [
    'label' => 'Цена',
    'name' => 'price',
    'required'=>'required',
    'type' => 'number',
    'placeholder' => 'Введите цену...',
    'value' => isset($product) ? $product->getPrice() : ''
])

@include('forms._input', [
    'label' => 'Производитель',
    'name' => 'manufacturer',
    'type' => 'text',
    'placeholder' => 'Введите производителя...',
    'value' => isset($product) ? $product->getManufacturer() : ''
])

@include('forms._select', [
     'name'=>'category_id',
    'required'=>'required',
     'label'=>'Категория',
     'list'=>$categoriesList,
    'placeholder' => '-',
     'value'=>isset($product) ? $product->getCategoryId() : '',
])

@include('forms._file-custom', [
    'name' => 'preview',
    'required'=>'required',
    'label' => 'Превью товара'
])
