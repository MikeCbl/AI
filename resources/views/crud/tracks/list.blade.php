<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')

        <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 dark:border-gray-700">
                <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">

                    <a href="{{ route("tracks.create") }}" class="btn-primary">Add new +</a>
                </div>

                <div class="grid grid-cols-1 gap-8">

                    @foreach ($tracks as $track)
                    <div class="border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg overflow-hidden">
                        <div class="tm:flex">
                            <!-- Image (Left Side) -->
                            <div class="tm:w-1/2">
                                <img src="{{ asset('storage/' . $track->img) }}" alt="Track Image" class="w-full h-full object-cover select-none trackImage">
                            </div>
                            <!-- Information and Price (Right Side) -->
                            <div class="tm:w-1/2 px-4 py-6 bg-gray-100 dark:bg-gray-800">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $track->name }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $track->description }}</p>
                                {{-- <p class="mb-3 font-semibold text-gray-900 dark:text-neutral-100">{{ $track->price_per_hour }} zł per hour</p> --}}
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
                                <div class="flex justify-end">
                                    <form action="{{ route('tracks.delete', ['id' => $track->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger text-white font-semibold py-2 px-4 rounded select-none mr-2">Delete</button>
                                    </form>
                                    <a href="{{ route('tracks.edit', ['id' => $track->id]) }}" class="btn-primary text-white font-semibold py-2 px-4 rounded select-none">Edit</a>
                                </div>
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
