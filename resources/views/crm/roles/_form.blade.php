<?php
/**
 * @var \App\Models\Role $role
 */
?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
                    'label' => 'Название',
                    'required'=>'required',
                    'name' => 'name',
                    'type' => 'text',
                    'placeholder' => 'Введите название...',
                    'value' => isset($role) ? $role->getName() : ''
                ])
            </div>
            <div class="col-lg-6 pb-2">
                @include('forms._input', [
                    'label' => 'Отображаемое название',
                    'required'=>'required',
                    'name' => 'display_name',
                    'type' => 'text',
                    'placeholder' => 'Введите отображаемое название...',
                    'value' => isset($role) ? $role->getDisplayName() : ''
                ])
            </div>
        </div>
    </div>
</div>

