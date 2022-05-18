<?php
/**
 * @var \App\Models\User $user
 */
?>

<div class="row">
    <div class="col-4">
        @include('forms._input', [
            'label' => 'Фамилия',
            'name' => 'surname',
            'type' => 'text',
            'placeholder' => 'Введите фамилию...',
            'value' => isset($user) ? $user->getSurname() : ''
        ])
    </div>
    <div class="col-4">
        @include('forms._input', [
            'label' => 'Имя',
            'required'=>'required',
            'name' => 'name',
            'type' => 'text',
            'placeholder' => 'Введите имя...',
            'value' => isset($user) ? $user->getName() : ''
        ])
    </div>
    <div class="col-4">
        @include('forms._input', [
            'label' => 'Отчество',
            'name' => 'patronymic',
            'type' => 'text',
            'placeholder' => 'Введите отчество...',
            'value' => isset($user) ? $user->getPatronymic() : ''
        ])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('forms._input', [
            'label' => 'Email',
            'required'=>'required',
            'name' => 'email',
            'type' => 'email',
            'placeholder' => 'Введите email...',
            'value' => isset($user) ? $user->getEmail() : ''
        ])
    </div>
    <div class="col-6">@include('forms._input', [
    'label' => 'Телефон',
    'name' => 'phone',
    'type' => 'tel',
    'placeholder' => 'Введите телефон...',
    'value' => isset($user) ? $user->getPhone() : ''
])
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('forms._input', [
    'label' => 'Адрес',
    'name' => 'address',
    'type' => 'text',
    'placeholder' => 'Введите адрес...',
    'value' => isset($user) ? $user->getAddress() : ''
])
    </div>
</div>
<div class="row">
    <div class="col-6">
        @include('forms._select', [
             'name'=>'role_id',
             'label'=>'Роль',
             'list'=>$rolesList,
            'placeholder' => '-',
             'value'=>isset($user) ? $user->getRoleId() : '',
        ])
    </div>
    <div class="col-6">
        @include('forms._input', [
    'label' => 'Пароль',
    'required'=>'required',
    'name' => 'password',
    'type' => 'password',
    'placeholder' => 'Введите пароль...',
])
    </div>
</div>

@include('forms._file-custom', [
    'name' => 'photo',
    'label' => 'Аватарка'
])
