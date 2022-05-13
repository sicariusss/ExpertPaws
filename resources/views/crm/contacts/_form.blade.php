<?php
/**
 * @var \App\Models\Contact $contact
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'name',
    'type' => 'text',
    'value' => isset($role) ? $role->getName() : ''
])

@include('forms._input', [
    'label' => 'Отображаемое название',
    'required'=>'required',
    'name' => 'display_name',
    'type' => 'text',
    'value' => isset($role) ? $role->getDisplayName() : ''
])
