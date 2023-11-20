<x-app-layout :userIsLoggedIn=$userIsLoggedIn>
    @include('components.flash-success', [
        'message' => session('status'),
    ])
    <div class="grid col-span-full">
        <h1 class="mb-5">@lang('main.app.statuses')</h1>
        <div>
            @can('create', App\Models\TaskStatus::class)
                <a href="{{ route('task_statuses.create') }}"
                    class="bg-blue-500 hove:bg-blue-700 text-white font-bold py-2 px-4 rounded">Создать статус</a>
            @endcan
        </div>
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>@lang('main.statuses.id')</th>
                    <th>@lang('main.statuses.name')</th>
                    <th>@lang('main.statuses.created_at')</th>
                    <th>
                        @if ($userIsLoggedIn)
                            @lang('main.statuses.actions')
                        @endif
                    </th>
                </tr>
            </thead>
            @foreach ($taskStatuses as $taskStatus)
                <tr class="border-b border-dashed text-left">
                    <td>{{ $taskStatus->id }}</td>
                    <td>{{ $taskStatus->name }}</td>
                    <td>{{ $taskStatus->date }}</td>
                    <td>
                        @if ($userIsLoggedIn)
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900"
                                href="{{ route('task_statuses.destroy', $taskStatus->id) }}">
                                @lang('main.statuses.delete')
                            </a>
                            <a class="text-blue-600 hover:text-blue-900"
                                href="{{ route('task_statuses.edit', $taskStatus->id) }}">
                                @lang('main.statuses.edit')
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
