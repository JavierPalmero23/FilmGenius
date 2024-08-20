<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        $movie1 = $request->get('movie1');
        return view('movies.match', compact('movie1'));
    }

    public function showForm()
    {
        return view('movies.match');
    }

    public function search(Request $request)
    {
        // Validar entradas
        $request->validate([
            'movie1' => 'required|string',
            'movie2' => 'required|string',
        ]);
        // Buscar las películas en TMDb
        $movie1 = $this->searchMovie($request->input('movie1'));
        $movie2 = $this->searchMovie($request->input('movie2'));

        // Verificar si ambas películas se encontraron
        if (!$movie1 || !$movie2) {
            return redirect()->back()->withErrors(['error' => 'No se encontró alguna de las películas.']);
        }

        // Obtener películas similares
        $similarMovies1 = $this->getSimilarMovies($movie1['id']);
        $similarMovies2 = $this->getSimilarMovies($movie2['id']);

        // Encontrar las películas comunes
        $commonMovies = collect($similarMovies1)->keyBy('id')
            ->intersectByKeys(
                collect($similarMovies2)->keyBy('id')
            )->values()->all();

        return view('movies.match', ['movies' => $commonMovies]);
    }

    private function searchMovie($query)
    {

        $url = "https://api.themoviedb.org/3/search/movie";
        $response = Http::get($url, [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'es_MX',
            'query' => $query,
        ]);

        // Manejo de la respuesta
        $results = $response->json()['results'] ?? [];
        return $results[0] ?? null;

        $results = $response->json()['results'] ?? [];
        return $results[0] ?? null;  // Devolver la primera película encontrada
    }

    private function getSimilarMovies($movieId)
    {
        $url = "https://api.themoviedb.org/3/movie/$movieId/similar?";
        $response = Http::get($url, [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'es_MX',
        ]);
        //dd($response);


        return $response->json()['results'] ?? [];
    }

    public function searchmatch(Request $request)
    {
        // Validar entradas
        $request->validate([
            'movie1' => 'required|string',
            'movie2' => 'required|string',
        ]);

        // Buscar las películas en TMDb
        $movie1 = $this->searchMovie($request->input('movie1'));
        $movie2 = $this->searchMovie($request->input('movie2'));

        // Verificar si ambas películas se encontraron
        if (!$movie1 || !$movie2) {
            return redirect()->back()->withErrors(['error' => 'No se encontró alguna de las películas.']);
        }

        // Obtener películas similares
        $similarMovies1 = $this->getSimilarMovies($movie1['id']);
        $similarMovies2 = $this->getSimilarMovies($movie2['id']);

        // Encontrar las películas comunes
        $commonMovies = collect($similarMovies1)->keyBy('id')
            ->intersectByKeys(collect($similarMovies2)->keyBy('id'))
            ->values()
            ->all();

        return view('movies.match-results', ['movies' => $commonMovies]);
    }
}
