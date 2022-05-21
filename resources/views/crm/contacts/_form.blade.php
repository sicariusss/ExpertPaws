<?php
/**
 * @var \App\Models\Contact $contact
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
    'value' => isset($contact) ? $contact->getTitle() : ''
])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
    'label' => 'Контакт',
    'required'=>'required',
    'name' => 'content',
    'type' => 'text',
    'placeholder' => 'Введите контакт...',
    'value' => isset($contact) ? $contact->getContent() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
     'name'=>'type',
    'required'=>'required',
     'label'=>'Тип контакта',
     'list'=>$typesList,
    'placeholder' => '-',
     'value'=>isset($contact) ? $contact->getType() : '',
])
            </div>
        </div>
    </div>
</div>

