@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card p-4 shadow-lg" style="background-color: #1d021f;">
                <h3 class="text-center mb-4" style="color: #bd0cc9;">Recomendador de Películas</h3>

                <!-- Formulario para buscar una película -->
                <form action="{{ route('movies.recommend') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="movie" class="form-label" style="color: #bd0cc9;">Nombre de la Película</label>
                        <input type="text" class="form-control" id="movie" name="movie" placeholder="Ingrese el nombre de la película" value="{{ request('movie') }}" required>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-light px-5" style="background-color: #6d0774; color: #FFFFFF;">Obtener Recomendaciones</button>
                    </div>
                </form>

                <!-- Manejo de errores -->
                @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="row">
        @if(isset($movies))
        @if(count($movies) > 0)
        @foreach($movies as $movie)
        <div class="col-md-3 mb-4">
            <div class="card" style="background-color: #1d021f; width: 100%; height: 100%;">
                <a data-toggle="modal" data-target="#movieModal{{ $movie['id'] }}">
                    <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['title'] }}">
                    <div class="card-body">
                        <h5 class="card-title" style="color: #FFFFFF;">{{ $movie['title'] }}</h5>
                        <p class="card-text" style="color: #FFFFFF;">
                            Calificación: <b style="color: #bd0cc9;">{{ number_format($movie['vote_average'], 1) }}</b>/10
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="movieModal{{ $movie['id'] }}" tabindex="-1" role="dialog" aria-labelledby="movieModalLabel{{ $movie['id'] }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color: #1d021f;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="movieModalLabel{{ $movie['id'] }}" style="color: #FFFFFF;">{{ $movie['title'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="https://image.tmdb.org/t/p/w500/{{ $movie['poster_path'] }}" class="img-fluid mb-3 text-center" alt="{{ $movie['title'] }}">
                        <p style="color: #FFFFFF;"><strong>Calificación:</strong> <b style="color: #bd0cc9;">{{ number_format($movie['vote_average'], 1) }}</b>/10</p>
                        <p style="color: #FFFFFF;"><strong>Sinopsis:</strong> {{ $movie['overview'] }}</p>
                    </div>
                    <div class="modal-footer">
                        @auth
                        <!-- Botón de Acción para Usuarios Autenticados -->
                        <a href="{{ route('movies.recommend.now', ['movie' => $movie['title']]) }}" class="btn btn-light px-4" style="background-color: #6d0774; color: #FFFFFF;">Recomendaciones</a>
                        <a href="{{ route('match.index', ['movie1' => $movie['title']]) }}" class="btn btn-light px-4" style="background-color: #6d0774; color: #FFFFFF;">Match</a>
                        @endauth
                        <a href="https://www.themoviedb.org/movie/{{ $movie['id'] }}" class="btn btn-light px-4" style="background-color: #6d0774; color: #FFFFFF;" target="_blank">+Info</a>
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
@endsection