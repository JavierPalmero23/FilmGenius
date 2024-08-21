<?php

// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // Enviar el correo electrónico (esto es solo un ejemplo, asegúrate de configurar correctamente tu sistema de correo)
        Mail::raw($request->input('message'), function ($message) use ($request) {
            $message->to('support@example.com') // Cambia a la dirección de destino
                    ->subject('Mensaje de Contacto de ' . $request->input('name'))
                    ->from($request->input('email'));
        });

        // Redirigir con un mensaje de éxito
        return redirect()->route('movies.contact')->with('success', 'Gracias por contactarnos. Responderemos pronto.');
    }
}
