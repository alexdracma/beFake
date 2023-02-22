@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3" id="main">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-purple-200 border-4 border-purple-600">
                @foreach($peticiones as $peticion)
                    <div class="flex flex-row p-5 ">
                        <a href="{{route('usuario', ['user_name' => $peticion['senderUserName']])}}">
                            <img class="h-14 w-14 rounded-full object-cover border-4 border-purple-600"
                                 src="{{asset('storage/' . $peticion['senderPfp'])}}">
                        </a>
                        <a href="{{route('usuario', ['user_name' => $peticion['senderUserName']])}}" class="ml-4
                            self-center h-fit font-weight-bolder text-lg">
                            <span>{{$peticion['senderName']}}</span><br>
                            <span class="text-slate-500 text-sm">{{'@' . $peticion['senderUserName']}}</span>
                        </a>

                        {{-- Accept / deny buttons --}}
                        <div data-token="{{ csrf_token() }}" data-userid="{{ $peticion['senderId'] }}"
                             class="ml-auto self-center">

                            <button class="border-4 font-bold rounded-lg border-purple-600 bg-purple-300
                                text-purple-900 px-4 py-1.5 accept">Aceptar</button>

                            <button class="border-4 font-bold rounded-lg border-purple-600 bg-purple-300
                                text-purple-900 px-4 py-1.5 deny">Denegar</button>

                        </div>

                    </div>
                    <hr class="border-purple-600">
                @endforeach
            </div>
        </div>
    </div>
    @vite('resources/js/friendRequest.js')
</x-app-layout>
