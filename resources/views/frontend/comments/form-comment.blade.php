<div class="reply-form">
  @if($level == 0)
  <h4>Leave a Comment</h4>
  @else
  <h4>Leave a Reply</h4>
  @endif
  <form action="{{ route('comment.post') }}" method="POST">
    @csrf
    @method('post')
    @guest
    <div class="row">
      <div class="col form-group">
        <input name="name" type="text" class="form-control" placeholder="Insert Your Name">
      </div>
    </div>
    @endguest
    <div class="row">
      <div class="col form-group">
        <input type="hidden" name="parent_id" value="{{ isset($parent_id) ? $parent_id : '' }}" />
        <input type="hidden" name="news_id" value="{{ isset($news_id) ? $news_id : '' }}" />
        <input type="hidden" name="level" value="{{ isset($level) ? $level : '' }}" />
        <textarea name="content" class="form-control" placeholder="Your Comment*"></textarea>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Post Comment</button>
    @if($level > 0)
    <button type="" class="btn btn-primary" id="close-{{ $level }}">Close</button>
    @endif
</div>
</form>