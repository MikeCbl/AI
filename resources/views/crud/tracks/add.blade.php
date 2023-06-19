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
                                {{-- <img src="{{ asset('storage/' . $track->img) }}" alt="Track Image" class="w-full h-full object-cover select-none trackImage"> --}}
                                    <div id="imagePreview" class="w-full h-full bg-cover bg-center bg-no-repeat"></div>
                            </div>
                            <!-- Information and Price (Right Side) -->
                            <div class="tm:w-1/2 px-4 py-6 bg-gray-100 dark:bg-gray-800">
                                <form action="{{ route('tracks.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @safeSubmit
                                    {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
                                    {{-- <input name="_redirect" type="hidden" value="http://localhost:8000/tracks"> --}}

                                    {{-- @method('POST') --}}
                                    <div class="mt-4">

                                        <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image:</label>
                                        <input type="file" name="img" id="image" aria-describedby="file_input_help" onchange="displayImagePreview(event)" class="block w-full text-sm file-btn text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                        <p class="my-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX 4MB).</p>

                                    </div>
                                    <div>
                                        <label for="name" class="block font-semibold text-gray-900 dark:text-white">Name:</label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="input dark:text-black">
                                    </div>
                                    <div class="mt-4">
                                        <label for="description" class="block font-semibold text-gray-900 dark:text-white">Description:</label>
                                        <textarea id="description" name="description" class="input dark:text-black" value="{{ old('description') }}"></textarea>
                                    </div>
                                    <div class="mt-4">
                                        <label for="price_per_hour" class="block font-semibold text-gray-900 dark:text-white">Price per Hour:</label>
                                        <input type="number" id="price_per_hour" name="price_per_hour" value="{{ old('price_per_hour') }}" class="input dark:text-black">
                                    </div>
                                    <div class="mt-4">
                                        <label for="is_available" class="block font-semibold text-gray-900 dark:text-white">Availability:</label>
                                        <div class="flex items-center">
                                            <input type="hidden" name="is_available" value="1">
                                            <button type="button" id="availabilityToggle" class="available inline-block px-3 py-2 text-xs font-semibold rounded select-none" onclick="toggleAvailability()">
                                                <span id="availabilityText">Available</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-6">
                                        <button type="submit" class="btn-primary text-white font-semibold py-2 px-4 rounded">Add Track</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Session::has('success'))
                    <div class="bg-green-400 text-white text-center p-4 my-4 border-2 border-green-500 rounded-lg">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-400 text-white text-center p-4 my-4 border-2 border-red-500 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

        </main>
        <script>
            function toggleAvailability() {
                const availabilityToggle = document.getElementById('availabilityToggle');
                const availabilityText = document.getElementById('availabilityText');
                const availabilityInput = document.querySelector('input[name="is_available"]');

                if (availabilityInput.value === '1') {
                    availabilityText.textContent = 'Unavailable';
                    availabilityToggle.classList.remove('available');
                    availabilityToggle.classList.add('not-available');
                    availabilityInput.value = '0';
                } else {
                    availabilityText.textContent = 'Available';
                    availabilityToggle.classList.remove('not-available');
                    availabilityToggle.classList.add('available');
                    availabilityInput.value = '1';
                }
            }

            function displayImagePreview(event) {
                var input = event.target;
                var preview = document.getElementById('imagePreview');


                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        preview.style.backgroundImage = 'url(' + e.target.result + ')';
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.style.backgroundImage = 'none';
                }
            }

        </script>






        @include('layouts.footer')
    </body>
</html>
