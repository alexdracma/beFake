<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Página de Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($toShow as $image)
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-purple-200 border-x-4 border-t-4 border-purple-600">
                <div class="flex flex-row p-5">
                    <img class="h-14 w-14 rounded-full object-cover border-4 border-purple-600"
                         src="{{asset('storage/' . $image['profilePhoto'])}}">
                    <span class="ml-4 self-center h-fit font-weight-bolder text-lg">{{$image['username']}}</span>
                    <span class="ml-auto self-center h-fit">{{$image['uploadDateToNow']}}</span>
                </div>
                <div class="border-y-4 border-purple-600">
                    <img src="{{asset('images/' . $image['imgPath'])}}" class="w-100">
                </div>
                <div class="p-5">
                    <p><span class="font-bold">{{$image['username']}}:</span> {{$image['description']}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
