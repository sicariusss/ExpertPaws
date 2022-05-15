<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }
    $type = $type ?? 'text';

    /**
     * Конструкция для работы с именами массивов вида: example[first_item][last_item]
     */
    $nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
    $value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));
    $value = $value ?? $frdVal ?? old($name);
    $attributes = $attributes ?? array();
    $class = $class ?? null;
    if(isset($form)){
        $attributes['form'] = $form;
    }
}
?>

<div class="form-group {{ $groupClass ?? null }}" data-name-dot="{{ $nameDot }}">
    @if (isset($label))
        @if (isset($attributes['bages']))
            <label for="basic-url">{!! $label ?? null !!}
                <span class="position-absolute top-10 p-1 bg-danger border border-light rounded-circle"></span>
            </label>
        @else
        <label for="basic-url">{!! $label ?? null !!}&nbsp</label>
        @endif
    @endif

    <div class="input-group has-validation">
        @isset($prefix)
            <div class="input-group-append">
                <span class="input-group-text">{!! $prefix !!}</span>
            </div>
        @endisset

        {{ Form::input($type ?? 'text',$name,$value ?? null,[
   'class'=>'form-control '.($errors->has($nameDot) ? ' is-invalid ' : null).' '.$class,
   'id'=>$id ?? null,
   'style'=>$style ?? 'border: 1px solid #ffc60b; font-family: "Montserrat", sans-serif; font-size: 15px; color: white; font-weight: 500;',
   'onclick'=>$onclick ?? null,
   'onkeypress'=>$onkeypress ?? null,
   'required'=>$required ?? null,
   'placeholder'=>$placeholder ?? null,
   'disabled'=>$disabled ?? null,
   'step'=>$step ?? $attributes['step'] ?? null,
   'max'=>$max ?? $attributes['max']  ?? null,
   'min'=>$min ?? $attributes['min']  ?? null,

   ]+($attributes)) }}

        @isset($postfix)
            <div class="input-group-append">
                <span class="input-group-text">{!! $postfix !!}</span>
            </div>
        @endisset

        @if(true === $errors->has($nameDot))
            <div class="invalid-feedback">{{ $errors->first($nameDot) }}</div>
        @endif
    </div>

    @if (isset($text))
        <small class="form-text text-muted">{!! $text !!}@isset($textPostfix) <span class="text-postfix">{{ $textPostfix }}</span>@endisset</small>
    @endif


</div>



