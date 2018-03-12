@extends('layouts.app')

@section('content')
    <h1>Usuarios que han dado me gusta al chusqer</h1>
    @foreach($chusqer->likes as $like)
        <div>
            <a href="/{{$like->user->slug}}">{{$like->user->name}}</a>
        </div>
    @endforeach
@endsection