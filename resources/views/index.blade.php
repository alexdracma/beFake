{{--@auth--}}
{{--    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dash</a>--}}
{{--@else--}}
{{--    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Iniciar sesión</a>--}}

{{--@endauth--}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
<!--Replace with your tailwind.css once created-->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
<!-- Define your gradient here - use online tools to find a gradient matching your branding-->
<style>
    .gradient {
        background: linear-gradient(90deg, rgb(251 146 60) 0%, rgb(253 186 116) 100%);
    }
</style>
<div class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
<!--Nav-->
<nav id="header" class="fixed w-full z-30 top-0 text-white ">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('indice') }}">
                    <img src="{{asset('/logo.svg')}}" class="block h-14 w-auto">
                </a>
            </div>
        </div>
        <div class="w-full flex-grow flex items-center w-auto mt-2 mt-0 bg-white bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
            @auth
                <ul class="list-reset flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block text-white no-underline hover:text-purple-600 hover:text-underline py-2
                        px-4 font-bold" href="{{route('mis_publicaciones')}}">Perfil</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-white no-underline hover:text-purple-600 hover:text-underline py-2
                            px-4 font-bold" href="{{route('subir_imagen')}}">Subir imagen</a>
                    </li>
                </ul>
            @endauth

            <a href=" @auth {{ url('/dashboard') }} @else {{ route('login') }} @endauth " class=" ml-auto hover:underline bg-purple-600 text-white font-bold
                rounded my-6 py-2 px-4 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105
                duration-300 ease-in-out">
                @auth
                    Ir al panel
                @else
                    Iniciar sesión
                @endauth
            </a>
        </div>
    </div>
</nav>
<!--Hero-->
<div class="p-12 pt-32">
    <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <h1 class="my-4 text-5xl font-bold leading-tight">
                Tus amigos, de mentira.
            </h1>
            <p class="leading-normal text-2xl mb-8">
                Una forma nueva de olvidarte de como son tus amigos en su día a día
            </p>
            <a href="{{route('registro')}}" class="mx-auto lg:mx-0 hover:underline bg-purple-600 text-white font-bold
                rounded my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105
                duration-300 ease-in-out">
                Regístrate
            </a>
        </div>
        <!--Right Col-->
        <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-10/12 ml-auto z-50" src="{{asset('assets/images/fake.png')}}" />
        </div>
    </div>
</div>
<div class="relative -mt-12 lg:-mt-24">
    <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496" opacity="0.100000001"></path>
                <path
                    d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                    opacity="0.100000001"
                ></path>
                <path d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z" id="Path-4" opacity="0.200000003"></path>
            </g>
            <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                <path
                    d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
                ></path>
            </g>
        </g>
    </svg>
</div>
</div>
