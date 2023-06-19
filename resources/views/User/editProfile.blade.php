<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')

    {{-- <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12 dark:border-gray-700">
            <div class="max-w-sm bg-gray-100 rounded-lg overflow-hidden shadow-lg dark:shadow-white dark:shadow-md">
                <div class="border-b px-4 pb-6">
                    <div class="text-center my-4">
                        <img class="cursor-pointer h-32 w-32 rounded-full border-4 border-white mx-auto my-4 hover:opacity-50" src="{{ asset('storage/' . $user->image) }}" alt="User Image" />

                        <div class="py-2">
                            <h3 class="font-bold text-2xl mb-1">{{ $user->name }} {{ $user->last_name }}</h3>
                            <div class="inline-flex text-gray-700 items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path class="" d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z" />
                                </svg>
                                {{ $user->residential_address }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4">
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <form method="POST" action="{{ route('users.updateProfile', ['id' => $user->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label for="name" class="text-sm font-medium text-gray-500">Full name</label>
                                <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-input">
                                    @error('name')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <label for="residential_address" class="text-sm font-medium text-gray-500">Address</label>
                                <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="residential_address" id="residential_address" value="{{ $user->residential_address }}" class="form-input">
                                    @error('residential_address')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Add more form fields for other attributes -->

                            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <div class="text-sm font-medium text-gray-500"></div>
                                <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main> --}}

    <main class="p-4 sm:ml-64">
        <div class="grid grid-cols-1 gap-8">
            <div class="border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg overflow-hidden">
                <div class="tm:flex">
                    <!-- Image (Left Side) -->
                    <div class="tm:w-1/2">
                        <div id="imagePreview" class="w-full h-full bg-cover bg-center bg-no-repeat"></div>
                        {{-- <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="w-full h-full object-cover select-none trackImage"> --}}
                    </div>
                    <!-- Information and Form (Right Side) -->
                    <div class="tm:w-1/2 px-4 py-6 bg-gray-100 dark:bg-gray-800">
                        <form action="{{ route('users.updateProfile', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mt-4">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image:</label>
                                <input type="file" name="image" id="image" aria-describedby="file_input_help" onchange="displayImagePreview(event)" class="block w-full text-sm file-btn text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="my-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX 4MB).</p>
                            </div>
                            <div>
                                <label for="name" class="block font-semibold text-gray-900 dark:text-white">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="last_name" class="block font-semibold text-gray-900 dark:text-white">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="gender" class="block font-semibold text-gray-900 dark:text-white">Gender:</label>
                                <select id="gender" name="gender" class="input dark:text-black">
                                    <option value="M" {{ $user->gender === 'M' ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ $user->gender === 'F' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="birth_date" class="block font-semibold text-gray-900 dark:text-white">Birth Date:</label>
                                <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="birth_place" class="block font-semibold text-gray-900 dark:text-white">Birth Place:</label>
                                <input type="text" id="birth_place" name="birth_place" value="{{ $user->birth_place }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="email" class="block font-semibold text-gray-900 dark:text-white">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="phone" class="block font-semibold text-gray-900 dark:text-white">Phone:</label>
                                <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="residential_address" class="block font-semibold text-gray-900 dark:text-white">Residential Address:</label>
                                <input type="text" id="residential_address" name="residential_address" value="{{ $user->residential_address }}" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="pesel" class="block font-semibold text-gray-900 dark:text-white">PESEL:</label>
                                <input type="text" id="pesel" name="pesel" value="{{ $user->pesel }}" class="input dark:text-black">
                            </div>
                            
                            {{-- <div class="mt-4">
                                <label for="password" class="block font-semibold text-gray-900 dark:text-white">New Password:</label>
                                <input type="password" id="password" name="password" class="input dark:text-black">
                            </div>
                            <div class="mt-4">
                                <label for="password_confirmation" class="block font-semibold text-gray-900 dark:text-white">Confirm New Password:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="input dark:text-black">
                            </div> --}}
                            <div class="mt-6">
                                <button type="submit" class="btn-primary text-white font-semibold py-2 px-4 rounded">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
        <script>
         function displayImagePreview(event) {
            var input = event.target;
            var preview = document.getElementById('imagePreview');
            var oldImage = '{{ asset('storage/' . $user->image) }}';

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.style.backgroundImage = 'url(' + e.target.result + ')';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.backgroundImage = 'url(' + oldImage + ')';
            }
        }

        // Set the initial background image
        window.addEventListener('DOMContentLoaded', function() {
            var preview = document.getElementById('imagePreview');
            var oldImage = '{{ asset('storage/' . $user->image) }}';
            preview.style.backgroundImage = 'url(' + oldImage + ')';
        });

        </script>

       @include('layouts.footer')
   </body>
</html>
