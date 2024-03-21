<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: calc(100% - 12px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        .success-message {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4caf50;
            color: #fff;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contactos</h1>

        <!-- Formulario para ingresar nuevos contactos -->
        <h2>Agregar Contacto</h2>
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="contact-form" method="POST" action="{{ route('guardar_contacto') }}">
            @csrf
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required>

            <label for="empresa">Empresa:</label>
            <input type="text" id="empresa" name="empresa" value="{{ old('empresa') }}">

            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}">

            <input type="submit" value="Agregar Contacto">
        </form>

        <!-- Mostrar los contactos existentes -->
        <h2>Contactos Guardados</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Empresa</th>
                <th>Correo Electrónico</th>
            </tr>
            @foreach ($contactos as $contacto)
                <tr>
                    <td>{{ $contacto->nombre }}</td>
                    <td>{{ $contacto->telefono }}</td>
                    <td>{{ $contacto->empresa }}</td>
                    <td>{{ $contacto->correo_electronico }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Ventana emergente para mensaje de éxito -->
    <div class="success-message" id="success-message">
        Contacto agregado correctamente.
    </div>

    <script>
        // Mostrar mensaje de éxito después de enviar el formulario
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            var nombre = document.getElementById('nombre').value;
            var telefono = document.getElementById('telefono').value;

            // Verificar si los campos nombre y teléfono están completos
            if (nombre.trim() !== '' && telefono.trim() !== '') {
                event.preventDefault(); // Detener el envío del formulario

                document.getElementById('success-message').style.display = 'block';

                // Ocultar el mensaje de éxito después de 5 segundos
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                    document.getElementById('contact-form').submit(); // Enviar el formulario después de ocultar el mensaje
                }, 1000);
            }
        });
    </script>
</body>
</html>
