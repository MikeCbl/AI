<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')

        <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 dark:border-gray-700">
                <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">

                    <a href="{{ route("reservations.create") }}" class="btn-primary">Add new +</a>
                </div>
{{--
                <div class="grid grid-cols-1 gap-8">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($upcomingReservations as $reservation)
                            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                                <form action="{{ route('reservations.delete', ['id' => $reservation->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                    @csrf
                                    @method('DELETE')
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image" class="w-full h-48 object-cover select-none trackImage">
                                        <p class="absolute top-4 left-4 text-lg font-semibold text-white">{{ $reservation->track->name }}</p>
                                    </div>
                                    <div class="p-4">
                                        <a href="{{ route('users.edit', ['id' => $reservation->user_id]) }}" class="inline-block">
                                            <img src="{{ asset('storage/' . $reservation->user->image) }}" alt="User Image" class="w-16 h-16 object-cover rounded-full select-none hover:cursor-pointer hover:opacity-50">
                                        </a>
                                        <p class="mt-2 text-base font-medium text-gray-900 dark:text-white">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</p>
                                        <div class="flex items-center mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-500 overflow-visible">
                                                <path d="M12 0c6.623 0 12 5.377 12 12s-5.377 12-12 12-12-5.377-12-12 5.377-12 12-12zm0 1c6.071 0 11 4.929 11 11s-4.929 11-11 11-11-4.929-11-11 4.929-11 11-11zm0 11h6v1h-7v-9h1v8" stroke="currentColor" style="font-weight: bold;"/>
                                            </svg>
                                            <p class="ml-2 text-sm text-gray-700 dark:text-gray-400">Time: {{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}</p>
                                        </div>
                                        <div class="flex items-center mt-2">
                                            <svg aria-hidden="true" class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 1664 1792" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M128 1664h288v-288H128v288zm352 0h320v-288H480v288zm-352-352h288V992H128v320zm352 0h320V992H480v320zM128 928h288V640H128v288zm736 736h320v-288H864v288zM480 928h320V640H480v288zm768 736h288v-288h-288v288zm-384-352h320V992H864v320zM512 448V160q0-13-9.5-22.5T480 128h-64q-13 0-22.5 9.5T384 160v288q0 13 9.5 22.5T416 480h64q13 0 22.5-9.5T512 448zm736 864h288V992h-288v320zM864 928h320V640H864v288zm384 0h288V640h-288v288zm32-480V160q0-13-9.5-22.5T1248 128h-64q-13 0-22.5 9.5T1152 160v288q0 13 9.5 22.5t22.5 9.5h64q13 0 22.5-9.5t9.5-22.5zm384-64v1280q0 52-38 90t-90 38H128q-52 0-90-38t-38-90V384q0-52 38-90t90-38h128v-96q0-66 47-113T416 0h64q66 0 113 47t47 113v96h384v-96q0-66 47-113t113-47h64q66 0 113 47t47 113v96h128q52 0 90 38t38 90z"/>
                                            </svg>
                                            <p class="ml-2 text-sm text-gray-700 dark:text-gray-400">Date: {{ $reservation->reservation_date }}</p>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-700 dark:text-gray-400">Duration: {{ $reservation->time() }}</p>
                                        <p class="mt-2 text-lg font-bold text-green-500 dark:text-green-400">{{ $reservation->price }} PLN</p>
                                        <div class="flex justify-between mt-4">
                                            <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="btn-primary text-white font-semibold py-2 px-4 rounded select-none">Edit</a>
                                            <button type="submit" class="px-4 py-2 text-sm font-medium text-red-500 bg-transparent border border-red-500 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="container mx-auto">
                    <h1 class="text-2xl font-bold mb-4">Current Reservations</h1>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-auto">
                            <thead>
                                <tr>
                                    <th class="py-2 text-left">User</th>
                                    <th class="py-2 text-left">Track</th>
                                    <th class="py-2 text-left">Date</th>
                                    <th class="py-2 text-left">Reservation</th>
                                    <th class="py-2 text-left">Amount</th>
                                    <th class="py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($upcomingReservations as $reservation)
                                    <tr>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <img src="{{ asset('storage/' . $reservation->user->image) }}" alt="User Image" class="w-10 h-10 object-cover rounded-full mr-2">
                                                <span class="truncate">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <img src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image" class="w-10 h-10 object-cover rounded-full mr-2">
                                                <span class="truncate">{{ $reservation->track->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto">
                                            <div>
                                                <p>{{ $reservation->reservation_date }}</p>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto">
                                            <p> {{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}</p>
                                        </td>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <p class="text-lg font-bold text-green-500 dark:text-green-400"> {{ $reservation->price }} PLN</p>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto ">
                                            <div class="flex flex-col sm:flex-row sm:space-x-2">
                                                <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="btn-primary text-white font-semibold py-2 px-4 rounded select-none">Edit</a>
                                                <form action="{{ route('reservations.delete', ['id' => $reservation->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-red-500 bg-transparent border border-red-500 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="container mx-auto">
                    <h1 class="text-2xl font-bold mb-4">Past Reservations</h1>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-auto">
                            <thead>
                                <tr>
                                    <th class="py-2 text-left">User</th>
                                    <th class="py-2 text-left">Track</th>
                                    <th class="py-2 text-left">Date</th>
                                    <th class="py-2 text-left">Reservation</th>
                                    <th class="py-2 text-left">Amount</th>
                                    <th class="py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pastReservations as $reservation)
                                    <tr>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <img src="{{ asset('storage/' . $reservation->user->image) }}" alt="User Image" class="w-10 h-10 object-cover rounded-full mr-2">
                                                <span class="truncate">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <img src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image" class="w-10 h-10 object-cover rounded-full mr-2">
                                                <span class="truncate">{{ $reservation->track->name }}</span>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto">
                                            <div>
                                                <p>{{ $reservation->reservation_date }}</p>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto">
                                            <p> {{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}</p>
                                        </td>
                                        <td class="py-2 w-1/6 sm:w-auto">
                                            <div class="flex items-center">
                                                <p class="text-lg font-bold text-green-500 dark:text-green-400"> {{ $reservation->price }} PLN</p>
                                            </div>
                                        </td>
                                        <td class="py-2 w-1/3 sm:w-auto ">
                                            <div class="flex flex-col sm:flex-row sm:space-x-2">
                                                <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="btn-primary text-white font-semibold py-2 px-4 rounded select-none">Edit</a>
                                                <form action="{{ route('reservations.delete', ['id' => $reservation->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-red-500 bg-transparent border border-red-500 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="flex items-center justify-between pb-4 bg-white dark:bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <form action="{{ route('reservations.list') }}" method="GET">
                <input type="text" name="query" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for reservations" value="{{ request('query') }}" autocomplete="off">
            </form>
        </div>

    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    User
                </th>
                <th scope="col" class="px-6 py-3">
                    Track
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Time
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    After discount
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                @if($reservation->reservation_date > $today->format('Y-m-d'))
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                @else
                <tr class="bg-red-700 border-b dark:bg-red-800 dark:border-gray-700 hover:bg-red-600 dark:hover:bg-gray-600">
                {{-- <tr class="bg-red-200 border-b dark:bg-gray-500 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"> --}}
                @endif
                    {{-- <tr class="bg-{{ $reservation->end_time <= $currentTime ? 'gray-100 dark:bg-gray-600' : 'white dark:bg-gray-800' }} border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"> --}}
                    <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $reservation->user->image) }}" alt="User Image">
                        <div class="pl-3">
                            <div class="text-base font-semibold">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</div>
                            <div class="font-normal text-gray-500">{{ $reservation->user->email }}</div>
                        </div>
                    </th>
                    <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image">
                            <div class="pl-3">
                                <div class="text-base font-semibold ">{{ $reservation->track->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{ $reservation->reservation_date }}
                            @if ($reservation->reservation_date < $today->format('Y-m-d'))
                                <span class="ml-2 text-red-500">Ended</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{ date('H:i', strtotime($reservation->start_time)) }} - {{ date('H:i', strtotime($reservation->end_time)) }}
                        </div>
                    </td>


                    <td class="py-2 w-1/6 sm:w-auto">
                        <div class="flex items-center">
                            <p class="text-lg font-bold text-gray-500 dark:text-gray-500">{{ $reservation->price }} PLN</p>
                        </div>
                    </td>
                    <td class="py-2 w-1/6 sm:w-auto">
                        <div class="flex items-center">
                            <p class="text-lg font-bold text-green-500 dark:text-green-400">{{ $reservation->discountedPrice }} PLN</p>
                            @if ($reservation->discountedPrice < $reservation->price)
                                <p class="text-sm text-red-500 dark:text-red-400">- {{ $reservation->price - $reservation->discountedPrice }} PLN</p>
                            @endif
                        </div>
                    </td>

                    {{-- <td class="py-2 w-1/6 sm:w-auto">
                        <div class="flex items-center">
                            <p class="text-lg font-bold text-green-500 dark:text-green-400">{{ $reservation->price }} PLN</p>
                            @if ($reservation->discountedPrice < $reservation->price)
                                <p class="text-sm text-red-500 dark:text-red-400">
                                    - {{ $reservation->price - $reservation->discountedPrice }} PLN
                                    ({{ number_format((($reservation->price - $reservation->discountedPrice) / $reservation->price) * 100, 0) }}%)
                                </p>
                            @endif
                        </div>
                    </td>
                    <td class="py-2 w-1/6 sm:w-auto">
                        <div class="flex items-center">
                            <p class="text-lg font-bold text-green-500 dark:text-green-400">{{ $reservation->discountedPrice }} PLN</p>
                        </div>
                    </td> --}}


                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('reservations.edit', ['id' => $reservation->id]) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('reservations.delete', ['id' => $reservation->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="px-4 py-3 flex items-center justify-between bg-white dark:bg-gray-900">
        <div>
            {{-- Previous Page Link --}}
            @if ($reservations->onFirstPage())
                <span class="text-gray-500 dark:text-gray-400">&laquo; Previous</span>
            @else
                <a href="{{ $reservations->previousPageUrl() }}" class="text-blue-600 dark:text-blue-500 hover:underline hover:text-blue-800">&laquo; Previous</a>
            @endif
        </div>

        {{-- Page Number Links --}}
        <div class="flex items-center space-x-2">
            @for ($page = 1; $page <= $reservations->lastPage(); $page++)
                @if ($page === $reservations->currentPage())
                    <span class="flex items-center justify-center w-8 h-8 bg-blue-600 text-white rounded-full">{{ $page }}</span>
                @else
                    <a href="{{ $reservations->url($page) }}" class="flex items-center justify-center w-8 h-8 bg-white text-blue-600 dark:text-blue-500 hover:bg-blue-600 hover:text-white rounded-full hover:no-underline">{{ $page }}</a>
                @endif
            @endfor
        </div>

        <div>
            {{-- Next Page Link --}}
            @if ($reservations->hasMorePages())
                <a href="{{ $reservations->nextPageUrl() }}" class="text-blue-600 dark:text-blue-500 hover:underline hover:text-blue-800">Next &raquo;</a>
            @else
                <span class="text-gray-500 dark:text-gray-400">Next &raquo;</span>
            @endif
        </div>
    </div>


            </div>
        </main>

      @include('layouts.footer')
   </body>
</html>
