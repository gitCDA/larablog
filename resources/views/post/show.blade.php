<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <img class="w-full" src="{{ asset('/storage/' . $post->image) }}" alt="">
        <div>
            {{ $post->content }}
        </div>

    </div>

</x-app-layout>