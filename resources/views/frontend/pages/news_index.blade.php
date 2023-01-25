@extends('frontend.partials.app',['title' => __('News')])

@section('content')
@include('frontend.partials.layouts.header', [
    'title' => __('News'),
    'image' => __('blog-header.jpg'),
    ])
<!-- ======= Header ======= -->
<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">
    <div class="row g-5">
    @if ( $datas->count() > 0)
    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
      <div class="row gy-5 posts-list">
        @foreach ($datas as $data)
        <div class="col-lg-6">
          <article class="d-flex flex-column">
            <div class="post-img">
              <img src="{{ asset('uploads/'. $data->thumbnail )}}" alt="" class="img-fluid">
            </div>
            <h2 class="title">
              <a href="{{ Route('reads.show', $data->slug) }}">{{ $data->title }}</a>
            </h2>
            <div class="meta-top">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ Route('reads.show', $data->slug) }}">{{ $data?->user?->name ?: 'anonymous' }}</a></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ Route('reads.show', $data->slug) }}">
                  <time datetime="">
                  @if($data->created_at->diffInDays() > 7)
                    {{ date("D d M Y", strtotime($data->created_at)) }}
                  @else
                  {{ $data->created_at->diffForHumans() }}
                  @endif
                  </time></a>
                </li>
              </ul>
            </div>
            <div class="content">
            <p>{{ strip_tags($data->content) }}</p>
            </div>
            <div class="read-more mt-auto align-self-end">
              <a href="{{ Route('reads.show', $data->slug) }}">Read More <i class="bi bi-arrow-right"></i></a>
            </div>
          </article>
        </div>
        @endforeach
      </div>
      <div class="blog-pagination">
      {{ $datas->appends($_GET)->links('frontend.partials.layouts.pagination')}}
      </div>
    </div>
    @else 
    @include('frontend.partials.error.404_list')
    @endif
    @include('frontend.partials.layouts.sidebar_news')
    </div>
  </div>
</section><!-- End Blog Section -->

@endsection