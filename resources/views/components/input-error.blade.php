@props(['message'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="text-red-600">{{ $message }}</div>
    @endforeach
@endif
@if ($message)
@endif
