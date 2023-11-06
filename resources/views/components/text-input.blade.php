<!-- 
    Text input component used in create and edit HTML forms :
    - edited slightly to allow for old values for edit
-->

@props(['disabled' => false, 'field' => '', 'value' => ''])

@php
    $oldValue = old($field, $value);
@endphp

<input {{ $disabled ? 'disabled' : '' }} 
       {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
       value="{{ $oldValue }}">

       
<!-- this piece of code returns an error message -->
@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
