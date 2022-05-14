<?php
/**
 * @var \App\Models\Lesson $lesson
 */

?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($lesson) ? $lesson->getTitle() : ''
])

@include('forms._input', [
    'label' => 'Описание',
    'required'=>'required',
    'name' => 'description',
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($lesson) ? $lesson->getDescription() : ''
])

@include('forms._input', [
    'label' => 'Контент',
    'required'=>'required',
    'name' => 'content',
    'type' => 'text',
    'placeholder' => 'Введите контент...',
    'value' => isset($lesson) ? $lesson->getContent() : ''
])

@include('forms._select', [
     'name'=>'course_id',
    'required'=>'required',
     'label'=>'Курс, к которому привязать урок',
     'list'=>$coursesList,
    'placeholder' => '-',
     'value'=>isset($lesson) ? $lesson->getCourseId() : '',
])
