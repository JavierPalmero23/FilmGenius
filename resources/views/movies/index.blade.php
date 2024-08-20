@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $type === 'alphabetical' ? 'Alfabeticamente' : ($type === 'category' ?  $categoryName : 'Popular') }}</h1>

    <!-- Botones para cambiar entre popular, alfabético y categoría -->
    <div class="mb-3 d-flex align-items-center">
    <a href="{{ route('movies.index', ['type' => 'popular', 'page' => $currentPage]) }}" class="btn btn-primary mr-2">Popular</a>
    <a href="{{ route('movies.index', ['type' => 'alphabetical', 'page' => $currentPage]) }}" class="btn btn-secondary mr-2">Alfabeticamente</a>

    <!-- Selección de categoría -->
    <select onchange="location = this.value;" class="btn btn-outline-dark mr-2">
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => null]) }}" {{ is_null($categoryId) ? 'selected' : '' }}>Todas</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 16]) }}" {{ $categoryId == 16 ? 'selected' : '' }}>Animacion</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 12]) }}" {{ $categoryId == 12 ? 'selected' : '' }}>Aventura</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 28]) }}" {{ $categoryId == 28 ? 'selected' : '' }}>Accion</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 35]) }}" {{ $categoryId == 35 ? 'selected' : '' }}>Comedia</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 80]) }}" {{ $categoryId == 80 ? 'selected' : '' }}>Crimen</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 99]) }}" {{ $categoryId == 99 ? 'selected' : '' }}>Documental</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 18]) }}" {{ $categoryId == 18 ? 'selected' : '' }}>Drama</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10751]) }}" {{ $categoryId == 10751 ? 'selected' : '' }}>Familiar</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 14]) }}" {{ $categoryId == 14 ? 'selected' : '' }}>Fantasia</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 36]) }}" {{ $categoryId == 36 ? 'selected' : '' }}>Historia</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 27]) }}" {{ $categoryId == 27 ? 'selected' : '' }}>Horror</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10402]) }}" {{ $categoryId == 10402 ? 'selected' : '' }}>Musical</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 9648]) }}" {{ $categoryId == 9648 ? 'selected' : '' }}>Misterio</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10749]) }}" {{ $categoryId == 10749 ? 'selected' : '' }}>Romance</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 878]) }}" {{ $categoryId == 878 ? 'selected' : '' }}>Ciencia Ficcion</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10770]) }}" {{ $categoryId == 10770 ? 'selected' : '' }}>De Serie A Pelicula</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 53]) }}" {{ $categoryId == 53 ? 'selected' : '' }}>Suspenso</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 10752]) }}" {{ $categoryId == 10752 ? 'selected' : '' }}>Guerra</option>
        <option value="{{ route('movies.index', ['type' => 'category', 'page' => 1, 'category' => 37]) }}" {{ $categoryId == 37 ? 'selected' : '' }}>Vaqueeros</option>
    </select>

    <!-- Formulario de búsqueda -->
    <form method="GET" action="{{ route('movies.index') }}" class="d-flex align-items-center">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search for movies..." value="{{ $searchQuery }}">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="category" value="{{ $categoryId }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </form>
</div>

    <div class="row">
        @foreach($tmdbMovies as $movie)
        <div class="col-md-3 mb-4">
            <div class="card">
                <a data-toggle="modal" data-target="#movieModal{{ $movie['id'] }}">
                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie['title'] }}</h5>
                        <p class="card-text">
                            Rating: {{ number_format($movie['vote_average'], 1) }}/10
                        </p>
                </a>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="movieModal{{ $movie['id'] }}" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel{{ $movie['id'] }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="movieModalLabel{{ $movie['id'] }}">{{ $movie['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="img-fluid mb-3" alt="{{ $movie['title'] }}">
                        <p><strong>Rating:</strong> {{ number_format($movie['vote_average'], 1) }}/10</p>
                        <p><strong>Overview:</strong> {{ $movie['overview'] }}</p>
                    </div>
                    <div class="modal-footer">
                        @auth
                        <!-- Botón de Acción para Usuarios Autenticados -->
                        <button type="button" class="btn btn-primary">Match</button>
                        @endauth
                        <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" class="btn btn-primary" target="_blank">+Info</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endforeach
</div>

<!-- Botones de Paginación -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <!-- Botón Anterior -->
        @if($currentPage > 1)
        <li class="page-item">
            <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page={{ $currentPage - 1 }}&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif" aria-label="Previous">
                <span aria-hidden="true">&laquo; Anterior</span>
            </a>
        </li>
        @endif

        <!-- Primera Página -->
        @if($currentPage > 4)
        <li class="page-item">
            <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page=1&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif">1</a>
        </li>
        @if($currentPage > 5)
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        @endif
        @endif

        <!-- Páginas Iniciales -->
        @for($i = max(2, $currentPage - 2); $i < $currentPage; $i++)
            <li class="page-item">
            <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page={{ $i }}&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif">{{ $i }}</a>
            </li>
            @endfor

            <!-- Página Actual -->
            <li class="page-item active">
                <span class="page-link">{{ $currentPage }}</span>
            </li>

            <!-- Páginas Siguientes -->
            @for($i = $currentPage + 1; $i <= min($currentPage + 2, min(500, $totalPages)); $i++)
                <li class="page-item">
                <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page={{ $i }}&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif">{{ $i }}</a>
                </li>
                @endfor

                <!-- Última Página -->
                @if($currentPage < min(500, $totalPages) - 3)
                    @if($currentPage < min(500, $totalPages) - 4)
                    <li class="page-item disabled">
                    <span class="page-link">...</span>
                    </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page={{ min(500, $totalPages) }}&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif">{{ min(500, $totalPages) }}</a>
                    </li>
                    @endif

                    <!-- Botón Siguiente -->
                    @if($currentPage < min(500, $totalPages))
                        <li class="page-item">
                        <a class="page-link" href="?@if($searchQuery)search={{$searchQuery}}@endif&page={{ $currentPage + 1 }}&type={{ $type }}@if($categoryId) &category={{ $categoryId }} @endif" aria-label="Next">
                            <span aria-hidden="true">Siguiente &raquo;</span>
                        </a>
                        </li>
                        @endif
    </ul>
</nav>
</div>
@endsection