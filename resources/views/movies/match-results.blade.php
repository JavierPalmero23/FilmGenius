@extends('layouts.app')

@section('content')

<h1>Películas en Común</h1>

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


@endsection
