@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('match.search') }}" method="POST">
            @csrf
            <label for="movie1">Selecciona tu película:</label>
            <input type="text" name="movie1" id="movie1" placeholder="Buscar película" required>

            <label for="movie2">Seleccionar una película:</label>
            <input type="text" name="movie2" id="movie2" placeholder="Buscar película" required>

            <button type="submit">Buscar Películas en Común</button>
        </form>
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
                                    <p class="card-text">
                                        Rating: {{ number_format($movie['vote_average'], 1) }}/10
                                    </p>
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
                <p>No se encontraron películas en común.</p>
            @endif
        @endif
    </div>

    <script>
        $(function() {
            // Función para obtener sugerencias
            function fetchSuggestions(request, response) {
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
                    }
                });
            }

            // Configuración de autocompletado
            $("#movie1, #movie2").autocomplete({
                source: fetchSuggestions,
                select: function(event, ui) {
                    // Puedes usar ui.item.id para enviar el id de la película si es necesario
                    console.log("Selected movie ID:", ui.item.id);
                }
            });
        });
    </script>
@endsection
