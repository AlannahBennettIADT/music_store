<!-- 
    file input component used for song cover upload :

    props is a blade directive defining the data passed through ( field value etc) 
-->

<div>

<input type="{{ $type }}" name="{{ $name }}" class="{{ $class }}" placeholder="{{ $placeholder }}" {{ $attributes }}>




<!-- this piece of code returns an error message -->
@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
</div>

