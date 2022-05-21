<?php
/**
 * @var \App\Models\Image $image
 */
?>
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
    'name'=>'type',
    'id'=>'type',
   'required'=>'required',
    'label'=>'Тип',
    'list'=>$typesList,
   'placeholder' => '-',
    'value' => isset($image) ? $image->getType() : ''
])
            </div>
            <div class="col-lg-6"
                 style="display: {{isset($image) && $image->getType() === 'product_pic' || $errors->has('type_product') ? 'block' : 'none'}}">
                @include('forms._select', [
    'name'=>'type_product',
    'id'=>'type-product',
    'label'=>'Продукт',
    'list'=>$productsList,
   'placeholder' => '-',
    'value' => isset($image) && $image->getType() === 'product_pic' ? $image->getTypeId() : ''
])
            </div>
            <div class="col-lg-6"
                 style="display: {{isset($image) && $image->getType() === 'course_pic' || $errors->has('type_course') ? 'block' : 'none'}}">
                @include('forms._select', [
    'name'=>'type_course',
    'id'=>'type-course',
    'label'=>'Курс',
    'list'=>$coursesList,
   'placeholder' => '-',
    'value' => isset($image) && $image->getType() === 'course_pic' ? $image->getTypeId() : ''
])
            </div>
            <div class="col-lg-6"
                 style="display: {{isset($image) && $image->getType() === 'lesson_pic' || $errors->has('type_lesson') ? 'block' : 'none'}}">
                @include('forms._select', [
    'name'=>'type_lesson',
    'id'=>'type-lesson',
    'label'=>'Урок',
    'list'=>$lessonsList,
   'placeholder' => '-',
    'value' => isset($image) && $image->getType() === 'lesson_pic' ? $image->getTypeId() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'image',
                    'required'=>!(isset($image)),
                    'label' => 'Изображение',
                    'attributes' => [
                        'onchange' => 'document.getElementById("image").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="image">Изображение</label>
        <img src="{{isset($image) ? $image->getPath() : '/images/default-preview.png'}}"
             id="image"
             width="100%"
             height="auto" alt="image"/>
    </div>
</div>

<script>
    let typeSelect = document.querySelector("[id$=type]");
    typeSelect.onchange = function () {
        let value = typeSelect.value;
        if (value === 'bg_site' || value === 'bg_crm') {
            document.querySelector("[id$=type-product]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-course]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-lesson]").parentElement.parentElement.style.display = 'none';
        } else if (value === 'product_pic') {
            document.querySelector("[id$=type-product]").parentElement.parentElement.style.display = 'block';
            document.querySelector("[id$=type-course]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-lesson]").parentElement.parentElement.style.display = 'none';
        } else if (value === 'course_pic') {
            document.querySelector("[id$=type-product]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-course]").parentElement.parentElement.style.display = 'block';
            document.querySelector("[id$=type-lesson]").parentElement.parentElement.style.display = 'none';
        } else if (value === 'lesson_pic') {
            document.querySelector("[id$=type-product]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-course]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-lesson]").parentElement.parentElement.style.display = 'block';
        } else {
            document.querySelector("[id$=type-product]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-course]").parentElement.parentElement.style.display = 'none';
            document.querySelector("[id$=type-lesson]").parentElement.parentElement.style.display = 'none';
        }
    };
</script>
