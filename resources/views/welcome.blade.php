<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Менеджер задач</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="vsc-initialized">
        <div id='app'>
            <header class="fixed w-full">
                <nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900 shadow-md">
                    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                        <a href="/" class="flex items-center">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
                        </a>
                        <div class="flex items-center lg:order-2">
                            <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Вход</a>
                            <a href="/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">Регистрация</a>
                        </div>
                        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                                <li>
                                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">Задачи</a>
                                </li>
                                <li>
                                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">Статусы</a>
                                </li>
                                <li>
                                    <a href="#" class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">Метки</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">Привет от Хекслета!</h1>
                        <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Это простой менеджер задач на Laravel</p>
                        <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                            <a href="#" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" target="_blank"> Нажми меня </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
