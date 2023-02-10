{{--@vite(['resources/css/uploadImage.css', 'resources/js/uploadImage.js'])--}}
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<x-app-layout>
    <div class="py-12">
        <form action="{{ route('guardar_imagen') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="drag-area">
                <div class="icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <header>Arrastra aquí la imagen</header>
                <span>O</span>
                <button type="button"><label for="imagen">Selecciona el archivo</label></button>
                <input type="file" name="imagen" id="imagen" required >
            </div>
            <div id="descripcion">
                <header>Descripción:</header>
                <textarea name="descripcion" required></textarea>
                <input type="submit" value="Subir">
            </div>
        </form>
    </div>
</x-app-layout>
