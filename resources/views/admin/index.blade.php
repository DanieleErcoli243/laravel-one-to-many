@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')

<table class="text-center"> 
    <thead>
        <tr>
            <th>Titolo</th>
            <th>Descrizione</th>
            <th>Immagine</th>
            <th>
                <a href="{{ route('admin.projects.create') }}">
                  <i class="fas fa-plus"></i>
                </a>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->image }}</td>
            <td class="action-btn">
                <a href="{{ route('admin.projects.show', $project->id) }}"><i class="fas fa-eye"></i></a>
                <a href="{{ route('admin.projects.edit', $project->id) }}"><i class="fas fa-pencil"></i></a>
                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="deleting-form">
                    @csrf
                    @method('DELETE')
                    <button class="delete" type="submit">
                        <i class="fas fa-trash-can"></i>
                    </button>
                </form>    
            </td>
            @empty
            <h1>Non ci sono progetti</h1>
            @endforelse
        </tr>
    </tbody>
    
</table>

@endsection

@section('scripts')
@vite('resources/js/delete-confirmation.js')
@endsection