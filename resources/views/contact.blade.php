<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
    <header class="bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700 w-full">
        <div class="container mx-auto">
        </div>
    </header>

    @include('layouts.nav')

    <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12 dark:border-gray-700">
            <div class="flex items-center justify-center h-48 mb-4 rounded">
                <h2 class="text-xl lg:text-3xl mb-4 text-gray-400 dark:text-white">Contact</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 xl:mx-20">

                @foreach ($users as $user)
                <div class="flex items-center justify-center h-auto rounded bg-gray-50 dark:bg-gray-800">
                    <div class="max-w-2xl mx-auto p-6">
                        <h1 class="text-2xl font-bold mb-4">
                            @if ($user->role_id == 1)
                                Chairman
                            @elseif ($user->role_id == 2)
                                Staff member
                            @endif
                        </h1>
                            <address>
                                <strong>Name:</strong>  {{ $user->name }} {{ $user->last_name }} <br>
                                <strong>Phone:</strong><a href="tel:{{ $user->phone }}"> {{ $user->phone }}</a><br>
                                <strong>Email:</strong><a href="mailto:{{ $user->email }}"> {{ $user->email }} </a><br>
                            </address>
                        <hr>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="flex items-center justify-center h-auto my-8 rounded">
                <h3 class="text-2xl lg:text-3xl text-gray-400 dark:text-white">Where to find us?</h3>
            </div>
            <div class="flex items-center justify-center h-auto mb-4">

               <div id="map" class="map "></div>
           </div>
        </div>
    </main>


        @include('layouts.footer')

    <script type="text/javascript">
        function initMap() {
          const myLatLng = { lat: 50.592444, lng: 21.714208 };
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: myLatLng,
          });

          new google.maps.Marker({
            position: myLatLng,
            map,
          });
        }

        window.initMap = initMap;
    </script>

    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" ></script>

</body>
</html>
