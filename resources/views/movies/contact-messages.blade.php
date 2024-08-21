<!-- resources/views/contact-messages.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mensajes de Contacto</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $message->id }}</td>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td>{{ $message->message }}</td>
                    <td>{{ $message->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
