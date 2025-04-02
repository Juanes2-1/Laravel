<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    
    <form action="{{ route('registro.store') }}" method="POST">
        @csrf
        <label>Documento:</label>
        <input type="text" name="documento" required><br>

        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" required><br>

        <label>Correo:</label>
        <input type="email" name="correo" required><br>

        <label>Saldo Inicial:</label>
        <input type="number" name="saldoIni" step="0.01" required><br>

        <label>Ciudad de Nacimiento:</label>
        <input type="text" name="ciudadNa" required><br>

        <label>Contraseña:</label>
        <input type="password" name="contraseña" required><br>

        <button type="submit">Registrarse</button>
    </form>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
