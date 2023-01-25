<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">{{isset($title) ? $title : 'Add Data'}}</h4>
      <p class="card-description">
        {{isset($description) ? $description : ''}}
      </p>
      <form class="forms-sample" action="{{ isset($action) ? $action : '' }}" method="post" id="{{ isset($type) ? $type : store }}" @isset($enctype) enctype="multipart/form-data" @endisset>
        @csrf
        @method($method)
        <!-- Insert form cards -->
        @isset($body)
        {!! $body !!}
        @endisset
        <button type="submit" class="btn btn-primary mr-2" id="{{ isset($button) ? $button.'Button' : 'addButton'}}">{{ $button ?? 'Add Data' }}</button>
        <a class="btn btn-warning" href="{{ isset($route_back) ? $route_back : '' }}">Cancel</a>
      </form>
    </div>
  </div>
</div>