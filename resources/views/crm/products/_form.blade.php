<?php
/**
 * @var \App\Models\Product $product
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
    'value' => isset($product) ? $product->getName() : ''
])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
                    'label' => 'Цена',
                    'name' => 'price',
                    'required'=>'required',
                    'type' => 'number',
                    'placeholder' => 'Введите цену...',
                    'value' => isset($product) ? $product->getPrice() : ''
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
    'value' => isset($product) ? $product->getDescription() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
                    'label' => 'Производитель',
                    'name' => 'manufacturer',
                    'type' => 'text',
                    'placeholder' => 'Введите производителя...',
                    'value' => isset($product) ? $product->getManufacturer() : ''
                ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
     'name'=>'category_id',
    'required'=>'required',
     'label'=>'Категория',
     'list'=>$categoriesList,
    'placeholder' => '-',
     'value'=>isset($product) ? $product->getCategoryId() : '',
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'preview',
                    'required'=>!(isset($product)),
                    'label' => 'Превью товара',
                    'attributes' => [
                        'onchange' => 'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <label for="preview">Превью товара</label>
        <img src="{{isset($product) ? $product->getPreview() : '/images/products/default-preview.png'}}" id="preview"
             width="100%"
             height="auto" alt="preview"/>
    </div>
</div>
