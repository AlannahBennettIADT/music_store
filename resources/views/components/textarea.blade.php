<!-- 
    Text area component used for description :

    props is a blade directive defining the data passed through ( field value etc) 
-->
<div>
@props(['disabled' => false, 'field' => '', 'value' => ''])

<textarea {{ $disabled ? 'disabled' : '' }} 
          {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    {{ $value }}
</textarea>

<!-- this piece of code returns an error message -->
@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror

    </div>
