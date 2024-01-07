<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')
        <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">

                <div class="grid grid-cols-1 gap-4 mb-4">


                    <div class="overflow-x-auto">
                        <div class="grid grid-cols-1 tm:grid-cols-2 gap-6">
                            <div class="bg-white dark:bg-gray-700 shadow-md rounded-lg p-6">
                                {{-- <form action="/users/{{ $user->id }}/edit" method="GET"> --}}
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <div class="py-4">
                      <h3 class="text-2xl font-bold">General information</h3>
                      <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-4">
                          <div>
                            <label for="name" class="block font-medium">First Name</label>
                            <input type="text" name="name" id="name" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="name" value="{{ $user->name }}"  required minlength="2" maxlength="50"  title="Name should contain only letters (A-Z, a-z)">
                          </div>
                                @if ($errors->has('name'))
                                <div class="input-error">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                          <div>
                            <label for="last_name" class="block font-medium">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="last name" value="{{ $user->last_name }}" required minlength="2" maxlength="100"  title="Last Name should contain only letters (A-Z, a-z)">
                          </div>
                          @if ($errors->has('last_name'))
                          <div class="input-error">
                              {{ $errors->first('last_name') }}
                          </div>
                          @endif
                          <div>
                            <label for="birth_place" class="block font-medium">Birth Place</label>
                            <input type="text" name="birth_place" id="birth_place" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="name" value="{{ $user->birth_place }}"  required max="{{ date('Y-m-d') }}">
                          </div>
                          <div>
                            <label for="birth_date" class="block font-medium">Birthday</label>
                            <input type="date" name="birth_date" id="birth_date" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950"  value="{{ $user->birth_date }}" required pattern="\d{2}-\d{2}-\d{4}">
                          </div>
                          <div>
                            <label for="email" class="block font-medium">Email</label>
                            <input type="email" name="email" id="email" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="example@company.com" value="{{ $user->email }}" required>
                          </div>
                          <div>
                            <label for="phone" class="block font-medium">Phone Number</label>
                            <input type="number" name="phone" id="phone" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="e.g. 743456789" value="{{ $user->phone }}" required pattern="[0-9]{9}" title="Phone number should be 9 digits long">
                          </div>

                          <div>
                            <label for="pesel" class="block font-medium">Pesel</label>
                            <input type="text" name="pesel" id="pesel" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="pesel" value="{{ $user->pesel }}" required minlength="11" maxlength="11">
                          </div>
                          <div>
                            <label for="residential_address" class="block font-medium">Residential Address</label>
                            <input type="text" name="residential_address" id="residential_address" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950" placeholder="residential_address" value="{{ $user->residential_address }}" required minlength="2" maxlength="255">
                          </div>
                          <div class="mx-2 mt-4">
                            <label for="gender" class="label">Gender</label>
                            <div class="flex mt-2">
                                <label for="male" class="inline-flex items-center mr-4">
                                    <input type="radio" id="male" name="gender" value="M" class="radio" {{ $user->gender == 'M' ? 'checked' : '' }}>
                                    <span class="ml-2">Male</span>
                                </label>
                                <label for="female" class="inline-flex items-center">
                                    <input type="radio" id="female" name="gender" value="F" class="radio" {{ $user->gender == 'F' ? 'checked' : '' }}>
                                    <span class="ml-2">Female</span>
                                </label>
                            </div>
                            <!-- Add error -->
                        </div>

                          <div>
                            <label for="role_id" class="block font-semibold text-gray-900 dark:text-white">Role:</label>
                            <div class="flex items-center">
                                <select name="role_id" id="role_id" class="w-full px-4 py-2 mt-1 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-slate-950">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}" {{ $user->role_id == $role->role_id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-blue-500 focus:border-blue-500">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
        </main>
      @include('layouts.footer')
   </body>
</html>
