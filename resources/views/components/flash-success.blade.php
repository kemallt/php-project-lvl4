@props(['message'])

@if ($message)
    <div class="bg-teal-100 border-t-4 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
        {{ $message }}
    </div>
@endif
