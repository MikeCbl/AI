<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
     @include('layouts.nav')
     <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12 dark:border-gray-700">


            <div class="grid grid-cols-1 gap-8">

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

                        </div>
                    </div>
                </div>

            </div>
            <div id="legend"></div>
            <div id="calendar"></div>
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="py-8">
                    <h2 class="text-2xl font-bold mb-4">Make a Reservation</h2>
                    <form action="{{ route('reservation.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="track_id" value="{{ $track->id }}">

                        <div class="mb-4">
                            <label for="reservation_date" class="block font-medium text-gray-700 dark:text-white">Date:</label>
                            <input type="date" id="reservation_date" name="reservation_date" class="input mt-1 block w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block font-medium text-gray-700 dark:text-white">Start Time:</label>
                            <input type="time" id="start_time" name="start_time" class="input mt-1 block w-full" required>
                        </div>


                        <div class="mb-4">
                            <label for="end_time" class="block font-medium text-gray-700 dark:text-white">End Time:</label>
                            <input type="time" id="end_time" name="end_time" class="input mt-1 block w-full" required>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="btn-primary inline-block px-4 py-2 text-sm font-medium ">Reserve</button>
                        </div>
                    </form>

                </div>
                @if (Session::has('success'))
                    <div class="bg-green-400 text-white text-center p-4 mb-4 border-2 border-green-500 rounded-lg">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="bg-red-400 text-white text-center p-4 mb-4 border-2 border-red-500 rounded-lg">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>

        </div>
    </main>
    @include('layouts.footer')
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
      <script src="{{ asset('js/fullcalendar.min.js') }}"></script>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const calendarEl = document.getElementById("calendar");
          const reservationDateInput = document.getElementById("reservation_date");
          const startTimeInput = document.getElementById("start_time");
          const endTimeInput = document.getElementById("end_time");
          const reserveButton = document.getElementById("reserveButton");
          const isTrackAvailable = "{{ $track->is_available }}";

          const calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            selectable: true,
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            select: function (info) {
              const startDate = moment(info.start).format('YYYY-MM-DD');
              const startTime = moment(info.start).format('HH:mm');
              const endTime = moment(info.end).format('HH:mm');

              reservationDateInput.value = startDate;
              startTimeInput.value = startTime;
              endTimeInput.value = endTime;

              // Enable/disable the reserve button based on track availability
              reserveButton.disabled = (isTrackAvailable === "0");
            }
          });

          calendar.render();
        });
      </script>
   </body>
</html>
{{-- https://realtimecolors.com/?colors=140100-fff5f5-6f6e52-72795e-312afe --}}


