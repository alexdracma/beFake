@vite(['resources/js/app.js', 'resources/css/app.css'])
<div class="min-h-screen h-screen overflow-hidden flex items-center justify-center">
    <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
        <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
            <div class="relative">
                <div class="absolute">
                    <div class="">
                        <h1 class="my-2 text-gray-800 font-bold text-2xl">
                            {{$message}}
                        </h1>
                        <p class="mt-2 mb-6 text-gray-800">¡Lo sentimos! Porfavor visita la página de inicio para ir a donde necesitas.</p>
                        <a href="{{route('indice')}}" class="hover:underline bg-purple-600 text-white font-bold rounded
                            my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition
                            hover:scale-105 duration-300 ease-in-out">¡Llevame allí!</a>
                    </div>
                </div>
                <div>
                    <img src="https://i.ibb.co/G9DC8S0/404-2.png" />
                </div>
            </div>
        </div>
        <div>
            <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
        </div>
    </div>
</div>
