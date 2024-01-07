<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
    @include('layouts.nav')



    <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12 dark:border-gray-700">
          <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <h2 class="text-2xl font-semibold">Edit Reservation</h2>
          </div>

          <div class="grid grid-cols-1 gap-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
              <form action="{{ route('reservations.update', ['id' => $reservation->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="p-4">
                  <div class="relative">
                    <img src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image" class="w-full h-48 object-cover select-none trackImage">
                    <p class="absolute top-4 left-4 text-lg font-semibold text-white">{{ $reservation->track->name }}</p>
                  </div>

                  <div class="p-4">
                    <label for="user_id" class="block mb-2 font-semibold">User:</label>
                    <div class="relative inline-block w-full">
                      <div id="selected-option" class="relative flex items-center bg-white border rounded-md px-4 py-2 cursor-pointer">
                        <img src="{{ asset('storage/' . $reservation->user->image) }}" alt="User Image" class="w-6 h-6 rounded-full mr-2">
                        <span class="text-gray-800">{{ $reservation->user->name }} {{ $reservation->user->last_name }}</span>
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M7.293 7.293a1 1 0 0 0 0 1.414L9.586 11l-2.293 2.293a1 1 0 1 0 1.414 1.414l3-3a1 1 0 0 0 0-1.414l-3-3a1 1 0 0 0-1.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <ul id="options" class="absolute left-0 w-full mt-2 py-2 bg-white border rounded-md shadow-md hidden">
                        @foreach ($users as $user)
                          <li data-user-id="{{ $user->id }}" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="w-6 h-6 rounded-full mr-2">
                            <span class="text-gray-800">{{ $user->name }} {{ $user->last_name }}</span>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{ $reservation->user_id }}" required>
                  </div>

                  <div class="p-4">
                    <label for="track_id" class="block mb-2 font-semibold">Track:</label>
                    <div class="relative inline-block w-full">
                      <div id="track-selected-option" class="relative flex items-center bg-white border rounded-md px-4 py-2 cursor-pointer">
                        <img src="{{ asset('storage/' . $reservation->track->img) }}" alt="Track Image" class="w-6 h-6 rounded-full mr-2">
                        <span class="text-gray-800">{{ $reservation->track->name }}</span>
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M7.293 7.293a1 1 0 0 0 0 1.414L9.586 11l-2.293 2.293a1 1 0 1 0 1.414 1.414l3-3a1 1 0 0 0 0-1.414l-3-3a1 1 0 0 0-1.414 0z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      <ul id="track-options" class="absolute left-0 w-full mt-2 py-2 bg-white border rounded-md shadow-md hidden">
                        @foreach ($tracks as $track)
                          <li data-track-id="{{ $track->id }}" class="flex items-center px-4 py-2 cursor-pointer hover:bg-gray-100">
                            <img src="{{ asset('storage/' . $track->img) }}" alt="Track Image" class="w-6 h-6 rounded-full mr-2">
                            <span class="text-gray-800">{{ $track->name }}</span>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                    <input type="hidden" name="track_id" id="track_id" value="{{ $reservation->track_id }}" required>
                  </div>

                  <div class="mb-4">
                    <label for="start_time" class="block mb-2 font-semibold">Start Time:</label>
                    <input type="time" name="start_time" id="start_time" class="w-full p-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 text-gray-800" value="{{ old('start_time', $reservation->start_time) }}" required>
                    @error('start_time')
                      <p class="text-red-500">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="end_time" class="block mb-2 font-semibold">End Time:</label>
                    <input type="time" name="end_time" id="end_time" class="w-full p-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 text-gray-800" value="{{ old('end_time', $reservation->end_time) }}" required>
                    @error('end_time')
                      <p class="text-red-500">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="reservation_date" class="block mb-2 font-semibold">Date:</label>
                    <input type="date" name="reservation_date" id="reservation_date" class="w-full p-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 text-gray-800" value="{{ old('reservation_date', $reservation->reservation_date) }}" required>
                    @error('reservation_date')
                      <p class="text-red-500">{{ $message }}</p>
                    @enderror
                  </div>

                  <div class="mb-4">
                    <label for="price" class="block mb-2 font-semibold">Price:</label>
                    <input type="text" name="price" id="price" class="w-full p-2 border-gray-300 rounded focus:outline-none focus:border-blue-500 text-gray-800" value="{{ old('price', $reservation->price) }}" required min="1">
                    @error('price')
                      <p class="text-red-500">{{ $message }}</p>
                    @enderror
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

                  <div class="flex justify-between mt-6">
                    <button type="submit" class="btn-primary text-white font-semibold py-2 px-4 rounded select-none">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>


      <script>
        const selectedOptionTrack = document.getElementById('track-selected-option');
        const trackOptions = document.querySelectorAll('#track-options li');
        const hiddenInputTrack = document.getElementById('track_id');

        selectedOptionTrack.addEventListener('click', () => {
            document.getElementById('track-options').classList.toggle('hidden');
        });

        trackOptions.forEach((trackOption) => {
            trackOption.addEventListener('click', () => {
                const trackId = trackOption.getAttribute('data-track-id');
                const imageSrc = trackOption.querySelector('img').src;
                const name = trackOption.querySelector('span').innerText;

                selectedOptionTrack.querySelector('img').src = imageSrc;
                selectedOptionTrack.querySelector('span').innerText = name;
                hiddenInputTrack.value = trackId;

                document.getElementById('track-options').classList.add('hidden');
            });
        });

        document.addEventListener('click', (event) => {
            if (!selectedOptionTrack.contains(event.target) && !document.getElementById('track-options').contains(event.target)) {
                document.getElementById('track-options').classList.add('hidden');
            }
        });

        const selectedOption = document.getElementById('selected-option');
        const options = document.querySelectorAll('#options li');
        const hiddenInput = document.getElementById('user_id');

        selectedOption.addEventListener('click', () => {
          document.getElementById('options').classList.toggle('hidden');
        });

        options.forEach((option) => {
          option.addEventListener('click', () => {
            const userId = option.getAttribute('data-user-id');
            const imageSrc = option.querySelector('img').src;
            const name = option.querySelector('span').innerText;

            selectedOption.querySelector('img').src = imageSrc;
            selectedOption.querySelector('span').innerText = name;
            hiddenInput.value = userId;

            document.getElementById('options').classList.add('hidden');
          });
        });

        document.addEventListener('click', (event) => {
          if (!selectedOption.contains(event.target) && !document.getElementById('options').contains(event.target)) {
            document.getElementById('options').classList.add('hidden');
          }
        });
      </script>
    @include('layouts.footer')
</body>

</html>
