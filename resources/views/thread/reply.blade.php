<div class="card my-2">
    <div class="card-header">
        <a href="">{{ $reply->owner->name }}</a> ответил
        {{ $reply->created_at->diffForHumans() }}
    </div>
    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>