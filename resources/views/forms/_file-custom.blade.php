<div class="form-group {{ $errors->has($name) ? ' has-danger ' : '' }}">
    <div class="custom-file {{$class ?? ''}}">
        @include('forms._file',[
    'name' => $name,
    'attributes' => [
        'label' => $label,
        'bages' => $bages ?? null,
        'onchange' => 'document.getElementById("'.$name.'").src = window.URL.createObjectURL(this.files[0])'
]
])
    </div>
    <img class="mt-4" id="{{$name}}" width="100%" height="auto"/>
    @if($errors->has($name) === true)
        <div class="invalid-feedback mt-5">{{ $errors->first($name) }}</div>
    @endif
</div>
