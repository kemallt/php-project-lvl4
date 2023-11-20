@props(['task_status_id', 'created_by_id', 'assigned_to_id'])

<div class="w-full flex items-center">
    <div>
        <form method="GET" action="/tasks" accept-charset="UTF-8">
            <div class="flex">
                <div>
                    <select class="rounded border-gray-300" name="filter[status_id]">
                        <option {{ $task_status_id == null ? "selected" : "" }} value={{ null }}>Статус</option>
                        @foreach ($task_statuses as $task_status)
                            <option value="{{ $task_status->id }}" {{ $task_status_id == $task_status->id  ? "selected" : "" }}>{{ $task_status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="ml-2 rounded border-gray-300" name="filter[created_by_id]">
                        <option {{ $created_by_id == null ? "selected" : "" }} value={{ null }}>Автор</option>
                        <@foreach ($users as $author)
                            <option value="{{ $author->id }}" {{ $created_by_id == $author->id ? "selected" : "" }}>{{ $author->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div>
                    <select class="ml-2 rounded border-gray-300" name="filter[assigned_to_id]">
                        <option {{ $assigned_to_id == null ? "selected" : "" }} value={{ null }}>Исполнитель</option>
                        @foreach ($users as $doer)
                            <option value="{{ $doer->id }}" {{ $assigned_to_id == $doer->id ? "selected" : ""}}>{{ $doer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"
                        type="submit" value="Применить">
                </div>
            </div>
        </form>
    </div>
    <div class="ml-auto">
        @can('create', App\Models\Task::class)
            <a href="{{ route('tasks.create') }}"
                class="bg-blue-500 hove:bg-blue-700 text-white font-bold py-2 px-4 rounded">@lang('main.tasks.create')</a>
        @endcan
    </div>
</div>
