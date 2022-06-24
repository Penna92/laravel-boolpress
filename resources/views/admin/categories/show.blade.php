@extends('layouts.admin')
{{-- @dump($category); --}}
@section('content')
<div class="container d-flex flex-column my-3 gap-5">
    <div>
        <h1>Nome: {{$category->name}}</h1>
        <small>Creato il: {{$category->created_at}}</small>
    </div>
</div>
@endsection