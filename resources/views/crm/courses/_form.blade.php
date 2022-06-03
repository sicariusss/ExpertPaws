<?php
/**
 * @var \App\Models\Course $course
 */
?>
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
     'label' => 'Название',
     'required'=>'required',
     'name' => 'title',
     'type' => 'text',
     'placeholder' => 'Введите название...',
     'value' => isset($course) ? $course->getTitle() : ''
 ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
       'label' => 'Цена',
       'required'=>'required',
       'name' => 'price',
       'type' => 'number',
       'placeholder' => 'Введите цену...',
       'value' => isset($course) ? $course->getPrice() : ''
   ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
     'label' => 'Направление',
     'required'=>'required',
     'name' => 'school',
     'type' => 'text',
     'placeholder' => 'Введите направление...',
     'value' => isset($course) ? $course->getSchool() : ''
 ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
       'label' => 'Объем программы в часах',
       'required'=>'required',
       'name' => 'hours',
       'type' => 'number',
       'placeholder' => 'Введите объем...',
       'value' => isset($course) ? $course->getHours() : ''
   ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
      'label' => 'Краткое описание',
      'required'=>'required',
     'rows' => 4,
      'name' => 'short_description',
      'type' => 'text',
      'placeholder' => 'Введите краткое описание...',
      'value' => isset($course) ? $course->getShortDescription() : ''
  ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
       'label' => 'Полное описание',
       'required'=>'required',
   'rows' => 5,
       'name' => 'full_description',
       'type' => 'text',
       'placeholder' => 'Введите описание...',
       'value' => isset($course) ? $course->getFullDescription() : ''
   ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'preview',
                    'required'=>!(isset($course)),
                    'label' => 'Превью курса',
                    'attributes' => [
                        'onchange' => 'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <label for="preview">Превью курса</label>
        <img src="{{isset($course) ? $course->getPreview() : '/images/default-preview.png'}}"
             id="preview"
             width="100%"
             height="auto" alt="preview"/>
    </div>
</div>
