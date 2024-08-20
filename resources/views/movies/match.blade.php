@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card p-4 shadow-lg">
                <h3 class="text-center mb-4">Encuentra Películas en Común</h3>
                <form action="{{ route('match.search') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6 position-relative">
                        <label for="movie1" class="form-label">Selecciona tu película:</label>
                        @if(request('movie1'))
                        <input type="text" name="movie1" id="movie1" class="form-control" placeholder="Buscar película" value="{{ request('movie1') }}" required>
                        @else
                        <input type="text" name="movie1" id="movie1" class="form-control" placeholder="Buscar película" required>
                        @endif
                        <div id="movie1-loading" class="loading-spinner d-none position-absolute top-50 end-0 translate-middle">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 position-relative">
                        <label for="movie2" class="form-label">Seleccionar una película:</label>
                        <input type="text" name="movie2" id="movie2" class="form-control" placeholder="Buscar película" value="{{ request('movie2') }}" required>
                        <div id="movie2-loading" class="loading-spinner d-none position-absolute top-50 end-0 translate-middle">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Cargando...</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary px-5">Buscar Películas en Común</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($movies))
            @if(count($movies) > 0)
                @foreach($movies as $movie)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a data-toggle="modal" data-target="#movieModal{{ $movie['id'] }}">
                                <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $movie['title'] }}</h5>
                                    <p class="card-text">Rating: {{ number_format($movie['vote_average'], 1) }}/10</p>
                                </div>
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
                                    <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" class="btn btn-primary" target="_blank">+Info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-muted">No se encontraron películas en común.</p>
            @endif
        @endif
    </div>
</div>

<script>
    $(function() {
        function fetchSuggestions(request, response, elementId) {
            $(`#${elementId}-loading`).removeClass('d-none'); // Muestra el spinner de carga
            $.ajax({
                url: 'https://api.themoviedb.org/3/search/movie',
                dataType: 'json',
                data: {
                    api_key: '{{ env('TMDB_API_KEY') }}',
                    query: request.term
                },
                success: function(data) {
                    response(data.results.map(function(movie) {
                        return {
                            label: movie.title,
                            value: movie.title,
                            id: movie.id
                        };
                    }));
                },
                complete: function() {
                    $(`#${elementId}-loading`).addClass('d-none'); // Oculta el spinner de carga
                }
            });
        }

        // Configuración de autocompletado para ambas casillas
        $("#movie1").autocomplete({
            source: function(request, response) {
                fetchSuggestions(request, response, 'movie1');
            },
            select: function(event, ui) {
                console.log("Selected movie ID:", ui.item.id);
            },
            minLength: 3,
            delay: 300
        });

        $("#movie2").autocomplete({
            source: function(request, response) {
                fetchSuggestions(request, response, 'movie2');
            },
            select: function(event, ui) {
                console.log("Selected movie ID:", ui.item.id);
            },
            minLength: 3,
            delay: 300
        });
    });
</script>
@endsection
