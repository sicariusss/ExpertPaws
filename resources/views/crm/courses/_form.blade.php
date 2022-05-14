<?php
/**
 * @var \App\Models\Course $course
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($course) ? $course->getTitle() : ''
])

@include('forms._input', [
    'label' => 'Краткое описание',
    'required'=>'required',
    'name' => 'short_description',
    'type' => 'text',
    'placeholder' => 'Введите краткое описание...',
    'value' => isset($course) ? $course->getShortDescription() : ''
])

@include('forms._input', [
    'label' => 'Описание',
    'required'=>'required',
    'name' => 'full_description',
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($course) ? $course->getFullDescription() : ''
])

@include('forms._input', [
    'label' => 'Цена',
    'required'=>'required',
    'name' => 'price',
    'type' => 'number',
    'placeholder' => 'Введите цену...',
    'value' => isset($course) ? $course->getPrice() : ''
])

@include('forms._file-custom', [
    'name' => 'preview',
    'required'=>'required',
    'label' => 'Превью курса'
])
