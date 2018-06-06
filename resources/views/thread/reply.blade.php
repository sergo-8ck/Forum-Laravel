<div class="card my-2">
    <div class="card-header">
        <div class="level">
            <div class="flex">
                <a href="{{ route('profile', $reply->owner) }}" >
                    {{ $reply->owner->name }}
                </a> ответил {{ $reply->created_at->diffForHumans() }}
            </div>

            <div>
                <form method="POST" action="/replies/{{$reply->id}}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                       Навится ({{$reply->favorites_count}})
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>