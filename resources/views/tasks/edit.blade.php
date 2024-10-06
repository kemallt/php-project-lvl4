<x-app-layout :userIsLoggedIn=$userIsLoggedIn>
    @include('components.flash-error', [
        'message' => session('error'),
    ])
    <div class="grid col-span-full">
        <h1 class="mb-5">@lang('main.tasks.update_task')</h1>
        <form method="POST" action="{{ route('tasks.update', $task->id) }}" accept-charset="UTF-8" class="w-50">
            @csrf
            <input type="hidden" name="_method" id="_method" value="PATCH">
            <div class="flex flex-col">
                <div>
                    <label for="name">@lang('main.tasks.name')</label>
                </div>
                <div class="mt-2">
                    <input class="rounded border-gray-300 w-1/3" name="name" type="text" id="name"
                        value="{{ $task->name }}">
                </div>
                @if (array_key_exists('name', $errors->messages()))
                @include('components.input-error', [
                    'messages' => $errors->messages()['name'],
                ])
                @endif
                <div>
                    <label for="description">@lang('main.tasks.description')</label>
                </div>
                <div>
                    <textarea class="rounded border-gray-300 w-1/3" name="description" id="description">{{ $task->description }}</textarea>
                </div>
                <div class="mt-2">
                    <label for="status_id">@lang('main.tasks.status')</label>
                </div>
                <div>
                    <select class="rounded border-gray-300 w-1/3" name="status_id" id="status_id">
                    @foreach ($taskStatuses as $taskStatus)
                        <option
                            value="{{ $taskStatus->id }}"
                            {{ ($task->status_id === $taskStatus->id)? "selected" : "" }}
                        >{{ $taskStatus->name}}
                        </option>
                    @endforeach
                    </select>
                </div>
                @if (array_key_exists('status_id', $errors->messages()))
                @include('components.input-error', [
                    'messages' => $errors->messages()['status_id'],
                ])
                @endif
                <div class="mt-2">
                    <label for="assigned_to_id">@lang('main.tasks.assigned_to')</label>
                </div>
                <div>
                    <select class="rounded border-gray-300 w-1/3" name="assigned_to_id" id="assigned_to_id">
                    <option value="" {{ (empty($task->assigned_to_id)) ? "selected" : "" }} selected></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ ($task->assigned_to_id === $user->id) ? "selected" : "" }} >{{ $user->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="mt-2">
                    <label for="labels[]">@lang('main.tasks.tags')</label>
                </div>
                <div>
                    <select class="rounded border-gray-300 w-1/3 h-32" name="labels[]" id="labels[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                    </select>
                </div>
                {{-- @include('components.inputs-error', [
                    'messages' => $errors->all(),
                ]) --}}
                <div class="mt-2">
                    <input class="bg-blue-500 hove:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit"
                        value="@lang('main.tasks.update')">
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
