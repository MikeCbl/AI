<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
   <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">

    @include('layouts.nav')
    <main class="p-4 sm:ml-64">
        <div class="p-4 mt-12  rounded-lg dark:border-gray-700">

           <div class="flex items-center justify-center h-auto  mb-4 rounded bg-gray-50 dark:bg-gray-800">
            <form action="{{ route('login') }}" method="POST" class="m-4 flex flex-wrap">
                @csrf

                   <div class="w-full">
                      <label for="email" class="label">E-mail</label>
                      <input type="email" id="email" class="input" name="email" value="{{ old('email') }}" />
                      @error('email')
                        <div class="input-error">{{ $message }}</div>
                      @enderror
                   </div>
                   <div class="w-full mt-4">
                      <label for="password" class="label">Password</label>
                      <input type="password" id="password" class="input" name="password" />
                      @error('password')
                        <div class="input-error">{{ $message }}</div>
                      @enderror
                   </div>
                   <div class="w-full mt-8">
                      <button class="btn-primary w-full" type="submit">Login</button>
                   </div>

             </form>
           </div>

        </div>
    </main>
      @include('layouts.footer')
   </body>
</html>
