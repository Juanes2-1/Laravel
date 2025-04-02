@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Recargar Dinero</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('recargar.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="monto" class="form-label">Monto a Recargar</label>
            <input type="number" class="form-control" name="monto" id="monto" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Recargar</button>
    </form>
</div>
@endsection
