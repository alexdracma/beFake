@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3" id="main">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-purple-200 border-4 border-purple-600">
            @foreach($toShow as $usuario)
                <div class="flex flex-row p-5">
                    <a href="{{route('usuario', ['user_name' => $usuario['user_name']])}}">
                        <img class="h-14 w-14 rounded-full object-cover border-4 border-purple-600"
                            src="{{asset('storage/' . $usuario['profile_photo'])}}">
                    </a>
                    <span class="ml-4 self-center h-fit font-weight-bolder text-lg">{{$usuario['user_name']}}</span>
{{--                    <span>{{$usuario['full_name']}}</span>--}}
                </div>
                <hr class="border-purple-600">
            @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
