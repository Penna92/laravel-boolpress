@extends('layouts.admin')
@include('partials/popupdelete')
{{-- @dump($post); --}}
{{-- @dump($post->tags) --}}
@section('content')
<div class="container">
    <div class="card d-flex flex-column my-3 gap-3">
        <div class="card-header">
            <div class="container text-center">
                <h1>Titolo: {{$post->title}}</h1>
            </div>
        </div>
        <div class="card-body d-flex flex-column gap-3">
            <div>
                <small class="mr-3">Creato il: {{$post->created_at}}</small>
                {{-- condizione per stampare il valore corretto a seconda del booleano --}}
                @if ($post->published == '1')
                {{-- <span>Pubblicato il {{$mytime}}</span> Prova per inserire la data di pubblicazione (da fixare) --}}
                <p class="badge-success d-inline-block p-1 rounded">Pubblicato</p>
                @else
                <p class="badge-danger d-inline-block p-1 rounded">Non ancora pubblicato</p>
                @endif
            </div>
            <div>
                <h2>Descrizione: </h2>
                <p>{!! $post->content !!}</p>
            </div>
            @if($post->category != null)
            <h5>Categoria: {{$post->category->name}}</h5>
            @else
            <h5>Nessuna categoria assegnata</h5>
            @endif
            @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="rounded " alt="{{ $post->title }}">
            @endif
            @if (count($post->tags)>0)
            <h5>Tags</h5>
            <ul>
                @foreach($post->tags as $item)
                <li>{{$item->name}}</li>
                @endforeach
            </ul>
            @endif
            <div class="d-flex align-items-start">
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning mr-2">Edit</a>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="boolpress.openModal(event, {{ $post->id }})"
                        class="btn btn-danger delete">Delete</button>
                </form>
            </div>
        </div>
    </div>
    @endsection