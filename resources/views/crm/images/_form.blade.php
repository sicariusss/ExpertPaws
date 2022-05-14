<?php
/**
 * @var \App\Models\Image $image
 */
?>

@include('forms._input', [
    'label' => 'Тип',
    'name' => 'type',
    'required'=>'required',
    'type' => 'text',
    'placeholder' => 'Введите тип...',
    'value' => isset($image) ? $image->getType() : ''
])

@include('forms._input', [
    'label' => 'Id типа',
    'name' => 'type_id',
    'required'=>'required',
    'type' => 'text',
    'placeholder' => 'Введите id типа...',
    'value' => isset($image) ? $image->getTypeId() : ''
])

@include('forms._file-custom', [
    'name' => 'image',
    'required'=>'required',
    'label' => 'Изображение'
])
