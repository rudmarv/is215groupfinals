<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Articles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg">
            <h1>List of Articles</h1>
            
                @foreach ($files as $file)
                <div class=" w-1/3 overflow-hidden "><img class="w-auto max-w-lg rounded-lg mb-6" src="https://is215finals.s3.amazonaws.com/{{ $file }}" alt="image description"></div>
                @php
                    $url = 'https://is215finals.s3.amazonaws.com/articles/'.$file.'-article.json';
                    $jsonData = file_get_contents($url);
                    $data = json_decode($jsonData, true);
                @endphp

                @if ($data !== null)
                <div class=" w-2/3 overflow-hidden ">
                    <h2 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">{{ $data['title'] }}</h1>
                </div>
                <div class=" w-full overflow-hidden ">
                    <p class="text-gray-500 ">{{ $data['article'] }}</p>
                </div>
                @else
                    <p></p>
                @endif

                @endforeach
                
        </div>
    </div>
</x-app-layout>
