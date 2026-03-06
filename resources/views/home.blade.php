<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.home') }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">

        <h1 class="text-3xl font-bold mb-6 text-blue-600">{{ __('messages.home') }}</h1>

        <a href="{{ route('about') }}" class="text-blue-500 hover:text-blue-700 underline mb-6 inline-block">
            {{ __('messages.about') }}
        </a>

        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-3">{{ __('messages.change_language') }}</h3>

            <div class="flex justify-center gap-3">
                <a href="{{ Route::localizedUrl('en') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">English</a>
                <a href="{{ Route::localizedUrl('fr') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Français</a>
                <a href="{{ Route::localizedUrl('nl') }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Nederlands</a>
            </div>
        </div>

    </div>

</body>

</html>