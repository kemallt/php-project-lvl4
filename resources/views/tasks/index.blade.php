<x-app-layout :userIsLoggedIn=$userIsLoggedIn>
    @include('components.flash-success', [
        'message' => session('task'),
    ])
    <div class="grid col-span-full">
        <h1 class="mb-5">@lang('main.app.tasks')</h1>
        @include('tasks.filters', [
            'task_status_id' => $task_status_id,
            'created_by_id' => $created_by_id,
            'assigned_to_id' => $assigned_to_id,
            'task_statuses' => $task_statuses,
            'users' => $users,
        ])
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>@lang('main.tasks.id')</th>
                    <th>@lang('main.tasks.status')</th>
                    <th>@lang('main.tasks.name')</th>
                    <th>@lang('main.tasks.author')</th>
                    <th>@lang('main.tasks.doer')</th>
                    <th>@lang('main.tasks.created_at')</th>
                    <th>
                        @if ($userIsLoggedIn)
                            @lang('main.tasks.actions')
                        @endif
                    </th>
                </tr>
            </thead>
            @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->status->name }}</td>
                    <td>
                        <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.show', $task->id) }}">
                            {{ $task->name }}
                    </td>
                    <td>{{ $task->created_by->name }}</td>
                    <td>{{ $task->assigned_to->name ?? '' }}</td>
                    <td>{{ $task->date }}</td>
                    <td>
                        @if ($userIsLoggedIn)
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task->id) }}">
                                @lang('main.tasks.edit')
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
