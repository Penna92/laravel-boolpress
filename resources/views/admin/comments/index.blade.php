@extends('layouts.admin')
@include('partials/popupdelete')
{{-- @dump($comments) --}}
@section('content')
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm comment delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare la categoria con id: @{{itemId}} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" @@click="submitForm()">Conferma</button>
                </div>
            </div>
        </div>
    </div>
    <a href="{{route('admin.comments.create')}}" class="btn btn-primary my-3">Crea nuova categoria</a>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{session()->get('message')}}
    </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Commento</th>
                <th scope="col">Data di creazione</th>
                <th scope="col">Elimina Commento</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $comment)
            <tr>
                <td><a href="{{route('admin.comments.show', $comment->id)}}">{{$comment->id}}</a></td>
                <td>{{$comment->username}}</td>
                <td>{{$comment->content}}</a>
                </td>
                <td>{{$comment->created_at}}</td>
                <td>
                    <form action="{{route('admin.comments.destroy', $comment->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="boolpress.openModal(event, {{ $comment->id }})"
                            class="btn btn-danger delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{-- PER LA VISUALIZZAZIONE DEL PAGINATE --}}
    {{$comments->links()}}
</div>
@endsection