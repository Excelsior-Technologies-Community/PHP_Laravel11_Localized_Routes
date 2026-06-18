<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Localized</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
        
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    <div class="max-w-7xl mx-auto p-6">
        
        <header class="flex justify-between items-center py-6 border-b border-gray-200 dark:border-gray-800">
            <div class="text-2xl font-bold flex items-center gap-2">
                <i class="fas fa-globe text-indigo-600"></i> Laravel App
            </div>
            <div class="flex gap-4">
                <select onchange="window.location.href=this.value" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md p-2 outline-none">
                    <option value="{{ localizedRoute('home', [], 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>🇺🇸 English</option>
                    <option value="{{ localizedRoute('home', [], 'fr') }}" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>🇫🇷 French</option>
                    <option value="{{ localizedRoute('home', [], 'nl') }}" {{ app()->getLocale() == 'nl' ? 'selected' : '' }}>🇳🇱 Dutch</option>
                </select>
                <button onclick="document.documentElement.classList.toggle('dark'); localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light'" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md transition">
                    <i class="fas fa-adjust"></i>
                </button>
            </div>
        </header>

        <main class="mt-10">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700">
                <h1 class="text-4xl font-bold mb-4 text-indigo-600 dark:text-indigo-400">
                    <i class="fas fa-hand-sparkles"></i> {{ __('messages.welcome') }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300 text-lg">{{ __('messages.description') }}</p>
                
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ localizedRoute('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="{{ localizedRoute('about') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-info-circle"></i> About
                    </a>
                    <a href="{{ route('translations.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg flex items-center gap-2 transition">
                        <i class="fas fa-cog"></i> Admin Panel
                    </a>
                </div>
            </div>
        </main>

        <footer class="mt-20 text-center text-gray-500 dark:text-gray-500 text-sm">
            <i class="fas fa-code"></i> Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>
</html>