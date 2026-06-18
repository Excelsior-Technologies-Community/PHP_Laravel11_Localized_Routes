<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translation Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = { darkMode: 'class' };
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 p-6 md:p-10 transition-colors duration-300">

<div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
            <i class="fas fa-language"></i> Translation Management
        </h1>
        <a href="/" class="text-sm bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            <i class="fas fa-arrow-left"></i> Back to Home
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-4 mb-6 rounded-xl border border-green-200 dark:border-green-800">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="mb-8 flex items-center gap-4 bg-gray-50 dark:bg-gray-900 p-4 rounded-xl border dark:border-gray-700">
        <label class="font-bold"><i class="fas fa-globe"></i> Select Language:</label>
        <div class="flex gap-3">
            @foreach(['en' => 'English', 'fr' => 'French', 'nl' => 'Dutch'] as $code => $name)
                <a href="{{ route('translations.index', $code) }}" 
                   class="px-4 py-1.5 rounded-lg transition {{ $lang == $code ? 'bg-indigo-600 text-white' : 'bg-white dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                   {{ $name }}
                </a>
            @endforeach
        </div>
    </div>

    <form action="{{ route('translations.update', $lang) }}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                        <th class="p-4 border-b dark:border-gray-600">Key</th>
                        <th class="p-4 border-b dark:border-gray-600">Translation ({{ strtoupper($lang) }})</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($translations as $key => $value)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="p-4 border-b dark:border-gray-600 font-mono text-sm text-indigo-500">{{ $key }}</td>
                        <td class="p-4 border-b dark:border-gray-600">
                            <input type="text" name="translations[{{ $key }}]" value="{{ $value }}" 
                                   class="w-full p-2 bg-transparent border dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 bg-gray-50 dark:bg-gray-900 p-6 rounded-xl border dark:border-gray-700">
            <h3 class="font-bold mb-4"><i class="fas fa-plus-circle"></i> Add New Translation Key</h3>
            <div class="flex flex-col md:flex-row gap-4">
                <input type="text" name="translations[new_key]" placeholder="Key (e.g. welcome_msg)" class="flex-1 p-3 border dark:border-gray-600 dark:bg-gray-800 rounded-lg">
                <input type="text" name="translations[new_value]" placeholder="Value" class="flex-1 p-3 border dark:border-gray-600 dark:bg-gray-800 rounded-lg">
            </div>
        </div>

        <button type="submit" class="mt-8 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition shadow-lg">
            <i class="fas fa-save"></i> Save All Changes
        </button>
    </form>
</div>

</body>
</html>