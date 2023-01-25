@foreach($comments as $comment)
@if($comment->parent_id == null)
<div id="comment-2" class="comment">
@else
<div id="comment-reply-1" class="comment comment-reply">
@endif
  <div class="d-flex">
    <div class="comment-img"><img src="{{ asset('frontend') }}/img/blog/comments-2.jpg" alt=""></div>
    <div>
      <h5><a href="">{{ $comment->name }}</a>
      @if($comment->level <= 1)
        <a class="reply" data-id="{{ $comment->id }}" data-route="{{ route('comment.post') }}" data-user="{{ auth()?->user()?->id ?: '' }}" data-parent="{{ $comment->id }}" data-news="{{ $data->id }}" data-level="{{ $comment->level }}">
          <i class="bi bi-reply-fill"></i> Reply</a>
      @endif
      </h5>
      <time datetime="{{ $comment->created_at->diffForHumans() }}">
        @if($comment->created_at->diffInDays() > 3)
        {{ date("D d M Y", strtotime($comment->created_at)) }}
        @else
        {{ $comment->created_at->diffForHumans() }}
        @endif
      </time>
      <p> {{ $comment->content }} </p>
    </div>
  </div>
  <div class="reply-user-{{ $comment->id }}"  id="replyUser">
  </div>
  @if($comment->replies->count() > 0)
  <div id="comment-reply-{{ $comment->level }}" class="comment comment-reply">
  @include('frontend.comments.comment', ['comments' => $comment->replies])
  </div>
  @endif
</div>
@endforeach