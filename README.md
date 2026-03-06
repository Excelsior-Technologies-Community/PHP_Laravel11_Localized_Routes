# PHP_Laravel11_Localized_Routes


## Project Description

PHP_Laravel11_Localized_Routes is a Laravel 11 web application demonstrating multi-language (localized) routing using the codezero/laravel-localized-routes package.

It allows users to switch between English, French, and Dutch dynamically, with URLs automatically reflecting the selected language (e.g., /fr/about or /nl/about). 

This project is useful for learning how to create multi-language websites in Laravel that follow best practices for localization and route management.


## Features

1. Localized Routes – Automatically prefixes URLs with /fr or /nl for French and Dutch, while English can remain unprefixed.

2. Language Switcher – Users can change the language from any page with dynamic route redirection.

3. Dynamic Translations – Uses resources/lang files for storing messages for multiple languages.

4. Professional UI – Modern and responsive design using Tailwind CSS.

5. Middleware Integration – SetLocale middleware automatically sets the correct language for each request.

6. Fallback & Redirects – Falls back to English if translation is missing, and automatically redirects users to their preferred locale if enabled.

7. Scalable Structure – Clean project structure following Laravel conventions; easy to extend to more pages or languages.



## Benefits

- Ideal for building multi-language websites quickly.

- Supports SEO-friendly URLs for different languages.

- Can be extended to any number of languages by adding new translation files.

- Demonstrates best practices for Laravel localization and routing.


## Technologies Used

1. PHP 8+ – Server-side language

2. Laravel 11 – PHP framework

3. Tailwind CSS – Modern CSS framework for styling

4. MySQL (Optional) – Database

5. CodeZero Localized Routes – Multi-language routing package



---



## Installation Steps


---


## STEP 1: Create Laravel 11 Project

### Open terminal / CMD and run:

```
composer create-project laravel/laravel PHP_Laravel11_Localized_Routes "11.*"

```

### Go inside project:

```
cd PHP_Laravel11_Localized_Routes

```

#### Explanation:

Installs a fresh Laravel 11 project and navigates into the project folder.



## STEP 2: Database Setup (Optional)

### Update database details:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel11_Localized_Routes
DB_USERNAME=root
DB_PASSWORD=

```

### Create database in MySQL / phpMyAdmin:

```
Database name: laravel11_Localized_Routes

```

### Then Run:

```
php artisan migrate

```


#### Explanation:

Connects Laravel with MySQL and creates required tables using migrations.





## STEP 3: Install Localized Routes Package

### Install the package:

```
composer require codezero/laravel-localized-routes

```

#### Explanation:

This package allows you to define routes in multiple languages easily.





## STEP 4: Publish Package Configuration

### Run command:

```
php artisan vendor:publish --tag=config

```

### This creates a new configuration file:

```
config/localized-routes.php

```

#### Explanation:

You can now customize supported locales, middleware, and redirection rules.





## STEP 5: Configure Supported Languages

### Open: config/localized-routes.php

#### Example configuration:

```
<?php

return [

    'supported_locales' => [
        'en', 'fr', 'nl'
    ],

    'fallback_locale' => 'en',

    'omitted_locale' => 'en',       // English appears without /en
    'redirect_to_localized_urls' => true, // Redirects users to /fr or /nl automatically

    'redirect_status_code' => 302,

    'detectors' => [
        \CodeZero\LocalizedRoutes\Middleware\Detectors\RouteActionDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\UrlDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\OmittedLocaleDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\UserDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\SessionDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\CookieDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\BrowserDetector::class,
        \CodeZero\LocalizedRoutes\Middleware\Detectors\AppDetector::class,
    ],

    'stores' => [
        \CodeZero\LocalizedRoutes\Middleware\Stores\SessionStore::class,
        \CodeZero\LocalizedRoutes\Middleware\Stores\CookieStore::class,
        \CodeZero\LocalizedRoutes\Middleware\Stores\AppStore::class,
    ],

];

```

#### Explanation:

This file defines which languages your site supports and how to detect/store the user’s preferred language.





## STEP 6: Register Middleware in Laravel 11

### Open: bootstrap/app.php

```
<?php

