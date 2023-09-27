@props(['message'])

@if ($message)
    <div class="bg-red-500 border-t-4 rounded-b text-white px-4 py-3 shadow-md" role="alert">
        {{ $message }}
    </div>
@endif
{{-- <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2"> --}}
