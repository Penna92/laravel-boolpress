@extends('layouts.admin')

@section('content')
<div class="container">
    <form action="{{route('admin.categories.update', $category->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome della categoria</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{$category->name}}" placeholder="Inserisci il nome della categoria">
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Modifica</button>
    </form>
</div>
@endsection