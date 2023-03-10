@vite(['resources/css/app.css', 'resources/js/app.js'])
<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3" id="main">

            {{-- Search --}}
            <form method="POST" action="{{ route('buscar') }}" class="mb-2 m-auto w-fit">
                @csrf
                <input required type="search" class="border-4 rounded-lg bg-purple-200 border-purple-600" placeholder="Busca por nombre..." name="query">
                <input type="submit" class="px-4 py-3 rounded-lg bg-purple-600 text-purple-200" value="Buscar">
            </form>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg bg-purple-200 border-4 border-purple-600">
            @foreach($toShow as $usuario)
                <div class="flex flex-row p-5">
                    <a href="{{route('usuario', ['user_name' => $usuario['user_name']])}}">
                        <img class="h-14 w-14 rounded-full object-cover border-4 border-purple-600"
                            src="{{asset('storage/' . $usuario['profile_photo'])}}">
                    </a>
                    <a href="{{route('usuario', ['user_name' => $usuario['user_name']])}}" class="ml-4 self-center h-fit font-weight-bolder text-lg">
                        <span>{{$usuario['full_name']}}</span><br>
                        <span class="text-slate-500 text-sm">{{'@' . $usuario['user_name']}}</span>
                    </a>
                </div>
                <hr class="border-purple-600">
            @endforeach
            </div>
            <div class="mt-3 flex justify-center">
                <div class="border-4 rounded-lg border-purple-600">
                    @include('partials.pagination', ['paginator' => $paginator, 'elements' => $elements, 'showText' => false])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
