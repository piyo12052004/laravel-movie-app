<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class DetailsController extends Controller
{
    public function index()
    {
        $imdbIDs = auth()->user()->liked_films ?? []; // pastikan selalu array
        $movies = []; // inisialisasi array kosong
        $client = new Client();

        foreach ($imdbIDs as $id) {
            try {
                $response = $client->request('GET', 'https://www.omdbapi.com/', [
                    'query' => [
                        'apikey' => env('OMDB_API_KEY'),
                        'i' => $id,
                        'plot' => 'full'
                    ]
                ]);
                $movie = json_decode($response->getBody(), true);
                if ($movie && $movie['Response'] === 'True') {
                    $movies[] = $movie;
                }
            } catch (\Exception $e) {
                // bisa log error tapi jangan hentikan proses
                // \Log::error("OMDb API Error for $id: " . $e->getMessage());
            }
        }

        // Pastikan selalu dikirim ke view
        // Jika $movies kosong, view bisa menampilkan pesan "Belum ada film disukai"
        return view('pages.detail-movie', compact('movies'));
    }


    public function delete($imdbID)
    {
        /** @var \App\User $user */
        $user = Auth::user();

        // Ambil array film yang sudah ada
        $liked = $user->liked_films ?? [];

        // Hapus imdbID jika ada
        if (($key = array_search($imdbID, $liked)) !== false) {
            unset($liked[$key]);
        }

        // Reindex array supaya tetap rapi
        $liked = array_values($liked);
        $user->liked_films = $liked;

        try {
            $user->save();
            // Jika berhasil
            $this->alert('Berhasil Menghapus!', 'success');
        } catch (\Exception $e) {
            // Jika gagal
            $this->alert('Gagal Menghapus!', 'error');
            // \Log::error('Error menghapus film: ' . $e->getMessage());
        }

        return back();
    }
}
