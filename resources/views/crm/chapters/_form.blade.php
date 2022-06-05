<?php
/**
 * @var \App\Models\Chapter $chapter
 */
?>
<div class="row">
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($chapter) ? $chapter->getTitle() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._select', [
     'name'=>'course_id',
    'required'=>'required',
     'label'=>'Курс, к которой привязать главу',
     'list'=>$coursesList,
    'placeholder' => '-',
     'value'=>isset($chapter) ? $chapter->getCourseId() : '',
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'icon',
                    'required'=>!(isset($chapter)),
                    'label' => 'Иконка главы',
                    'attributes' => [
                        'onchange' => 'document.getElementById("icon").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <label for="icon">Иконка главы</label>
        <img src="{{isset($chapter) ? $chapter->getIcon() : '/images/default-preview.png'}}"
             id="icon"
             width="100%"
             height="auto" alt="icon"/>
    </div>
</div>
