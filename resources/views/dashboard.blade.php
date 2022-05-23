<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                     <!-- clé success -->
            @if (session('success'))
                {{ session('success') }}
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div> -->



                @foreach ($posts as $post)
                    <div class="flex items-center">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-amber-500 px-2 py-3 block">Éditer {{ $post->name }}</a>
                        
                        <a href="#" class="bg-orange-500 px-2 py-3 block"
                        onclick="event.preventDefault
                                document.getElementById('destroy-post-form').submit() ;
                        ">Supprimer {{ $post->name }}
                        <form action="{{ route('posts.destroy', $post) }}" method="post" id="destroy-post-form">
                            @csrf
                            @method('delete')
                        </form>

                    </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>