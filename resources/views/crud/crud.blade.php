<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')
<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300 min-h-screen">

        @include('layouts.nav')
        <main class="flex-grow p-4 sm:ml-64 ">
            <div class="p-4 mt-12 border-gray-200 rounded-lg dark:border-gray-700 ">
               <div class="grid grid-cols-2 gap-4 mb-4">
                    <a href="{{ route('tracks.list') }}" class="h-56 flex items-center justify-center rounded bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 aspect-w-1 aspect-h-1 md:aspect-w-2 md:aspect-h-1">
                        <div class="flex items-center justify-center">
                            <p class="text-2xl text-gray-400 dark:text-gray-500">Tracks</p>
                        </div>
                    </a>
                    <a href="{{ route('users.list') }}" class="h-56 flex items-center justify-center rounded bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 aspect-w-1 aspect-h-1 md:aspect-w-2 md:aspect-h-1">
                        <div class="flex items-center justify-center">
                            <p class="text-2xl text-gray-400 dark:text-gray-500">Users</p>
                        </div>
                    </a>
                    <a href="{{ route('reservations.list') }}" class="h-56 flex items-center justify-center rounded bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 aspect-w-1 aspect-h-1 md:aspect-w-2 md:aspect-h-1">
                        <div class="flex items-center justify-center">
                            <p class="text-2xl text-gray-400 dark:text-gray-500">Reservations</p>
                        </div>
                    </a>
               </div>
            </div>
        </main>

        <script>
            console.log(window.screen.height);
            console.log(window.screen.width);
        </script>
        @include('layouts.footer')
    </body>
</html>
