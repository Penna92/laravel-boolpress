@extends('layouts.admin')
{{-- @dump($tag); --}}
@section('content')
<div class="container d-flex flex-column my-3 gap-5">
    <div>
        <h1>Nome: {{$tag->name}}</h1>
        <small>Creato il: {{$tag->created_at}}</small>
    </div>
</div>
@endsection