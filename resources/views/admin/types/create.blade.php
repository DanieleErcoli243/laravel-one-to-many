@extends('layouts.app')

@section('title', 'Crea tipo')

@section('content')



<form action="{{ route('admin.types.store }}" method="POST">
    @csrf
    <label for="label">Inserisci etichetta</label>
    <input type="text" id="label" name="label" value="{{ old('label', '') }}">
</form>

@endsection