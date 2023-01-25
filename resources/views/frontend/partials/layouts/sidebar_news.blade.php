<div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">

  <div class="sidebar ps-lg-4">

    <div class="sidebar-item search-form">
      <h3 class="sidebar-title">Search</h3>
      <form action="{{ route('reads.index') }}" method="GET" role="search" class="mt-3">
        <input type="text" name="search" placeholder="Search News..">
        <button type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End sidebar search formn-->

    @if($sidebar['categories']->count() > 0)
    <div class="sidebar-item categories">
      <h3 class="sidebar-title">Categories</h3>
      <ul class="mt-3">
        @foreach($sidebar['categories'] as $category)
        @if($category->news->count() > 0)
        <li><a href="{{ route('reads.category', $category->name) }}">{{ $category->name }}<span>({{$category->news->count()}})</span></a></li>
        @endif
        @endforeach
      </ul>
    </div><!-- End sidebar categories-->
    @endif
    
    @if($sidebar['posts']->count() >0)
    <div class="sidebar-item recent-posts">
      <h3 class="sidebar-title">Recent Posts</h3>
      <div class="mt-3">
        @foreach($sidebar['posts'] as $post)
        <div class="post-item mt-3">
          <img src="{{ asset('uploads/'. $post->thumbnail )}}" alt="" class="flex-shrink-0" style="width: 100px;height: 100px;object-fit:cover;">
          <div>
            <h4><a href="{{ Route('reads.show', $post->slug) }}">{{ $post->title }}</a></h4>
            <time datetime="">
                  @if($post->created_at->diffInDays() > 7)
                    {{ date("D d M Y", strtotime($post->created_at)) }}
                  @else
                  {{ $post->created_at->diffForHumans() }}
                  @endif
            </time>
          </div>
        </div><!-- End recent post item-->
        @endforeach
      </div>
    </div><!-- End sidebar recent posts-->
    @endif

    @if($sidebar['tags']->count() > 0)
    <div class="sidebar-item tags">
      <h3 class="sidebar-title">Tags</h3>
      <ul class="mt-3">
        @foreach($sidebar['tags'] as $tag)
        <li><a href="{{ route('reads.tag', $tag->name) }}">{{ $tag->name }}</a></li>
        @endforeach
      </ul>
    </div><!-- End sidebar tags-->
    @endif

  </div><!-- End Blog Sidebar -->

</div>