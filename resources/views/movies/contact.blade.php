<!-- resources/views/contact.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center mb-4">
        <div class="col-md-15">
            <div class="card p-4 shadow-lg" style="background-color: #1d021f;">
                <h1 style="color: #6d0774;">Contacto</h1>

                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label" style="color: #6d0774;">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label" style="color: #6d0774;">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Tu correo electrónico" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label" style="color: #6d0774;">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Tu mensaje" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="background-color: #6d0774;">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection