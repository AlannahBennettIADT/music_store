@props(['albums', 'field' => '','selected' => null])

<select {{ $attributes->merge(['class' => 'form-select']) }}>
    @foreach ($albums as $album)
        <option value="{{ $album->id }}" {{ $selected == $album->id ? 'selected' : '' }}>
            {{ $album->name }}
        </option>
    @endforeach
</select>

@error($field)
<div class="text-red-600 text-sm">{{ $message }}</div>
@enderror