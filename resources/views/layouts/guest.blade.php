<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex  sm:justify-center items-center pt-6 sm:pt-0 bg-purple-400">
            {{--  <div class="w-full md:w-1/2">
                <div class="w-full  h-64 md:h-screen flex items-center justify-center">
                    <img src="{{asset('img/page.jpeg')}}" alt="Image d'illustration" class="w-full h-full object-cover">
                </div>
            </div>  --}}
         
                <div>
                    <a href="/">
                        {{--  <x-application-logo class="w-20 h-20 fill-current text-gray-500" />  --}}
                    </a>
                </div>
    
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
              
        </div>
    </body>
</html>
