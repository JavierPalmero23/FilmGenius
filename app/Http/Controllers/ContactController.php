<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('movies.contact');
    }

    public function submitContactForm(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'message' => 'required|string|min:10',
    ]);

    // Guardar el mensaje de contacto en la base de datos
    ContactMessage::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'message' => $request->input('message'),
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('movies.contact')->with('success', 'Gracias por contactarnos. Hemos guardado tu mensaje.');
}


    public function listMessages()
{
    $messages = ContactMessage::all();
    return view('movies.contact-messages', compact('messages'));
}
}
