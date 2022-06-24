@extends('layouts.admin')
{{-- @dump($tags) --}}
@section('content')
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm tag delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare il tag con id: @{{itemId}} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @@click="submitForm()">Conferma</button>
                </div>
            </div>
        </div>
    </div>
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
                        <button type="submit" @@click="openModal($event, {{$tag->id}})"
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