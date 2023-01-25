@extends('frontend.partials.app',['title' => __('Home')])

@section('content')
<!-- ======= Header ======= -->
<!-- ======= Hero Section ======= -->
@if(isset(Auth::user()->role))

@include('frontend.partials.components.hero',[
'description' => __('Lets create a news'),
'action_home' => route("news.create"),
'button_action' => __('Create News'),
])
@else
@include('frontend.partials.components.hero',[
'action_home' => route("register"),
])
@endif

<main id="main">
  <section id="recent-posts" data-count="{{ $posts }}" class="recent-posts">
    <div class="container aos-init aos-animate" data-aos="fade-up">
      <div class="section-header">
        <h2>Recent News Posts</h2>
      </div>
      <div class="row gy-5">
        @foreach($posts as $post)
        <div class="col-xl-3 col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
          <div class="post-box">
            <div class="post-img">
              <img src="{{ asset('uploads/'. $post->thumbnail )}}" class="img-fluid" alt="" width="200px" height="200px" style="object-fit:cover;">
            </div>
            <div class="meta">
              <span class="post-date">
                  @if($post->created_at->diffInDays() > 7)
                    {{ date("D d M Y", strtotime($post->created_at)) }}
                  @else
                  {{ $post->created_at->diffForHumans() }}
                  @endif
              </span>
              <span class="post-author"> | {{ $post?->user?->name ?: 'anonymous' }}</span>
            </div>
            <h3 class="post-title">{{ $post->title }}</h3>
            <div class="content">
              <p>{{ strip_tags($post->content) }}</p>
            </div>
            <a href="{{ Route('reads.show', $post->slug) }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>
</main><!-- End #main -->

@endsection