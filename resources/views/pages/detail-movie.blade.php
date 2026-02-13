@extends('layouts.app')

@section('title', 'Detail Movies')

@section('content')
    <div class="min-h-screen bg-gray-100 py-10 px-4 md:px-16 space-y-6">
        <h1 class="text-3xl font-bold mb-6">{{__('Liked_movies_title')}}</h1>

        @forelse ($movies as $movie)
            <div
                class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col md:flex-row gap-4 hover:shadow-lg transition">
                <!-- Poster -->
                <div class="md:w-1/3 flex-shrink-0">
                    <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Image' }}"
                        alt="{{ $movie['Title'] }} Poster" class="w-full h-auto object-cover">
                </div>

                <!-- Movie Details -->
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">{{ $movie['Title'] }} <span
                                class="text-gray-500 text-lg">({{ $movie['Year'] }})</span></h2>
                        <p class="text-gray-700 mb-2"><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
                        <p class="text-gray-700 mb-2"><strong>Director:</strong> {{ $movie['Director'] }}</p>
                        <p class="text-gray-700 mb-2"><strong>Actors:</strong> {{ $movie['Actors'] }}</p>

                        <h3 class="font-semibold text-lg mt-4 mb-1">Plot</h3>
                        <p class="text-gray-800">{{ $movie['Plot'] }}</p>
                    </div>

                    <div class="mt-1 flex gap-4">
                        <!-- Like Button -->
                        <form action="{{ route('movies.deleete', $movie['imdbID']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded shadow transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m3 3 1.664 1.664M21 21l-1.5-1.5m-5.485-1.242L12 17.25 4.5 21V8.742m.164-4.078a2.15 2.15 0 0 1 1.743-1.342 48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185V19.5M4.664 4.664 19.5 19.5" />
                                </svg>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">{{__('detail_empty_likes')}}</p>
        @endforelse
    </div>
@endsection
