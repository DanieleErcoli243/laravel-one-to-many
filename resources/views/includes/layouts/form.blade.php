@if($project->exists)
<form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

@else
<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
@endif   
    <div class="form-row">
        <label for="title">Inserisci titolo</label>
        <input type="text" id="title" name="title" value="{{ old('title', $project->title)}}" >
        <label for="description">Inserisci una breve descrizione</label>
        <textarea type="text" id="description" name="description">{{ old('description', $project->description)}}</textarea>
        <label for="image"></label>
        <input type="file" id="image" name="image">
        <button type="submit" class="sub-btn">Invia</button>
    </div>
</form>
