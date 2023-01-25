@extends('frontend.partials.app',['title' => __('News Details')])

@section('content')
@include('frontend.partials.layouts.header', [
'title' => __('News Detail'),
'image' => __('blog-header.jpg'),
])
<!-- ======= Header ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
      <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
        @if ($data->count() > 0)
        <article class="blog-details">
          <div class="post-img">
            <img src="{{ asset('uploads/'. $data->thumbnail )}}" alt="" class="img-fluid">
          </div>
          <h2 class="title">{{ $data->title }}</h2>
          <div class="meta-top">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ Route('reads.show', $data->slug) }}">{{ $data?->user?->name ?: 'anonymous' }}</a></li>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ Route('reads.show', $data->slug) }}"><time datetime="">{{ date("D d M Y", strtotime($data->created_at)) }}</time></a></li>
            </ul>
          </div><!-- End meta top -->
          <div class="content">
            {!!$data->content!!}
          </div><!-- End post content -->
          <div class="meta-bottom">
            <i class="bi bi-folder"></i>
            <ul class="cats">
              <li><a href="{{ route('reads.category', $data->category->name) }}">{{ $data->category->name }}</a></li>
            </ul>
            <i class="bi bi-tags"></i>
            <ul class="tags">
              @foreach($data->tags as $tag)
              <li><a href="{{ route('reads.tag', $tag->name) }}">{{ $tag->name }}</a></li>
              @endforeach
            </ul>
          </div><!-- End meta bottom -->
          <div class="comments">
            <h4 class="comments-count">{{ $data->comments->count() }} Comments</h4>
            @include('frontend.comments.form-comment', [
            'news_id' => $data->id,
            'level' => 0])
            @if($data->comments->count() > 0)
            @include('frontend.comments.comment', ['comments' => $data->comments, 'news_id' => $data->news_id])
            @endif
          </div>
      </div>
      </article><!-- End blog post -->
      @else
      @include('frontend.partials.error.404_list')
      @endif
      @include('frontend.partials.layouts.sidebar_news')
    </div>
  </div>
  </div>
</section><!-- End Blog Details Section -->

@endsection

@push('js')
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
<script src="{{ asset('js/jquery/jquery.min.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.reply').one("click",function(){
    let route = $(this).data('route');
    let parent_id = $(this).data('parent');
    let news_id = $(this).data('news');
    let level = $(this).data('level') + 1;
    let user = $(this).data('user');
    var x = $(this).data('id');
    console.log(parent_id, news_id, level, user, x);
    if (user === '') {
      var htmlForm = '<div id="comment-reply-' + level + '" class="comment comment-reply"><div class="reply-form"><h4>Leave a Reply</h4><form action="'+ route +'" method="POST">@csrf @method("post")<div class="row"><div class="col form-group"><input name="name" type="text" class="form-control" placeholder="Insert Your Name"></div></div><div class="row"><div class="col form-group"><input type="hidden" name="parent_id" value="' + parent_id + '"/><input type="hidden" name="news_id" value="' +
        news_id + '"/><input type="hidden" name="level" value="' + level + '"/><textarea name="content" class="form-control" placeholder="Your Comment*"></textarea></div></div><button type="submit" class="btn btn-primary add-post">Post Comment</button></div></form></div>';
    } else {
      var htmlForm = '<div id="comment-reply-' + level + '" class="comment comment-reply"><div class="reply-form"><h4>Leave a Reply</h4><form action="'+ route +'"method="POST">@csrf @method("post")<div class="row"><div class="col form-group"><input type="hidden" name="parent_id" value="' + parent_id + '"/><input type="hidden" name="news_id" value="' +
        news_id + '"/><input type="hidden" name="level" value="' + level + '"/><textarea name="content" class="form-control" placeholder="Your Comment*"></textarea></div></div><button type="submit" class="btn btn-primary add-post">Post Comment</button></div></form></div>';
    }
    $(".reply-user-" + x).append(htmlForm);
  });
  });



</script>

@endpush