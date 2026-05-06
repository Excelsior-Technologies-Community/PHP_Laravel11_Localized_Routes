<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.home') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-lg w-96 text-center">

        <h1 class="text-3xl font-bold text-blue-600 mb-4">
            {{ __('messages.home') }}
        </h1>

        <a href="{{ route('about') }}" class="text-blue-500 underline">
            {{ __('messages.about') }}
        </a>

        <!-- CURRENT LANGUAGE -->
        <div class="mt-4 text-sm text-gray-600">
            Current Language:
            <b class="text-blue-600">{{ strtoupper(app()->getLocale()) }}</b>
        </div>

        <!-- LANGUAGE DROPDOWN -->
        <form method="GET" class="mt-6">

            <select name="lang"
                onchange="window.location.href=this.value"
                class="border p-2 rounded w-full">

                <option value="{{ Route::localizedUrl('en') }}?lang=en"
                    {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                    English
                </option>

                <option value="{{ Route::localizedUrl('fr') }}?lang=fr"
                    {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>
                    Français
                </option>

                <option value="{{ Route::localizedUrl('nl') }}?lang=nl"
                    {{ app()->getLocale() == 'nl' ? 'selected' : '' }}>
                    Nederlands
                </option>

            </select>

        </form>

    </div>

</body>
</html>