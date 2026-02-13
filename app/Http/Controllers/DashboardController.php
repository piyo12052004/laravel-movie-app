<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $apiKey = env('OMDB_API_KEY');
        $moviesPerPage = 10;
        $pageFront = $request->input('page', 1);
        $searchQuery = $request->input('query');
        $client = new Client();
        $allMovies = [];

        try {
            if ($searchQuery) {
                $response = $client->request('GET', 'https://www.omdbapi.com/', [
                    'query' => [
                        'apikey' => $apiKey,
                        's' => $searchQuery,
                        'page' => $pageFront
                    ]
                ]);

                $data = json_decode($response->getBody(), true);
                $allMovies = $data['Search'] ?? [];
                $movies = array_values($allMovies);
                $totalResults = isset($data['totalResults']) ? (int)$data['totalResults'] : count($movies);
                $totalPages = ceil($totalResults / $moviesPerPage);
            } else {
                // Random movies untuk halaman pertama
                $keywords = ['Batman', 'Naruto', 'Avengers', 'One Piece', 'Spider-Man'];
                foreach ($keywords as $kw) {
                    $response = $client->request('GET', 'https://www.omdbapi.com/', [
                        'query' => [
                            'apikey' => $apiKey,
                            's' => $kw,
                            'page' => 1
                        ]
                    ]);
                    $data = json_decode($response->getBody(), true);
                    if (isset($data['Search'])) {
                        $allMovies = array_merge($allMovies, $data['Search']);
                    }
                }

                shuffle($allMovies);
                $totalMovies = count($allMovies);
                $totalPages = ceil($totalMovies / $moviesPerPage);
                $offset = ($pageFront - 1) * $moviesPerPage;
                $movies = array_slice($allMovies, $offset, $moviesPerPage);
            }
        } catch (\Exception $e) {
            $movies = [];
            $totalPages = 0;
            // \Log::error('OMDb API Error: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return view('partials.movies', compact('movies'))->render();
        }
        return view('pages.dashboard', compact('movies', 'pageFront', 'totalPages', 'searchQuery'));
    }

    public function show($imdbID)
    {
        $apiKey = env('OMDB_API_KEY');
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://www.omdbapi.com/', [
                'query' => [
                    'apikey' => $apiKey,
                    'i' => $imdbID,
                    'plot' => 'full'
                ]
            ]);

            $movie = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            $movie = null;
            // \Log::error('OMDb API Detail Error: ' . $e->getMessage());
        }

        if (request()->ajax()) {
            return view('partials.movie-detail', compact('movie'))->render();
        }
        return view('partials.movie-detail', compact('movie'));
    }

    public function save($imdbID)
    {
        /** @var \App\User $user */
        $user = Auth::user();

        $liked = $user->liked_films ?? [];

        if (!in_array($imdbID, $liked)) {
            $liked[] = $imdbID;
        }

        $user->liked_films = $liked;
        $user->save();
        $this->alert('Berhasil Simpan!', 'success');
        return back();
    }
}
