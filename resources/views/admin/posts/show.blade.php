@extends('layouts.admin')
@include('partials/popupdelete')
{{-- @dump($post); --}}
{{-- @dump($post->tags) --}}
@section('content')
<div class="container">
    <div class="card d-flex flex-column my-3 gap-5">
        <div>
            <div class="card-header">
                <div class="container text-center">
                    <h1>Titolo: {{$post->title}}</h1>
                </div>
            </div>
            <div class="container">
                @if($post->category != null)
                <h2>Categoria: {{$post->category->name}}</h2>
                @else
                <h2>Nessuna categoria assegnata</h2>
                @endif
                <small>Creato il: {{$post->created_at}}</small>
            </div>
        </div>
        <div class="container">
            <div class="">
                <h2>Contenuto: </h2>
                <p>{!! $post->content !!}</p>
            </div>
            @if ($post->image)
            <div class="mt-3">
                <img src="{{ asset('storage/' . $post->image) }}" class="rounded " alt="{{ $post->title }}">
            </div>
            @endif
            {{-- condizione per stampare il valore corretto a seconda del booleano --}}
            @if ($post->published == '1')
            {{-- <h5>Pubblicato il {{$mytime}}</h5> Prova per inserire la data di pubblicazione (da fixare) --}}
            <h5>Pubblicato</h5>
            @else
            <h5>Non ancora pubblicato</h5>
            @endif
            <div>
                <h5>Tags</h5>
                <ul>
                    @foreach($post->tags as $item)
                    <li>{{$item->name}}</li>
                    @endforeach
                </ul>
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
    </div>
</div>
@endsection