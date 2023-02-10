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
            @foreach($toShow as $image)
                <div class="p-0.5 col-span-3">
                    <a href="{{ route('detalle_imagen', ['id' => $image['imageId']]) }}">
                        <div class="cont relative w-full h-full aspect-square overflow-hidden outline outline-3 outline-purple-600 outline-offset-[-3px]">
                            <img class="imagee" src="{{asset('images/' . $image['imgPath'])}}">
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
        </div>
    </div>
</x-app-layout>
