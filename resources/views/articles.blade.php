<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View All Articles') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="flex flex-wrap max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if($files !== false)
            @php
                $filesReversed = array_reverse($files);
            @endphp
            @foreach ($filesReversed as $file)
            <div class="bg-white shadow-sm sm:rounded-lg my-6 p-6">
                <div class="w-full overflow-hidden">
                    <img class="w-auto max-w-lg rounded-lg mb-6" src="https://is215finals.s3.amazonaws.com/{{ $file }}" alt="image description">
                </div>
                @php
                    $url = 'https://is215finals.s3.amazonaws.com/articles/'.$file.'-article.json';
                    $jsonData = file_get_contents($url);
                    $data = json_decode($jsonData, true);
                @endphp

                @if ($data !== null)
                    <div class="w-full overflow-hidden">
                        <h2 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">{{ $data['title'] }}</h2>
                    </div>
                    <div class="w-full overflow-hidden">
                        <p class="text-gray-500">{{ $data['article'] }}</p>
                    </div>
                @else
                    <p></p>
                @endif
            </div>
            @endforeach
        @else
        <h2 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl">No Files Available</h2>
        @endif
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to reload CSS
            function reloadCSS() {
                var links = document.querySelectorAll('link[rel="stylesheet"]');
                links.forEach(function(link) {
                    var href = link.href.split('?')[0];
                    link.href = href + '?rand=' + Math.random();
                });
            }

            // Call reloadCSS function
            reloadCSS();
        });
        </script>
</x-app-layout>
