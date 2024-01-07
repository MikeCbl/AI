<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('layouts.head')
    <body class="antialiased bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300">
        <header class="bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700 w-full">
            <div class="container mx-auto">
                @include('layouts.nav')
            </div>
        </header>

          {{-- <main class="container mx-auto p-4 w-full">
            <div class="flex flex-col items-center justify-center">

            </div>
          </main> --}}

          <section class="mt-12 sm:ml-60 relative flex items-center justify-center overflow-hidden min-h-120 flex-none" style="background-image: url('{{ asset('storage/img/web/cover.jpg') }}'); background-position: center center; background-size: cover;">
            <div class="w-full h-full absolute top-0 left-0 bg-black opacity-70"></div>
            <div class="container mx-auto px-6 z-10 py-12 lg:py-32 xl:py-40">
                <div class="text-center text-white">
                    <h2 class="text-3xl lg:text-7xl leading-tight mb-4">Nowa Deba Sport Shooting</h2>
                    <p class="text-lg lg:text-2xl">Precision Shooters in Nowa Deba, 18 is the premier sport shooting business in the area. With a wide selection of firearms, ammunition, and shooting accessories, we provide a safe and enjoyable experience for all levels of shooters. Come join us for some precision shooting!</p>
                </div>
            </div>
        </section>

        <div class="p-4 sm:ml-64">
            <div class="p-4 mt-12 rounded-lg">

                {{-- <section id="font" class="relative flex items-center justify-center overflow-hidden min-h-120 flex-none" style="background-image: url(&quot;https://images.unsplash.com/photo-1518219870542-9cc78377f953?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3wyNjI5NjF8MHwxfHNlYXJjaHwyNHx8U3BvcnQlMjBTaG9vdGluZ3xlbnwwfHx8fDE2ODQzNTUzNTB8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080&quot;); background-position: center center; background-size: cover;">
                    <div class="w-full h-full absolute top-0 left-0 bg-black opacity-70"></div>
                    <div class="container mx-auto px-6 z-10 py-12 lg:py-32 xl:py-40">
                        <div class="text-center text-white">
                            <h2 class="text-3xl lg:text-7xl leading-tight mb-4">Nowa Deba Sport Shooting</h2>
                            <p class="text-lg lg:text-2xl">Precision Shooters in Nowa Deba, 18 is the premier sport shooting business in the area. With a wide selection of firearms, ammunition, and shooting accessories, we provide a safe and enjoyable experience for all levels of shooters. Come join us for some precision shooting!</p>
                        </div>
                    </div>
                </section> --}}
{{--
                <section class="p-4 sm:ml-64 h-screen" style="background-image: url('{{ asset('storage/img/web/cover.jpg') }}');  background-position: center center; background-size: cover;">

                </section> --}}

                <section class="bg-white dark:bg-gray-900">
                    <div class="container mx-auto py-8 lg:py-12 xl:py-16">
                        <div class="text-center text-black dark:text-white" id="font">
                            <h3 class="text-xl lg:text-3xl mb-4">Testimonials</h3>
                            <p class="text-lg lg:text-xl">Precision Shooters in Nowa Deba, 18 Poland is an amazing shooting range. The staff is extremely helpful, knowledgeable, and friendly. The range is clean and well-maintained. I highly recommend this place to anyone who is looking for a great shooting experience.</p>
                            <p class="text-lg lg:text-xl mt-2">- Alex P.</p>
                        </div>
                    </div>
                </section>

            </div>
        </div>


          <div id="page-block-0" class="relative">
         </div>
            @if(session('error'))
                <div class="alert alert-danger z-[-1]">
                    {{ session('error') }}
                </div>
            @endif
          @include('layouts.footer')
    </body>
</html>
