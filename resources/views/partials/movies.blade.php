@foreach ($movies as $movie)
    <div class="border rounded shadow hover:shadow-lg transition overflow-hidden movie-item">
        <a href="/movies/{{ $movie['imdbID'] }}">
            <img src="{{ $movie['Poster'] != 'N/A' ? $movie['Poster'] : 'https://via.placeholder.com/150x220?text=No+Image' }}"
                alt="{{ $movie['Title'] }}" loading="lazy" decoding="async" class="w-full h-64 object-cover bg-gray-100">
            <div class="p-3">
                <h4 class="font-semibold text-lg">{{ $movie['Title'] }}</h4>
                <p class="text-gray-600">{{ $movie['Year'] }}</p>
            </div>
        </a>
    </div>
@endforeach
