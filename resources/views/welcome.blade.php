<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <img src="https://laravel.com/img/logotype.light.svg" alt="Laravel Logo" class="w-32 h-32">
            </div>

            <div class="mt-16">
                <div class="grid max-w-xl grid-cols-1 gap-8 mx-auto sm:grid-cols-2 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col items-start gap-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Getting Started</h2>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Laravel has the most extensive and thorough documentation for all of its features, making it a breeze to get started.
                        </p>

                        <a href="https://laravel.com/docs" class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline">
                            Read the Docs &rarr;
                        </a>
                    </div>

                    <div class="flex flex-col items-start gap-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Laravel News</h2>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Laravel News is the official blog of Laravel, featuring the latest news, articles, and announcements.
                        </p>

                        <a href="https://laravel-news.com" class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline">
                            Visit Laravel News &rarr;
                        </a>
                    </div>

                    <div class="flex flex-col items-start gap-4">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Laracasts</h2>

                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Laracasts offers hundreds of video tutorials on Laravel, PHP, and modern web development.
                        </p>

                        <a href="https://laracasts.com" class="text-sm font-medium text-red-600 dark:text-red-400 hover:underline">
                            Start Watching &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
