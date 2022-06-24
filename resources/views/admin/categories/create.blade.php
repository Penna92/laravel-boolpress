@extends('layouts.admin')

@section('content')
<div class="container">
    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome della categoria</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Inserisci il nome della categoria">
            @error('name')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
</div>
@endsection