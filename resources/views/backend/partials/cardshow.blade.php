<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">{{isset($title) ? $title : 'Add Data'}}</h4>
      <p class="card-description">
        {{isset($description) ? $description : ''}}
      </p>
        @isset($body)
        {!! $body !!}
        @endisset
        <a class="btn btn-warning" href="{{ isset($route_back) ? $route_back : '' }}">Back</a>
    </div>
  </div>
</div>