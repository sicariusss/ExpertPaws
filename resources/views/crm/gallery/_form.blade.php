<?php
/**
 * @var \App\Models\Gallery $gallery
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'name' => 'name',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($gallery) ? $gallery->getName() : ''
])

@include('forms._input', [
    'label' => 'Описание',
    'name' => 'description',
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($gallery) ? $gallery->getDescription() : ''
])

@include('forms._file-custom', [
    'name' => 'image',
    'required'=>'required',
    'label' => 'Изображение'
])
