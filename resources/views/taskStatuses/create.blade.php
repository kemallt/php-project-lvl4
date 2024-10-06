<x-app-layout :userIsLoggedIn=$userIsLoggedIn>
    @include('components.flash-error', [
        'message' => session('error'),
    ])
    <div class="grid col-span-full">
        <h1 class="mb-5">@lang('main.statuses.create_status')</h1>
        <form method="POST" action="/task_statuses" accept-charset="UTF-8" class="w-50">
            @csrf
            <div class="flex flex-col">
                <div>
                    <label for="name">@lang('main.statuses.name')</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name"
                        value="{{ old('name') }}">
                </div>
                @include('components.inputs-error', [
                    'messages' => $errors->all(),
                ])
                <div class="mt-2">
                    <input class="bg-blue-500 hove:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"
                        value="@lang('main.statuses.create')">
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
