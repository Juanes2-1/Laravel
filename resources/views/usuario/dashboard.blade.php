<h1>Bienvenido, {{ session('usuario_nombre') }}</h1>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Cerrar sesión</button>
</form>
