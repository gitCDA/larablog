<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un post') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="my-5">
        @foreach ($errors->all() as $error)
            <span class="block text-red-500">{{ $error }}</span>
        @endforeach
        </div>

        <form action="{{ route('posts.store') }}" method="POST"
        enctype="multipart/form-data" class="mt-10">

            @csrf

            <x-label for="name" value="Titre du post" />
            <x-input id="name" name="name" />

            <x-label for="content" value="Contenu du post" />
            <textarea id="content" name="content"></textarea>

            <x-label for="image" value="Image du post" />
            <x-input id="image" type="file" name="image" />

            <x-label for="category" value="Categorie du post" />

            <select name="category" id="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"> {{$category->name }} </option>
                @endforeach
            </select>

            <x-button style="display: block !important;" class="mt-5">Créer mon compte</x-button>

        </form>
    
    </div>

</x-app-layout>