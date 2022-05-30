<?php
/**
 * @var \App\Models\Review $review
 */
?>
<div class="row">
    <div class="{{isset($review) && $review->getImage() !== null ? 'col-lg-8' : 'col-lg-12'}}">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
     'label' => 'Заголовок',
     'name' => 'title',
     'type' => 'text',
     'placeholder' => 'Введите заголовок...',
     'value' => isset($review) ? $review->getTitle() : ''
 ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
    'name'=>'user_id',
    'label'=>'Пользователь',
    'required' => 'required',
    'list'=>$usersList,
   'placeholder' => '-',
    'value' => isset($review) ? $review->getUserId() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
    'label' => 'Отзыв',
    'name' => 'description',
    'required' => 'required',
    'type' => 'text',
   'rows' => 4,
    'placeholder' => 'Введите отзыв...',
    'value' => isset($review) ? $review->getDescription() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._file',[
                    'name' => 'image',
                    'label' => 'Изображение',
                    'attributes' => [
                        'onchange' => 'document.getElementById("image").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    @if(!(isset($review)) || $review->getImage() === null)
        <div class="col-lg-12">
            <div class="row">
                <div class="col-3">
                    <img src=" "
                         id="image"
                         width="100%"
                         height="auto"/>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-4">
            <img src="{{$review->getImage()}}"
                 id="image"
                 width="100%"
                 height="auto"/>
            <a class="btn btn-outline-danger mt-3"
               onclick='document.getElementById("image").src = " "; document.getElementById("image").value = null;
               document.getElementsByName("delete_image")[0].value = true; this.style.display = "none";'>
                Удалить изображение
            </a>
            @endif
        </div>
        {{Form::hidden('delete_image',false)}}
</div>

