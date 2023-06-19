<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')

        <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 dark:border-gray-700">

                <div class="overflow-x-auto">
                    <div class="py-4">
                        <h3 class="text-2xl font-bold">General information</h3>
                        <form action="{{ route('reservations.store') }}" method="POST" class="mt-4">
                            @csrf
                            @safeSubmit
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="user_id" class="block font-medium">User</label>
                                    <select name="user_id" id="user_id"
                                        class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950"
                                        required>
                                        <!-- Populate the select options with your available users -->
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="track_id" class="block font-medium">Track</label>
                                    <select id="track" name="track_id"
                                        class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950">
                                        <!-- Populate the select options with your available tracks -->
                                        @foreach ($tracks as $track)
                                        <option value="{{ $track->id }}">{{ $track->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="reservation_date" class="block font-medium">Reservation Date</label>
                                    <input type="date" name="reservation_date" id="reservation_date"
                                        class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950"
                                        required>
                                </div>
                                <div>
                                    <label for="start_time" class="block font-medium">Start Time</label>
                                    <input type="time" name="start_time" id="start_time"
                                        class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950"
                                        required>
                                </div>
                                <div>
                                    <label for="end_time" class="block font-medium">End Time</label>
                                    <input type="time" name="end_time" id="end_time"
                                        class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950"
                                        required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit"
                                    class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500">Create
                                    Reservation</button>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </main>

      @include('layouts.footer')
   </body>
</html>
