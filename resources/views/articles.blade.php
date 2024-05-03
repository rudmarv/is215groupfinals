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
                @if({{$files}})
                    @foreach ($files as $file)
                        <li>{{ $file }}</li>
                    @endforeach
                @else
                    No Articles
                @endif
            </ul>
            </div>
        </div>
    </div>
</x-app-layout>
