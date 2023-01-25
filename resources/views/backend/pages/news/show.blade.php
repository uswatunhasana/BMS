@extends('backend.partials.app', ['title' => __('Detail News')])
@push('css')
@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Detail News'),
  ])
  @component('backend.partials.cardshow',[
  'route_back' => route("news.index"),
  'title' => __(''),
  ])
  @slot('body')
  @if (!(empty($data)))
  <div class="mb-3">
    <label for="TitleNews" class="form-label"><b>Title News</b></label>
    <p class="h5">{{ $data->title }}</p>
    <!-- <input type="text" class="form-control" id="titlenews" name="title" value=""> -->
  </div>
  <hr class="my-4" />
  <div class="mb-3">
    <label for="TitleNews" class="form-label"><b>Category News</b></label>
    <p class="h5">{{ $data->category->name }}</p>
  </div>
  <hr class="my-4" />
  <div class="mb-3">
    <div class="form-group">
      <label for="TagNews" class="form-label"><b>Thumbnail</b></label>
      <div class="mb-3">
        <img id="preview-image-before-upload" src="{{ asset('uploads/'. $data->thumbnail )}}" alt="preview image" style="max-height: 250px;">
      </div>
    </div>
  </div>
  <hr class="my-4" />
  <div class="mb-3">
    <label for="TagNews" class="form-label"><b>Tags</b></label>
    @foreach($data->tags as $tag)
    <span class="badge badge-info">{{ $tag->name }}</span>
    @endforeach
  </div>
  <hr class="my-4" />
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label"><b>Content News</b></label>
    <div class="entry-content">
      <div>{!!$data->content!!}</div>
    </div>
  </div>
  @endslot
  @else
  <h1>Tidak Ada Data </h1>
  @endif
  @endcomponent

</div>
@endsection
