<div class="d-flex">
  <div class="comment-img"><img src="{{ asset('frontend') }}/img/blog/comments-3.jpg" alt=""></div>
  <div>
    <h5><a href="">{{ $reply->name }}</a> 
      <a class="reply" data-parent="{{ $reply->id }}" data-news="{{ $data->id }}" data-level="{{ $reply->level }}">
        <i class="bi bi-reply-fill"></i> Reply
      </a>
    </h5>
    <time datetime="{{ $reply->created_at->diffForHumans() }}">
      @if($reply->created_at->diffInDays() > 3)
      {{ date("D d M Y", strtotime($reply->created_at)) }}
      @else
      {{ $reply->created_at->diffForHumans() }}
      @endif
    </time>
    <p> {{ $reply->content }} </p>
  </div>
</div>