use Illuminate\Foundation\Application;
use CodeZero\LocalizedRoutes\Middleware\SetLocale;
use Illuminate\Foundation\Configuration\Exceptions;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function ($middleware) {
        $middleware->web(append: [
            SetLocale::class, // This must be applied
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

```

#### Explanation:

Middleware SetLocale ensures the app displays content in the selected language.





## STEP 7: Create Controller

### Run command:

```
php artisan make:controller PageController

```

### File Open: app/Http/Controllers/PageController.php

```
<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
}

```

#### Explanation:

Controller functions return the corresponding views for your pages.





## STEP 8: Define Localized Routes

### Open: routes/web.php

```
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::localized(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
});

```

#### Explanation:

Route::localized automatically adds /fr and /nl prefixes for localized routes.





## STEP 9: Create Views

### resources/views/home.blade.php

```
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

```


### resources/views/about.blade.php

```
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.about') }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center font-sans">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96 text-center">

        <h1 class="text-3xl font-bold mb-6 text-green-600">{{ __('messages.about') }}</h1>

        <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-700 underline mb-6 inline-block">
            {{ __('messages.home') }}
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

```

### resources/lang/en/messages.php

```
<?php

return [
    'home' => 'Home Page',
    'about' => 'About Page',
    'change_language' => 'Change Language',
    'english' => 'English',
    'french' => 'French',
    'dutch' => 'Dutch',
];

```

### resources/lang/fr/messages.php

```
<?php

return [
    'home' => 'Page d’accueil',
    'about' => 'À propos',
    'change_language' => 'Changer de langue',
    'english' => 'Anglais',
    'french' => 'Français',
    'dutch' => 'Néerlandais',
];

```


### resources/lang/nl/messages.php

```
<?php

return [
    'home' => 'Startpagina',
    'about' => 'Over',
    'change_language' => 'Verander taal',
    'english' => 'Engels',
    'french' => 'Frans',
    'dutch' => 'Nederlands',
];

```







## STEP 10: Test in Browser

### Run:

```
php artisan serve

```

### Open browser:

```
http://127.0.0.1:8000

```

#### Explanation:

Switch between languages using buttons; the messages should update automatically.





## Expected Output:


### English language:


<img width="1919" height="925" alt="Screenshot 2026-03-06 131810" src="https://github.com/user-attachments/assets/7c04ef05-a659-4f92-9207-68796cd14cdc" />





```
http://127.0.0.1:8000/about

```





<img width="1908" height="923" alt="Screenshot 2026-03-06 143247" src="https://github.com/user-attachments/assets/ceb513b9-0e18-4b58-b04f-9d4c1c01f74e" />


### French:


<img width="1919" height="921" alt="Screenshot 2026-03-06 131825" src="https://github.com/user-attachments/assets/d50f2d1e-4ac0-4b7e-aae4-2ba195a578b1" />





```
http://127.0.0.1:8000/fr/about

```


<img width="1919" height="938" alt="Screenshot 2026-03-06 131832" src="https://github.com/user-attachments/assets/c4c1261d-fc68-4fcb-b2ee-026da9ad4b58" />



### Dutch:


<img width="1918" height="911" alt="Screenshot 2026-03-06 131906" src="https://github.com/user-attachments/assets/df8464fe-ae18-4083-bb5a-aedddb027339" />





```
http://127.0.0.1:8000/nl/about

```


<img width="1919" height="931" alt="Screenshot 2026-03-06 131920" src="https://github.com/user-attachments/assets/d31ddd42-2213-4352-bc78-36c2b41a6ea1" />


---

# Project Folder Structure:

```
PHP_Laravel11_Localized_Routes/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PageController.php           <-- Your controller
│   │   └── Middleware/
│   └── Models/
├── bootstrap/
│   └── app.php                               <-- Middleware registered here
├── config/
│   └── localized-routes.php                  <-- Localized routes config
├── database/
│   ├── migrations/                           <-- Laravel migrations
│   └── seeders/
├── public/
│   ├── index.php                             <-- Entry point
│   └── ...
├── resources/
│   ├── lang/
│   │   ├── en/
│   │   │   └── messages.php                  <-- English messages
│   │   ├── fr/
│   │   │   └── messages.php                  <-- French messages
│   │   └── nl/
│   │       └── messages.php                  <-- Dutch messages
│   └── views/
│       ├── home.blade.php                     <-- Home view
│       └── about.blade.php                    <-- About view
├── routes/
│   ├── web.php                                <-- Localized routes
│   └── console.php
├── storage/
│   └── ...                                    <-- Cache, logs, etc.
├── vendor/
│   └── codezero/laravel-localized-routes     <-- Composer package
├── .env                                      <-- DB and environment config
├── composer.json
├── composer.lock
└── artisan                                   <-- Artisan CLI
```
