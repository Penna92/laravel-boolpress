@extends('layouts.admin')
@include('partials/popupdelete')
{{-- @dump($tags) --}}
@section('content')
<div class="container">
    <a href="{{route('admin.tags.create')}}" class="btn btn-primary my-3">Crea nuovo tag</a>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Data di creazione</th>
                <th scope="col">Modifica Tag</th>
                <th scope="col">Elimina Tag</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
            <tr>
                <td><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->id}}</a></td>
                <td><a href="{{route('admin.tags.show', $tag->id)}}">{{$tag->name}}</a></td>

                <td>{{$tag->created_at}}</td>
                <td><a href="{{route('admin.tags.edit', $tag->id)}}" class="btn btn-warning">Modifica</a>
                </td>
                <td>
                    <form action="{{route('admin.tags.destroy', $tag->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="boolpress.openModal(event, {{ $tag->id }})"
                            class="btn btn-danger delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{-- PER LA VISUALIZZAZIONE DEL PAGINATE --}}
    {{$tags->links()}}
</div>
@endsection