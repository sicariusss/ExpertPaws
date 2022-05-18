<div class="form-group {{ $errors->has($name) ? ' has-danger ' : '' }}">
    <div class="row">
        <div class="col-auto">
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
        </div>
        <div class="col-5">
            <img class="mt-4" id="{{$name}}" width="100%" height="auto"/>
            @if($errors->has($name) === true)
                <div class="invalid-feedback mt-5">{{ $errors->first($name) }}</div>
            @endif
        </div>
    </div>
</div>
