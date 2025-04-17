<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Muestra el formulario de contacto
    public function show()
    {
        return view('contact');
    }

    // Procesa el envío del formulario de contacto
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        try {
            \Mail::to(env('MAIL_TO_ADDRESS', config('mail.from.address')))->send(
                new \App\Mail\ContactMail(
                    $request->input('name'),
                    $request->input('email'),
                    $request->input('message')
                )
            );
            return redirect()->route('contact')->with('success', '¡Mensaje enviado correctamente!');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', 'Tu mensaje no fue enviado. Intenta nuevamente más tarde.');
        }
    }
}
