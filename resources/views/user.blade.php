<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
        <header class="bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700 w-full">
            <div class="container mx-auto">
                @include('layouts.nav')
            </div>
          </header>




          <main class="p-4 sm:ml-64">
            <div class="p-4 mt-12 dark:border-gray-700">
                {{-- card --}}
                <div class="flex items-center justify-center h-auto mb-4">
                    <div class="max-w-sm bg-gray-100 rounded-lg overflow-hidden shadow-lg dark:shadow-white dark:shadow-md">
                        <div class="border-b px-4 pb-6">
                          <div class="text-center my-4">
                            {{-- <img
                              class="cursor-pointer h-32 w-32 rounded-full border-4 border-white mx-auto my-4 hover:opacity-50"
                              src="https://randomuser.me/api/portraits/women/21.jpg"
                              alt="User Image"
                            /> --}}
                            <img
                              class="cursor-pointer h-32 w-32 rounded-full border-4 border-white mx-auto my-4 hover:opacity-50"
                              src="{{ asset('storage/' . $user->image) }}"
                              alt="User Image"
                            />

                            <div class="py-2">
                              <h3 class="font-bold text-2xl mb-1">{{ $user->name }} {{ $user->last_name }}</h3>
                              <div class="inline-flex text-gray-700 items-center">
                                <svg
                                  class="h-5 w-5 text-gray-400 mr-1"
                                  fill="currentColor"
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 24 24"
                                  width="24"
                                  height="24"
                                >
                                  <path
                                    class=""
                                    d="M5.64 16.36a9 9 0 1 1 12.72 0l-5.65 5.66a1 1 0 0 1-1.42 0l-5.65-5.66zm11.31-1.41a7 7 0 1 0-9.9 0L12 19.9l4.95-4.95zM12 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"
                                  />
                                </svg>
                                {{ $user->residential_address }}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="px-4">
                          <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                            <dl class="sm:divide-y sm:divide-gray-200">
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Full name</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $user->name }} {{ $user->last_name }}</dd>
                              </div>
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{ $user->residential_address }}
                                </dd>
                              </div>
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Numer telefonu</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{ $user->phone }}
                                </dd>
                              </div>
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{ $user->email }}
                                </dd>
                              </div>
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Data dodania</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{ $user->admission_date }}
                                </dd>
                              </div>
                              <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Pesel</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                  {{ $user->pesel }}
                                </dd>
                              </div>
                            </dl>
                          </div>
                        </div>
                        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <div class="text-sm font-medium text-gray-500"></div>
                            <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="{{ route('users.editProfile', ['id' => $user->id]) }}" class="bg-blue-500 text-white rounded-md px-4 py-2">Edit Profile</a>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
        </main>


          @include('layouts.footer')
    </body>
</html>
