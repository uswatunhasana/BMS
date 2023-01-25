@extends('backend.partials.app', ['title' => __('Update Category')])
@push('pluginscss')

@endpush
@section('content')
<div class="content-wrapper">

  @include('backend.partials.user.header', [
  'title' => __('Update Category Data'),
  ])
  @component('backend.partials.cards',[
  'action' => route('category.update', $data->id),
  'route_back' => route("category.index"),
  'title' => __('Update Data'),
  'button' => 'Update Data',
  'method' => 'put',
  'type' => 'update',
  'enctype' => true
  ])
  @slot('body')
  <div class="mb-3">
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
    <label for="nameCategor" class="form-label"><b>Category</b></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameCategory" value="{{ $data->name }}" name="name" >
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  @endslot
  @endcomponent

</div>
@endsection