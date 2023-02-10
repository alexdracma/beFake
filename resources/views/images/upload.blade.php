@vite(['resources/js/uploadImage.js', 'resources/js/app.js', 'resources/css/app.css'])
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<x-app-layout>
    <div class="py-12">
        <form action="{{ route('guardar_imagen') }}" class="max-w-2xl mx-auto sm:px-6 lg:px-8 mb-3 border border-4
            shadow-xl sm:rounded-lg bg-purple-200 border-x-4 border-t-4 border-purple-600 p-5 text-purple-600"
              method="POST" enctype="multipart/form-data">
            @csrf
            <div class="drag-area pb-3 flex items-center justify-center flex-col">
                <div class="icon text-[100px] mt-5"><i class="fas fa-cloud-upload-alt"></i></div>
                <header class="mt-10 text-2xl">Arrastra aquí la imagen</header>
                <span class="mb-5 text-2xl">O</span>
                <button type="button" class=" my-4 bg-purple-600 hover:bg-purple-800 text-white font-bold py-2 px-4 border border-purple-700 rounded"><label for="imagen">Selecciona el archivo</label></button>
            </div>
            <div id="descripcion" class="border-t-4 border-purple-600 pt-3">
                <input type="file" name="imagen" id="imagen" required hidden>
                <header>Descripción:</header>
                <textarea name="descripcion" class="w-full resize-none rounded border-2 border-purple-600 my-3 h-24" required></textarea>
                <input type="submit" value="Subir" class="bg-purple-600 hover:bg-purple-800 text-white font-bold py-1.5 px-3.5 border border-purple-700 rounded">
            </div>
        </form>
    </div>
</x-app-layout>
