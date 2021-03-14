<div class="row">
    <div class="col-md-2 text-center">
        <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}"
            class="img-circle">

    </div>
    <div class="col-md-6">
        <h5 class="media-heading">{{ $message->user->name }}</h5>
        <p>{{ $message->body }}</p>
    </div>
</div>
<div class="text-muted">
    <small>Posted {{ $message->created_at->diffForHumans() }}</small>
</div>
