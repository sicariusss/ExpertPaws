<?php
/**
 * @var \App\Models\Category $category
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'name',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($category) ? $category->getName() : ''
])

@include('forms._input', [
    'label' => 'Описание',
    'name' => 'description',
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($category) ? $category->getDescription() : ''
])

@include('forms._select', [
     'name'=>'parent_id',
     'label'=>'Родительская категория',
     'list'=>$categoriesList,
    'placeholder' => '-',
     'value'=>isset($category) ? $category->getParentId() : '',
])

@include('forms._file-custom', [
    'name' => 'preview',
    'required'=>'required',
    'label' => 'Превью категории'
])
