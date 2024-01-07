<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')

    <main class="p-4 sm:ml-64">
        <div class="grid grid-cols-1 gap-8">
            <div class="border border-gray-200 dark:border-gray-700 shadow-lg rounded-lg overflow-hidden">
                <div class="tm:flex">
                    <!-- Image (Left Side) -->
                    <div class="tm:w-1/2">
                        <div id="imagePreview" class="w-full h-full bg-center bg-no-repeat"></div>
                        {{-- <img src="{{ asset('storage/' . $user->image) }}" alt="User Image" class="w-full h-full object-cover select-none trackImage"> --}}
                    </div>
                    <!-- Information and Form (Right Side) -->
                    <div class="tm:w-1/2 px-4 py-6 bg-gray-100 dark:bg-gray-800">
                        <form action="{{ route('users.updateProfile', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mt-4">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload Image:</label>
                                <input type="file" name="image" id="image" aria-describedby="file_input_help" onchange="displayImagePreview(event)" accept="image/*" class="block w-full text-sm file-btn text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <p class="my-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX 4MB).</p>
                            </div>
                            <div>
                                <label for="name" class="block font-semibold text-gray-900 dark:text-white">Name:</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="input dark:text-black" required pattern="^[\s\p{L}]+$"minlength="2" maxlength="50"  title="Name should contain only letters (A-Z, a-z)">
                            </div>
                            <div class="mt-4">
                                <label for="last_name" class="block font-semibold text-gray-900 dark:text-white">Last Name:</label>
                                <input type="text" id="last_name" name="last_name" value="{{ $user->last_name }}" class="input dark:text-black" required pattern="^[\s\p{L}]+$" minlength="2" maxlength="100"  title="Last Name should contain only letters (A-Z, a-z)">
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
                                <input type="date" id="birth_date" name="birth_date" value="{{ $user->birth_date }}" class="input dark:text-black" required max="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mt-4">
                                <label for="birth_place" class="block font-semibold text-gray-900 dark:text-white">Birth Place:</label>
                                <input type="text" id="birth_place" name="birth_place" value="{{ $user->birth_place }}" class="input dark:text-black" required pattern="^[\s\p{L}]+$" minlength="2" maxlength="255"  title="Birth Place should contain only letters (A-Z, a-z)">
                            </div>
                            <div class="mt-4">
                                <label for="email" class="block font-semibold text-gray-900 dark:text-white">Email:</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}" class="input dark:text-black" required>
                            </div>
                            <div class="mt-4">
                                <label for="phone" class="block font-semibold text-gray-900 dark:text-white">Phone:</label>
                                <input type="text" id="phone" name="phone" value="{{ $user->phone }}" class="input dark:text-black" required pattern="[0-9]{9}" title="Phone number should be 9 digits long">
                            </div>
                            <div class="mt-4">
                                <label for="residential_address" class="block font-semibold text-gray-900 dark:text-white">Residential Address:</label>
                                <input type="text" id="residential_address" name="residential_address" value="{{ $user->residential_address }}" class="input dark:text-black" required minlength="2" maxlength="255">
                            </div>
                            <div class="mt-4">
                                <label for="pesel" class="block font-semibold text-gray-900 dark:text-white">PESEL:</label>
                                <input type="text" id="pesel" name="pesel" value="{{ $user->pesel }}" class="input dark:text-black" required minlength="11" maxlength="11">
                            </div>
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
