@extends('backend.partials.app', ['title' => __('Create News')])
@push('css')
<link href="{{ asset('css/tagify.css') }}" rel="stylesheet">
<x-head.tinymce-config />
@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Create News'),
  ])
  @component('backend.partials.cards',[
  'action' => route("news.store"),
  'route_back' => route("news.index"),
  'method' => 'post',
  'type' => 'store',
  'enctype' => true
  ])
  @slot('body')
  <div class="mb-3">
    <label for="TitleNews" class="form-label"><b>Title News</b></label>
    <input type="text" class="form-control" id="titlenews" name="title" placeholder="Insert Title News">
    @error('title')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="TitleNews" class="form-label"><b>Category News</b></label>
    <select class="form-select" name="category_id" id="categoryUpdate">
      <option selected>Select Category</option>
      @foreach ($categories as $category)
      <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="mb-3">
    <div class="form-group">
      <div class="mb-3">
        <img id="preview-image-before-upload" src="{{ asset('backend') }}/images/headline.jpg" alt="preview image" style="max-height: 250px;">
      </div>
      <label><b>Thumbnail</b></label>
      <input type="file" name="thumbnail" class="file-upload-default" id="thumbnail">
      <div class="input-group col-xs-12">
        <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image" >
        <span class="input-group-append">
          <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
        </span>
      </div>
      @error('thumbnail')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="mb-3">
    <label for="TagNews" class="form-label"><b>Tags</b><span class="h6" style="color:red;">*maks 5 tags*</span></label>
    <input name="tags" id="tagsInput" class="form-control" placeholder="write some tags" value="">
    @if ($errors->has('tags'))
    <span class="text-danger">{{ $errors->first('tags') }}</span>
    @endif
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label"><b>Content News</b></label>
    <x-forms.tinymce-editor />
  </div>
  @endslot
  @endcomponent

</div>
@endsection

@push('js')
<script src="{{ asset('backend') }}/js/file-upload.js" ></script>
<script src="{{ asset('js/tagify.js') }}" rel="stylesheet"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
    $('#thumbnail').change(function() {
      let reader = new FileReader();
      reader.onload = (e) => {
        $('#preview-image-before-upload').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    });
  });

  var urlGetData = "{{ route('tags.suggest') }}";
  $.ajax({
    type: 'GET',
    url: urlGetData,
    dataType: 'json',
    success: function(data) {
      var suggestions = data;
      arrayList(suggestions);
    },
    async: false,
  });

  function arrayList(suggestions) {
        var input = document.querySelector('#tagsInput'),
        tagify = new Tagify(input, {
        whitelist: suggestions,
        maxTags: 5,
        dropdown: {
            maxItems: 10,          
            classname: "tags-look", 
            enabled: 0,            
            closeOnSelect: false 
        },
        });
    }
</script>
@endpush