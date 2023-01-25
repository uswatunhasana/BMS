@extends('backend.partials.app', ['title' => __('Add Category')])
@push('pluginscss')

@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Add Category'),
  ])
  @component('backend.partials.cards',[
  'action' => route("category.store"),
  'route_back' => route("category.index"),
  'method' => 'post',
  'type' => 'store',
  'enctype' => true
  ])
  @slot('body')
  <div class="mb-3">
    <label for="nameCategor" class="form-label"><b>Category</b></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameCategory" value="{{ old('title') }}" name="name" placeholder="Insert New Category">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  @endslot
  @endcomponent

</div>
@endsection