<div class="card @isset($user) @if($user->id == $chusqer->user_id) mine @endif @endisset">
    <div class="card-divider">
        <p>Añadido por <a href="/{{ $chusqer->user->slug }}">{{ $chusqer->user->name }}</a> - <a href="{{ url('/') }}/chusqers/{{ $chusqer['id'] }}">Leer más</a></p>
    </div>
    <p class="chusqer-content">
        <img src="{{ $chusqer->image }}" alt="">{{ $chusqer->content }}
    </p>
    <p class="chusqer-hashtags text-right">
        @foreach($chusqer->hashtags as $hashtag)
            <a href="/hashtag/{{ $hashtag->slug }}"><span class="label label-primary">{{ $hashtag->slug }}</span></a>
        @endforeach
    </p>
    @if(session('success'))
        <div class="callout success">
            {{session('success')}}
        </div>
    @endif
    <div class="card-section">
    <a href="/chusqers/{{$chusqer->id}}/like" class="@auth{{\App\Like::hasUserLiked($chusqer)? "alert button" : "button"}}@endauth @guest button @endguest">@auth{{\App\Like::hasUserLiked($chusqer)? "No me gusta!" : "Me gusta!"}}@endauth @guest Me gusta! @endguest</a><a href="/{{$chusqer->id}}/likes">{{$chusqer->likes->count() == 0 ? '' : "Likes:" . $chusqer->likes->count()}}</a>
    @if(Auth::user() && Auth::user()->amI())
        @can('update', $chusqer)
            <a href="{{ Route('chusqers.edit', $chusqer) }}" class="button warning">Editar</a>
        @endcan
        @can('delete', $chusqer)
        <form action="{{ Route('chusqers.delete', $chusqer->id) }}" method="POST" id="chusqer-actions-buttons">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}

            <button type="submit" class="button alert">Borra</button>

        </form>
        @endcan
    </div>
    @endif
</div>