<?php
/**
 * @var \App\Models\User $user
 */
?>
<div class="row">
    <div class="col-lg-10">
        <div class="row">
            <div class="col-lg-4 pb-2">
                @include('forms._input', [
                    'label' => 'Фамилия',
                    'name' => 'surname',
                    'type' => 'text',
                    'placeholder' => 'Введите фамилию...',
                    'value' => isset($user) ? $user->getSurname() : ''
                ])
            </div>
            <div class="col-lg-4 pb-2">
                @include('forms._input', [
                    'label' => 'Имя',
                    'required'=>'required',
                    'name' => 'name',
                    'type' => 'text',
                    'placeholder' => 'Введите имя...',
                    'value' => isset($user) ? $user->getName() : ''
                ])
            </div>
            <div class="col-lg-4 pb-2">
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
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
                    'label' => 'Email',
                    'required'=>'required',
                    'name' => 'email',
                    'type' => 'email',
                    'placeholder' => 'Введите email...',
                    'value' => isset($user) ? $user->getEmail() : ''
                ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
    'label' => 'Телефон',
    'name' => 'phone',
    'type' => 'tel',
    'placeholder' => 'Введите телефон...',
    'value' => isset($user) ? $user->getPhone() : ''
])
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 pb-2">
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
            <div class="col-lg-6 pb-2">
                @include('forms._select', [
                     'name'=>'role_id',
                     'label'=>'Роль',
                     'list'=>$rolesList,
                    'placeholder' => '-',
                     'value'=>isset($user) ? $user->getRoleId() : '',
                ])
            </div>
            @if(!(isset($user)))
                <div class="col-lg-6 pb-2">
                    @include('forms._input', [
                'label' => 'Пароль',
                'required'=>'required',
                'name' => 'password',
                'type' => 'password',
                'placeholder' => 'Введите пароль...',
            ])
                </div>
            @endif
            <div class="col-lg-6">
                @include('forms._file',[
                    'name' => 'photo',
                    'label' => 'Фото профиля',
                    'attributes' => [
                        'onchange' => 'document.getElementById("photo").src = window.URL.createObjectURL(this.files[0])'
                ]
                ])
            </div>
        </div>
    </div>
    <div class="col-lg-2">
        <label for="photo">Фото профиля</label>
        <img src="{{isset($user) ? $user->getPhoto() : '/images/photos/default-photo.png'}}" id="photo" width="100%"
             height="auto" alt="photo"/>
    </div>
</div>
