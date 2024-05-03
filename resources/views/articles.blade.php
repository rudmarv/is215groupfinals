<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Articles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg">
            <div class=" w-1/2 overflow-hidden ">
            <h1>List of Files</h1>
            <ul>
                @foreach ($files as $file)
                    <li>{{ $file }}</li>

                @php
                    $url = 'https://is215finals.s3.amazonaws.com/articles/'.$file.'-article.json';
                    $jsonData = file_get_contents($url);
                    $data = json_decode($jsonData, true);
                @endphp

                @if ($data !== null)
                    <h1>{{ $data['title'] }}</h1>
                    <p>{{ $data['article'] }}</p>
                @else
                    <p>Failed to decode JSON.</p>
                @endif

                @endforeach
            </ul>
            </div>
        </div>
    </div>
</x-app-layout>
