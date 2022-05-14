<?php
/**
 * @var \App\Models\Contact $contact
 */
?>

@include('forms._select', [
     'name'=>'type',
    'required'=>'required',
     'label'=>'Тип контакта',
     'list'=>$typesList,
    'placeholder' => 'Введите тип контакта...',
     'value'=>isset($contact) ? $contact->getType() : '',
])

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'title',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($contact) ? $contact->getTitle() : ''
])

@include('forms._input', [
    'label' => 'Контакт',
    'required'=>'required',
    'name' => 'content',
    'type' => 'text',
    'placeholder' => 'Введите контакт...',
    'value' => isset($contact) ? $contact->getContent() : ''
])
