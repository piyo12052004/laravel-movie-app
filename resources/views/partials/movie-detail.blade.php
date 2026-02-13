@extends('layouts.app')

@section('content')
    @if ($movie)
        <div class="min-h-screen bg-gray-100 py-10 px-4 md:px-16">
            <!-- Back Button -->
            <a href="{{ route('movies.index') }}"
                class="inline-block mb-6 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded shadow">
                ← Back to Movies
            </a>

            <div class="bg-white rounded-lg shadow-xl overflow-hidden flex flex-col md:flex-row gap-6">
                <!-- Poster -->
                <div class="md:w-1/3 flex-shrink-0">
                    <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/300x450?text=No+Image' }}"
                        alt="Poster of {{ $movie['Title'] }}" class="w-full h-auto rounded object-cover shadow-md">
                </div>

                <!-- Movie Details -->
                <div class="md:w-2/3 p-6 flex flex-col gap-4">
                    <h1 class="text-4xl font-bold">{{ $movie['Title'] }}
                        <span class="text-gray-500 text-xl">({{ $movie['Year'] }})</span>
                    </h1>

                    <div class="text-gray-700 space-y-2">
                        <p><strong>Genre:</strong> {{ $movie['Genre'] }}</p>
                        <p><strong>Director:</strong> {{ $movie['Director'] }}</p>
                        <p><strong>Actors:</strong> {{ $movie['Actors'] }}</p>
                    </div>

                    <div class="text-gray-800 mt-4">
                        <h2 class="font-semibold text-2xl mb-2">Plot</h2>
                        <p>{{ $movie['Plot'] }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-6 flex gap-4">
                        <!-- Save Button -->
                        <form action="{{ route('movies.save', $movie['imdbID']) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <button type="submit"
                                class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded shadow transition flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                {{__('Simpan_movie')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
