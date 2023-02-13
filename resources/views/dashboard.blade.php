
<x-app-layout>
    <div class="py-12">
        @foreach($toShow as $image)
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-purple-200 border-4 border-purple-600">
                <div class="flex flex-row p-5">
                    <img class="h-14 w-14 rounded-full object-cover border-4 border-purple-600"
                         src="{{asset('storage/' . $image['profilePhoto'])}}">
                    <span class="ml-4 self-center h-fit font-weight-bolder text-lg">{{$image['username']}}</span>
                    <span class="ml-auto self-center h-fit">{{$image['uploadDateToNow']}}</span>
                </div>
                <div class="border-y-4 border-purple-600">
                    <img src="{{asset('storage/images/' . $image['imgPath'])}}" class="w-100">
                </div>
                <div class="p-5 grid grid-cols-12">
                    <div class="col-span-9">
                        <p class="break-all"><span class="font-bold">{{$image['username']}}:</span> {{$image['description']}}</p>
                        @if($image['comments'] === 0)
                            <span class="text-xs text-purple-600">Sin comentarios</span>
                        @elseif($image['comments'] === 1)
                            <a href="{{ route('detalle_imagen', ['id' => $image['imageId']]) }}" class="text-xs text-purple-600">Ver el comentario</a>
                        @else
                            <a href="{{ route('detalle_imagen', ['id' => $image['imageId']]) }}" class="text-xs text-purple-600">Ver los comentarios</a>
                        @endif

                    </div>
                    <div class="col-span-3 text-right text-purple-600 text-2xl">
                        <button class="comment mr-2" id="{{$image['imgPath']}}"><i class="bi bi-chat-right-dots mr-2"></i><span>{{$image['comments']}}</span></button>
                        <i class="bi
                        @if($image['userLiked'])
                            bi-heart-fill
                        @else
                            bi-heart
                        @endif
                        cursor-pointer text-purple-600"
                        data-token="{{csrf_token()}}" data-imgId="{{$image['imageId']}}"></i>
                        <span class="ml-0.5 like">{{$image['likes']}}</span>
                    </div>
                </div>

                <form action="{{ route('comentar', ['id' => $image['imageId']]) }}" method="post" class="px-5 pb-5 hidden">
                    @csrf
                    <label for="chat" class="sr-only">Your message</label>
                    <div class="flex items-center px-3 py-2 rounded-lg bg-purple-50">
                        <textarea name="comment" style="resize: none" maxlength="255" id="chat" rows="2" class="block mr-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Escribe tu comentario..."></textarea>
                        <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-purple-100">
                            <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="#9333ea" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            <span class="sr-only">Send message</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        @endforeach
        @vite(['resources/js/comment.js', 'resources/js/detailImage.js'])
    </div>
</x-app-layout>
