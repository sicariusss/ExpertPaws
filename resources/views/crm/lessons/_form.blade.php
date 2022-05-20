<?php
/**
 * @var \App\Models\Lesson $lesson
 */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($lesson) ? $lesson->getTitle() : ''
])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
     'name'=>'course_id',
    'required'=>'required',
     'label'=>'Курс, к которому привязать урок',
     'list'=>$coursesList,
    'placeholder' => '-',
     'value'=>isset($lesson) ? $lesson->getCourseId() : '',
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Описание',
    'required'=>'required',
    'name' => 'description',
   'rows' => 3,
    'type' => 'text',
    'placeholder' => 'Введите описание...',
    'value' => isset($lesson) ? $lesson->getDescription() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Контент',
    'required'=>'required',
    'name' => 'content',
    'type' => 'text',
   'rows' => 5,
    'placeholder' => 'Введите контент...',
    'value' => isset($lesson) ? $lesson->getContent() : ''
])
            </div>
        </div>
    </div>
</div>
