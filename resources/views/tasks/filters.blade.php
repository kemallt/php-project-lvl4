@props(['task_status_id', 'created_by_id', 'assigned_to_id'])

<div class="w-full flex items-center">
    <div>
        <form method="GET" action="/tasks" accept-charset="UTF-8">
            <div class="flex">
                <div>
                    <select class="rounded border-gray-300" name="filter[status_id]">
                        <option selected="selected" value="Статус">Статус</option>
                        @foreach ($task_statuses as $task_status)
                            <option value="{{ $task_status->id }}">{{ $task_status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select class="ml-2 rounded border-gray-300" name="filter[created_by_id]">
                        <option selected="selected" value="Автор">Автор</option>
                        <@foreach ($users as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                    </select>
                </div>
                <div>
                    <select class="ml-2 rounded border-gray-300" name="filter[assignet_ty_id]">
                        <option selected="selected" value="Исполнитель">Исполнитель</option>
                        @foreach ($users as $doer)
                            <option value="{{ $doer->id }}">{{ $doer->name }}</option>
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
