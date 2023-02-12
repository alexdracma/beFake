@vite('resources/css/coolHr.css')
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="{{asset('/logo.svg')}}" class="block h-28 w-auto">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="identity" value="{{ __('Correo o nombre de usuario') }}" />
                <x-jet-input id="identity" class="block mt-1 w-full" type="text" name="identity" :value="old('identity')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recuerdame') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center flex-col mt-4">

                <x-jet-button class="bg-purple-600">
                    {{ __('Iniciar sesión') }}
                </x-jet-button>

                @if (Route::has('password.request'))
                    <a class="underline mt-4 text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('¿Has olvidado la contraseña?') }}
                    </a>
                @endif

            </div>
        </form>
        <hr class="my-6 hr-text" data-content="¿No tienes cuenta en BeFake.?">
        <div class="flex items-center justify-center flex-col">
            <x-jet-button class="ml-4 bg-purple-600">
                <a href="{{route('registro')}}">{{ __('Crear cuenta') }}</a>
            </x-jet-button>
        </div>

    </x-jet-authentication-card>
</x-guest-layout>
