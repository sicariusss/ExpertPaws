<?php
/**
 * @var \App\Models\User $user
 */
?>

@include('forms._input', [
    'label' => 'Фамилия',
    'name' => 'surname',
    'type' => 'text',
    'value' => isset($user) ? $user->getSurname() : ''
])

@include('forms._input', [
    'label' => 'Имя',
    'required'=>'required',
    'name' => 'name',
    'type' => 'text',
    'value' => isset($user) ? $user->getName() : ''
])

@include('forms._input', [
    'label' => 'Отчество',
    'name' => 'patronymic',
    'type' => 'text',
    'value' => isset($user) ? $user->getPatronymic() : ''
])

@include('forms._input', [
    'label' => 'Email',
    'required'=>'required',
    'name' => 'email',
    'type' => 'email',
    'value' => isset($user) ? $user->getEmail() : ''
])

@include('forms._input', [
    'label' => 'Телефон',
    'name' => 'phone',
    'type' => 'tel',
    'value' => isset($user) ? $user->getPhone() : ''
])

@include('forms._input', [
    'label' => 'Адрес',
    'name' => 'address',
    'type' => 'text',
    'value' => isset($user) ? $user->getAddress() : ''
])

@include('forms._select', [
     'name'=>'role_id',
     'label'=>'Роль',
     'list'=>$rolesList,
     'value'=>isset($user) ? $user->getRoleId() : '',
])

@include('forms._input', [
    'label' => 'Пароль',
    'required'=>'required',
    'name' => 'password',
    'type' => 'password',
])

@include('forms._file-custom', [
    'name' => 'photo',
    'label' => 'Аватарка'
])
