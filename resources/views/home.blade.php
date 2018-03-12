@extends('layouts.app')

@section('content')
    @if(session('success'))
        <div class="callout success">
            {{session('success')}}
        </div>
    @endif
    <div class="small-12 column">
        @include('chusqers.newChusqer')
    </div>
    @forelse($chusqers as $chusqer)
        <div class="small-12 column">
            @include('chusqers.chusqer')
        </div>
    @empty
        <div class="row">
            <p>No hay mensajes para mostrar</p>
        </div>
    @endforelse

    <div class="text-center">
        {{ $chusqers->appends(request()->except('page'))->links() }}
    </div>
@endsection
