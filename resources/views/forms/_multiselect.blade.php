<?php

?>

<select class="dropdown-primary md-form selectize {{$class ?? ''}}" name="{{$name}}" multiple searchable="Search here..">
    <option disabled>{{$text ?? ''}}</option>
    @forelse($selected ??[] as $key=> $object)
        <option class="selectize-dropdown-content" value="{{$key}}" selected>
            {{$object}}</option>
    @empty
    @endforelse

    @forelse($list as $key=> $object)
        <option class="selectize-dropdown-content" value="{{$key}}" >
            {{$object}}</option>
    @empty
    @endforelse
</select>

