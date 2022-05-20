<?php
/**
 * @var \App\Models\Gallery $gallery
 */
?>
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
     'label' => 'Название',
     'name' => 'name',
     'type' => 'text',
     'placeholder' => 'Введите название...',
     'value' => isset($gallery) ? $gallery->getName() : ''
 ])
            </div>
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'image',
                    'required'=>!(isset($gallery)),
                    'label' => 'Изображение',
                    'attributes' => [
                        'onchange' => 'document.getElementById("image").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Описание',
    'name' => 'description',
    'type' => 'text',
   'rows' => 3,
    'placeholder' => 'Введите описание...',
    'value' => isset($gallery) ? $gallery->getDescription() : ''
])
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="image">Изображение</label>
        <img src="{{isset($gallery) ? $gallery->getImage() : '/images/default-preview.png'}}"
             id="image"
             width="100%"
             height="auto" alt="image"/>
    </div>
</div>
