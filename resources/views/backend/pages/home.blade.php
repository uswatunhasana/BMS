@extends('backend.partials.app', ['title' => __('Home')])
@push('pluginscss')
<link rel="stylesheet" href="{{ asset('backend') }}/vendors/ti-icons/css/themify-icons.css">
@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Welcome') . ' '. auth()->user()->name . __(' !!'),
  'class' => 'grid-margin'
  ])
  <div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card tale-bg">
        <div class="card-people mt-auto">
          <img src="{{ asset('backend') }}/images/dashboard/people.svg" alt="people">
          <div class="weather-info">
            <div class="d-flex">
              <div>       
              </div>
              <div class="ml-2">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @if(isset(Auth::user()->role))
    <div class="col-md-6 grid-margin transparent">
      <div class="row">
      @if(Auth::user()->role == 0)
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Admins Blog</p>
              <p class="fs-30 mb-2">{{ $adminCount }}</p>
            </div>
          </div>
        </div>
      @endif
      @if(Auth::user()->role < 2)
        <div class="col-md-6 mb-4 stretch-card transparent">
          <div class="card card-dark-blue">
            <div class="card-body">
              <p class="mb-4">Writer Count</p>
              <p class="fs-30 mb-2">{{ $writerCount }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="row">
        <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Category Count</p>
              <p class="fs-30 mb-2">{{ $categories->count() }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 stretch-card transparent">
          <div class="card card-light-danger">
            <div class="card-body">
              <p class="mb-4">News Count</p>
              <p class="fs-30 mb-2">{{ $news->count() }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
@push('pluginjs')

@endpush

@push('js')
<!-- <script src="{{ asset('backend') }}/js/dashboard.js"></script> -->
@endpush