<div class="form-group {{ $errors->has($name) ? ' has-danger ' : '' }}">
    <div class="custom-file {{$class ?? ''}}">
        @include('forms._file',[
    'name' => $name,
    'attributes' => [
        'onchange' => 'document.getElementById("'.$name.'").src = window.URL.createObjectURL(this.files[0])'
]
])
    </div>
    <video style="margin-top: 1.5vw" width="100%" height="auto" id="{{$name}}" controls="controls"/>
    @if($errors->has($name) === true)
        <div class="invalid-feedback">{{ $errors->first($name) }}</div>
    @endif
</div>
