@extends('layouts.app')

@section('content')
    <h1>Likes de {{$user->slug}}</h1>
    @foreach($user->likes as $like)
        <div class="small-12 column">
            @include('chusqers.chusqer', ['chusqer' => $like->chusqer])
        </div>
    @endforeach
@endsection