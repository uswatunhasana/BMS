<div class="row">
  <div class="col-md-12 {{ $class ?? '' }}">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">{{ $title }}</h3>
        @if (isset($description) && $description)
        <p class="mt-0 mb-5">{{ $description }}</p>
        @endif
      </div>
    </div>
  </div>
</div>