<div class="breadcrumbs d-flex align-items-center" style="background-image: url('{{ asset('frontend') }}/img/{{ isset($image) ? $image : '' }}');">
  <div class="container position-relative d-flex flex-column align-items-center">
    <h2>{{ isset($title) ? $title : '' }}</h2>

    <ol>
      <li><a href="{{ route('home.frontend') }}">Home</a></li>
      <li>{{ isset($title) ? $title : '' }}</li>
    </ol>

  </div>
</div><!-- End Breadcrumbs -->