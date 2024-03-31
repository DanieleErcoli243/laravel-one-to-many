@extends('layouts.app')

@section('title', 'Modifica')

@section('content')


<form action="{{ route('admin.types.update }}" method="post">
@csrf
@method('PUT')
    <label for="label">Modifica etichetta</label>
    <input type="text" id="label" name="label" placeholder="Etichetta" value="{{ old('label', $type->label) }}">
</form>

@endsection