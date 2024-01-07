<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
        <header class="bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700 w-full">
            <div class="container mx-auto">
                @include('layouts.nav')
            </div>
          </header>



    <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12">
            <div class="flex-col items-center justify-center h-auto mb-4 rounded bg-gray-50 dark:bg-gray-800">
                <div id="calendar" class="py-4 mx-auto dark:bg-gray-800 dark:text-gray-300 w-3/4"></div>
            </div>
        </div>
    </main>


        @vite('resources/js/reservations.js')
        @include('layouts.footer')
    </body>
</html>

