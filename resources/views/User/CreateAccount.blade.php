
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.head')

<body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">


    @include('layouts.nav')


<main class="p-4 sm:ml-64">
    <div class="p-4 mt-12 ">
        <div class="grid grid-cols-1 gap-4 mb-4">
            <div class="overflow-x-auto">
                <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                    {{-- class="grid grid-cols-1 tm:grid-cols-2 gap-6"> --}}
                    <div class="grid grid-cols-1 tm:grid-cols-2 gap-6">
                        @csrf
                            <div class="mx-2 mt-4">
                                <label for="name" class="label">Name</label>
                                <input id="name" name="name" type="text" class="input" value="{{ old('name') }}" required/>
                                @if ($errors->has('name'))
                                <div class="input-error">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="last_name" class="label">Last Name</label>
                                <input id="last_name" name="last_name" type="text" class="input" value="{{ old('last_name') }}" required/>
                                @if ($errors->has('last_name'))
                                <div class="input-error">
                                    {{ $errors->first('last_name') }}
                                </div>
                                @endif
                            </div>

                            <div class="mx-2 mt-4">
                                <label for="birth_date" class="label">Birth Date</label>
                                <input id="birth_date" name="birth_date" type="date" class="input " value="{{ old('birth_date') }}" required/>
                                @if ($errors->has('birth_date'))
                                <div class="input-error">
                                    {{ $errors->first('birth_date') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="birth_place" class="label">Birth Place</label>
                                <input id="birth_place" name="birth_place" type="text" class="input" value="{{ old('birth_place') }}" required/>
                                @if ($errors->has('birth_place'))
                                <div class="input-error">
                                    {{ $errors->first('birth_place') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="email" class="label">Email</label>
                                <input id="email" name="email" type="email" class="input" value="{{ old('email') }}" required/>
                                @error('email')
                                    <div class="input-error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="phone" class="label">Phone</label>
                                <input id="phone" name="phone" type="text" class="input" value="{{ old('phone') }}" required/>
                                @if ($errors->has('phone'))
                                <div class="input-error">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="residential_address" class="label">Residential Address</label>
                                <input id="address" name="residential_address" type="text" class="input" value="{{ old('residential_address') }}" required/>
                                @if ($errors->has('residential_address'))
                                <div class="input-error">
                                    {{ $errors->first('residential_address') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="pesel" class="label">PESEL</label>
                                <input id="pesel" name="pesel" type="number" class="input" value="{{ old('pesel') }}" required/>
                                @if ($errors->has('pesel'))
                                    <div class="input-error">
                                        {{ $errors->first('pesel') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="password" class="label">Password</label>
                                <input id="password" name="password" type="password" class="input" required />
                                @if ($errors->has('password'))
                                <div class="input-error">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="password_confirmation" class="label">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="input" required/>
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="gender" class="label">Gender</label>
                                <div class="flex mt-2">
                                  <label for="male" class="inline-flex items-center mr-4">
                                    <input type="radio" id="male" name="gender" value="M" class="radio" required>
                                    <span class="ml-2">Male</span>
                                  </label>
                                  <label for="female" class="inline-flex items-center">
                                    <input type="radio" id="female" name="gender" value="F" class="radio" required>
                                    <span class="ml-2">Female</span>
                                  </label>
                                </div>
                                <!-- Add error -->
                            </div>
                            <div class="mx-2 mt-4">
                                <label for="image" class="label">Profile Picture</label>
                                <input id="image" name="image" type="file"  class="block w-full text-sm file-btn text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                <p class="my-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG (MAX 4MB).</p>
                                @if ($errors->has('image'))
                                    <div class="input-error">
                                        {{ $errors->first('image') }}
                                    </div>
                                @endif
                            </div>
                    </div>
                    {{-- accept="image/jpeg,image/png" --}}

                            <div class="mx-2 mt-6">
                                <button class="btn-primary w-full" type="submit">
                                    Create Account
                                </button>

                                <div class="mx-2 mt-2 text-center">
                                    <a href="{{ route('login') }}" class="text-sm text-gray-500">
                                        Already have an account? Click here
                                    </a>
                                </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
</main>
 @include('layouts.footer')
</body>
</html>
