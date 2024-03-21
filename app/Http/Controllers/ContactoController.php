<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;

class ContactoController extends Controller
{
    // Método para mostrar el formulario y los contactos
    public function mostrarFormulario()
    {
        $contactos = Contacto::all(); 
        return view('contactos', ['contactos' => $contactos]);
    }

    // Método para guardar el contacto en la base de datos
    public function guardarContacto(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
        ]);

        // Crear un nuevo contacto
        $contacto = new Contacto();
        $contacto->nombre = $request->nombre;
        $contacto->telefono = $request->telefono;
        $contacto->empresa = $request->empresa;
        $contacto->correo_electronico = $request->correo;
        $contacto->save();

        // Redireccionar a la página de mostrar contactos con un mensaje de éxito
        return redirect()->route('mostrar_contactos')->with('success', 'Contacto agregado correctamente.');
    }

    // Método para mostrar los contactos agregados
    public function mostrarContactos()
    {
        $contactos = Contacto::all();
        return view('contactos', ['contactos' => $contactos]);
    }
}