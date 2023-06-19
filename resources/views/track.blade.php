<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">


    @include('layouts.nav')

    <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12 dark:border-gray-700">

            <div class="grid grid-cols-1 gap-8">
                @if(!auth()->check())
                <div class="px-4 py-6 bg-gray-100 dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Interested in reserving a shooting track? Please don't hesitate to reach out to us by clicking <a href="{{Route('contact')}}" class="dark:text-slate-200 dark:hover:text-white hover:text-indigo-700 text-indigo-500">here</a>.
                        Our team will be more than happy to assist you!
                    </p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Planning to shoot with us frequently? <br/> Take advantage of our registration process and enjoy exclusive benefits, including online reservations and a 10% discount. Click <a href="{{Route('register.create')}}" class="dark:text-slate-200 dark:hover:text-white hover:text-indigo-700 text-indigo-500">here</a> to register now!
                    </p>

                </div>
                @endif

                @foreach ($tracks as $track)
                <div class="border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg overflow-hidden">
                    <div class="tm:flex">
                        <!-- Image (Left Side) -->
                        <div class="tm:w-1/2">
                            <img src="{{ asset('storage/' . $track->img) }}" alt="Track Image" class="w-full h-full object-cover select-none">
                        </div>
                        <!-- Information and Price (Right Side) -->
                        <div class="tm:w-1/2 px-4 py-6 bg-gray-100 dark:bg-gray-800">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $track->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $track->description }}</p>
                            {{-- <p class="mb-3 font-semibold text-gray-900 dark:text-neutral-100">{{ $track->price_per_hour }} PLN per hour</p> --}}
                            <p class="mb-3 font-semibold text-gray-900 dark:text-neutral-100 flex items-center">
                                <span class="text-xl font-bold text-green-500 dark:text-green-400">{{ $track->price_per_hour }} PLN</span>
                                <span class="ml-2">per hour</span>
                            </p>

                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores dignissimos nulla quos nesciunt ipsa quas earum eligendi minus laudantium voluptatibus, dolore, accusantium praesentium corporis illum placeat perferendis non alias quod?</p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                @if($track->is_available)
                                    <span class="inline-block px-3 py-2 text-xs font-semibold text-green-800 bg-green-100 rounded select-none">Available</span>
                                @else
                                    <span class="inline-block px-3 py-2 text-xs font-semibold text-red-800 bg-red-100 rounded select-none">Currently not available</span>
                                @endif
                            </p>
                            {{-- {{ route('reservation.create', $track->id) }} --}}
                            @if(auth()->check())
                             <a href="{{ route('reservation', $track->id) }}" class="inline-block px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-500 rounded-md hover:bg-blue-600">Reserve</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </main>
    @include('layouts.footer')

</body>
</html>
