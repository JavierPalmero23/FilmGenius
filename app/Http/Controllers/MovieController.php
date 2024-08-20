<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // Obtener la página actual y el tipo de vista desde el parámetro de consulta, por defecto será 'popular'
        $page = $request->input('page', 1);
        $type = $request->input('type', 'popular');
        $categoryId = $request->input('category', null);
        $searchQuery = $request->input('search', '');

        // Limitar la página actual a un máximo de 500
        if ($page > 500) {
            $page = 500;
        }

        $client = new \GuzzleHttp\Client();
        $apiKey = env('TMDB_API_KEY');
        $language = 'es-MX';

        // Mapeo de IDs de categorías a nombres
        $categories = [
            16 => 'Animación',
            12 => 'Aventura',
            28 => 'Acción',
            35 => 'Comedia',
            80 => 'Crimen',
            99 => 'Documental',
            18 => 'Drama',
            10751 => 'Familiar',
            14 => 'Fantasía',
            36 => 'Historia',
            27 => 'Horror',
            10402 => 'Musical',
            9648 => 'Misterio',
            10749 => 'Romance',
            878 => 'Ciencia Ficción',
            10770 => 'De Serie a Película',
            53 => 'Suspenso',
            10752 => 'Guerra',
            37 => 'Vaqueros',
        ];

        // Obtener el nombre de la categoría
        $categoryName = $categoryId ? $categories[$categoryId] ?? 'Categoría Desconocida' : 'Todas';

        // Construir la URL de la API en función del tipo de vista
        $url = '';
        $options = [];
        if ($type === 'popular') {
            $url = 'https://api.themoviedb.org/3/movie/popular';
        } elseif ($type === 'alphabetical') {
            $url = 'https://api.themoviedb.org/3/discover/movie';
            $options['query']['sort_by'] = 'original_title.asc'; // Ordenar alfabéticamente
        } elseif ($type === 'category' && $categoryId) {
            $url = 'https://api.themoviedb.org/3/discover/movie';
            $options['query']['with_genres'] = $categoryId;
        } else {
            // Manejar caso en el que no se especifique el tipo
            $url = 'https://api.themoviedb.org/3/movie/popular';
            $categoryName = 'Popular';
        }
        if (!empty($searchQuery)) {
            $url = 'https://api.themoviedb.org/3/search/movie';
            $options['query']['query'] = $searchQuery;
        }

        // Hacer la petición a la API de TMDB con la página actual y otros parámetros
        $response = $client->request('GET', $url, [
            'query' => array_merge([
                'api_key' => $apiKey,
                'language' => $language,
                'page' => $page
            ], $options['query'] ?? [])
        ]);

        // Decodificar la respuesta JSON
        $movies = json_decode($response->getBody()->getContents(), true);

        // Pasar las películas y la página actual a la vista
        return view('movies.index', [
            'tmdbMovies' => $movies['results'],
            'currentPage' => $page,
            'totalPages' => $movies['total_pages'],
            'type' => $type,
            'categoryId' => $categoryId,
            'categoryName' => $categoryName,
            'searchQuery' => $searchQuery
        ]);
    }
}
