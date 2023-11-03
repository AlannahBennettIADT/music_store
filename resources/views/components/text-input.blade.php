@props(['disabled' => false, 'field' => '', 'value' => ''])

@php
    $oldValue = old($field, $value);
@endphp

<input {{ $disabled ? 'disabled' : '' }} 
       {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}
       value="{{ $oldValue }}">

@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
