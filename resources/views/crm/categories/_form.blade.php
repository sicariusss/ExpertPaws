<?php
/**
 * @var \App\Models\Category $category
 */
?>
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
      'label' => 'Название',
      'required'=>'required',
      'name' => 'name',
      'type' => 'text',
      'placeholder' => 'Введите название...',
      'value' => isset($category) ? $category->getName() : ''
  ])

            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
         'name'=>'parent_id',
         'label'=>'Родительская категория',
         'list'=>$categoriesList,
        'placeholder' => '-',
         'value'=>isset($category) ? $category->getParentId() : '',
    ])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
                @include('forms._textarea', [
   'label' => 'Описание',
   'name' => 'description',
   'type' => 'text',
   'rows' => 4,
   'placeholder' => 'Введите описание...',
       'value' => isset($category) ? $category->getDescription() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'preview',
                    'required'=>!(isset($category)),
                    'label' => 'Превью категории',
                    'attributes' => [
                        'onchange' => 'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <label for="preview">Превью категории</label>
        <img src="{{isset($category) ? $category->getPreview() : '/images/categories/default-preview.png'}}"
             id="preview"
             width="100%"
             height="auto" alt="preview"/>
    </div>
</div>
