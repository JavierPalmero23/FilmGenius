<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendController extends Controller
{
    // Mostrar formulario de búsqueda de recomendaciones
    public function showForm()
    {
        return view('movies.recommend');
    }

    // Método para buscar recomendaciones basadas en una película
    public function recommend(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'movie' => 'required|string',
        ]);

        // Buscar la película en TMDb
        $movie = $this->searchMovie($request->input('movie'));

        // Verificar si la película se encontró
        if (!$movie) {
            return redirect()->back()->withErrors(['error' => 'No se encontró la película.']);
        }

        // Obtener recomendaciones basadas en la película
        $recommendedMovies = $this->getRecommendedMovies($movie['id']);

        return view('movies.recommend', ['movies' => $recommendedMovies]);
    }

    // Buscar película en TMDb por título
    private function searchMovie($query)
    {
        $url = "https://api.themoviedb.org/3/search/movie";
        $response = Http::get($url, [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'es-MX',
            'query' => $query,
        ]);

        // Manejo de la respuesta
        $results = $response->json()['results'] ?? [];
        return $results[0] ?? null;  // Devolver la primera película encontrada
    }

    // Obtener recomendaciones basadas en la película
    private function getRecommendedMovies($movieId)
    {
        $url = "https://api.themoviedb.org/3/movie/$movieId/recommendations";
        $response = Http::get($url, [
            'api_key' => env('TMDB_API_KEY'),
            'language' => 'es-MX',
        ]);

        return $response->json()['results'] ?? [];
    }

    public function getRecommendations(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'movie' => 'required|string',
        ]);

        // Buscar la película en TMDb
        $movie = $this->searchMovie($request->input('movie'));

        // Verificar si la película se encontró
        if (!$movie) {
            return redirect()->back()->withErrors(['error' => 'Película no encontrada.']);
        }

        // Obtener películas similares
        $recommendedMovies = $this->getRecommendedMovies($movie['id']);

        // Renderizar la vista con las recomendaciones
        return view('movies.recommend', ['movies' => $recommendedMovies]);
    }
}
