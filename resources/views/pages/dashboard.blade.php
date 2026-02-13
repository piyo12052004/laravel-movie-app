@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold mb-6 text-center">{{ __('Movie_List') }}</h1>

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('movies.index') }}" class="flex justify-center mb-6" x-data
          x-on:submit="$el.querySelector('button').disabled = true">
        <input type="text" name="query" placeholder="Search movie..." value="{{ request('query') }}"
               class="border border-gray-300 rounded-l px-4 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600 transition">
            Search
        </button>
    </form>

    <!-- Grid Movies with Infinite Scroll -->
    <div x-data="infiniteScroll()" x-init="init()" 
         class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6" 
         id="movies-container">

        @include('partials.movies', ['movies' => $movies])

    </div>

    <!-- Loader -->
    <div id="loader" x-show="loading" class="text-center mt-6 text-gray-500 hidden">
        Loading...
    </div>

    <!-- No movies found -->
    @if (count($movies) === 0)
        <p class="text-center text-gray-500 mt-6">No movies found.</p>
    @endif

</div>

<script>
function infiniteScroll() {
    return {
        loading: false,
        page: {{ $pageFront }},
        totalPages: {{ $totalPages }},
        query: "{{ $searchQuery }}",
        init() {
            const loader = document.getElementById('loader');
            window.addEventListener('scroll', () => {
                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 200) {
                    this.loadMore(loader);
                }
            });
        },
        loadMore(loader) {
            if (this.loading || this.page >= this.totalPages) return;
            this.loading = true;
            loader.classList.remove('hidden');
            this.page++;

            fetch(`{{ route('movies.index') }}?query=${this.query}&page=${this.page}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newMovies = doc.querySelectorAll('.movie-item');
                const container = document.getElementById('movies-container');

                if(newMovies.length > 0){
                    newMovies.forEach(m => container.appendChild(m));
                } else {
                    loader.innerText = "No more movies";
                }

                this.loading = false;
                loader.classList.add('hidden');
            })
            .catch(err => {
                console.error('Fetch error:', err);
                this.loading = false;
                loader.classList.add('hidden');
            });
        }
    }
}

</script>
@endsection
