<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
            <a href="/" class="flex items-center">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">@lang('main.app.title')</span>
            </a>
            <div class="flex items-center lg:order-2">
                @if ($userIsLoggedIn)
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="/logout" onclick="event.preventDefault();this.closest('form').submit();"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                            @lang('auth.logout')
                        </a>
                    </form>
                @else
                    <a href="/login"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">@lang('auth.login')</a>
                    <a href="/register"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">@lang('auth.registration')</a>
                @endif
            </div>
            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">@lang('main.app.tasks')</a>
                    </li>
                    <li>
                        <a href="{{ route('task_statuses.index') }}"
                            class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">@lang('main.app.statuses')</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">@lang('main.app.labels')</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</nav>
