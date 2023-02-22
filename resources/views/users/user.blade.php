@vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
    .cont:hover .imagee {
        opacity: 0.3;
    }

    .cont:hover .middle {
        opacity: 1;
    }
</style>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3 grid grid-cols-6">
            <div class="col-span-6">
                <div class="flex flex-row p-2 ">
                    <div class="w-full flex flex-row">
                        <img class="h-24 w-24 rounded-full object-cover border-4 border-purple-600"
                             src="{{asset('storage/' . $toShow['profile_photo'])}}">

                        <a href="{{route('usuario', ['user_name' => $toShow['user_name']])}}" class="ml-4 self-center h-fit font-weight-bolder text-lg">
                            <span>{{$toShow['full_name']}}</span><br>
                            <span class="text-slate-500 text-sm">{{'@' . $toShow['user_name']}}</span>
                        </a>
                    </div>
                    <div class="w-1/2 self-center font-weight-bolder flex flex-col">
                        <div class="flex flex-row">
                            <a href="{{ route('ver_amixes', [ 'user' => $toShow['user_id']]) }}" class="flex flex-col
                                text-center w-1/2">
                                <p class="text-2xl">{{ $toShow['friends'] }}</p>
                                <p class="text-sm">Amigos</p>
                            </a>
                            <div class="flex flex-col text-center w-1/2">
                                <p class="text-2xl">{{ $toShow['numOfImages'] }}</p>
                                <p class="text-sm">Publicaciones</p>
                            </div>
                        </div>

                        {{-- add friend button --}}
                        @if(! $isOwner)
                            @if ($toShow['userAndAuthAreFriends'])
                                <button data-token="{{csrf_token()}}" data-userid="{{$toShow['user_id']}}" id="friendButton"
                                        class="mt-2 border-4 rounded-lg border-purple-600 bg-purple-200 text-purple-700 -mb-4
                                w-3/4 mx-auto"><i class="bi bi-person-dash-fill"></i> Dejar de seguir</button>

                            @elseif($toShow['friendRequestPending'])
                                <button class="mt-2 border-4 rounded-lg border-purple-600 bg-purple-200 text-purple-700
                                -mb-4 w-1/2 mx-auto"><i class="bi bi-person-check-fill"></i> Pendiente</button>
                            @else
                                <button data-token="{{csrf_token()}}" data-userid="{{$toShow['user_id']}}" id="friendButton"
                                        class="mt-2 border-4 rounded-lg border-purple-600 bg-purple-200 text-purple-700 -mb-4
                                w-1/2 mx-auto"><i class="bi bi-person-plus-fill"></i> Seguir</button>
                            @endif

                            @vite('resources/js/friendship.js')
                        @endif

                    </div>
                </div>
                <hr class="border-purple-600 border-2 my-1">
            </div>
            @if(count($toShow) < 1)
                <div class="grid grid-cols-1 place-content-center">
                    <div><h1>NO HAY</h1></div>
                </div>
            @else
                @foreach($toShow['images'] as $image)
                    <div class="p-0.5 col-span-3">
                        <a href="{{ route('detalle_imagen', ['id' => $image['imageId']]) }}">
                            <div class="cont relative w-full h-full aspect-square overflow-hidden outline outline-3 outline-purple-600 outline-offset-[-3px]">
                                <img class="imagee" src="{{asset('storage/images/' . $image['imgPath'])}}">
                                <div class="middle opacity-0 absolute top-2/4 left-2/4 text-center -translate-y-1/2 -translate-x-1/2 ease-in duration-300">
                                    <div class="text-2xl text-purple-600">
                                        <i class="bi bi-chat-right-dots mr-2"></i><span>{{$image['comments']}}</span>
                                        <i class="bi bi-heart"></i><span class="ml-0.5">{{$image['likes']}}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
