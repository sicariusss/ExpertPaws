<?php
/**
 * @var \App\Models\Role $role
 */
?>

@include('forms._input', [
    'label' => 'Название',
    'required'=>'required',
    'name' => 'name',
    'type' => 'text',
    'placeholder' => 'Введите название...',
    'value' => isset($role) ? $role->getName() : ''
])

@include('forms._input', [
    'label' => 'Отображаемое название',
    'required'=>'required',
    'name' => 'display_name',
    'type' => 'text',
    'placeholder' => 'Введите отображаемое название...',
    'value' => isset($role) ? $role->getDisplayName() : ''
])
