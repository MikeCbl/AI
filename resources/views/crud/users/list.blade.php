<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')
        <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
                <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">

                    <form action="{{ route('users.search') }}" method="GET" class="w-full mx-2">
                        <label for="query" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" name="query" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Wyszukiwanie klubowiczy" autocomplete="off" >
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                    </form>

                </div>
                <div class="grid grid-cols-1 gap-4 mb-4">


                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-1 tm:grid-cols-2 gap-6">
                            @forelse ($users as $user)
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6">
                                <form action="{{ route('users.delete', ['id' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <h2 class="text-2xl font-bold mb-4">
                                        <div class="flex items-center">
                                            <span class="mr-2">{{ $user->name }} {{ $user->last_name }}</span>
                                            @if ($user->role_id == 1)
                                                <span class="inline-block px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full select-none">{{ $user->role->name }}</span>
                                            @elseif ($user->role_id == 2)
                                                <span class="inline-block px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full select-none">{{ $user->role->name }}</span>
                                            @else
                                                <span class="inline-block px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full select-none">{{ $user->role->name }}</span>
                                            @endif
                                        </div>
                                    </h2>
                                    <button class="btn-danger text-white font-semibold py-2 px-4 rounded float-right select-none" type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                    </form>
                                    <a href="/users/{{ $user->id }}" class="btn-primary text-white font-semibold py-2 px-4 rounded float-right select-none">Edit</a>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                        <p><span class="font-bold">Gender:</span> {{ $user->gender }}</p>
                                        <p><span class="font-bold">Birth Date:</span> {{ $user->birth_date }}</p>
                                        <p><span class="font-bold">Birth Place:</span> {{ $user->birth_place }}</p>
                                        <p><span class="font-bold">Email:</span> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                                        <p><span class="font-bold">Phone:</span> <a href="tel:{{ $user->phone }}"> {{ $user->phone }}</a></p>
                                        </div>
                                        <div>
                                        <p><span class="font-bold">Residential Address:</span> {{ $user->residential_address }}</p>
                                        <p><span class="font-bold">PESEL:</span> {{ $user->pesel }}</p>


                                        </div>
                                    </div>
                                {{-- </form> --}}
                            </div>

                            @empty
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg col-span-2 p-6">
                                <h2 class="text-2xl font-bold mb-4 text-center">User Not Found.</h2>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </main>


      @include('layouts.footer')
   </body>
</html>
