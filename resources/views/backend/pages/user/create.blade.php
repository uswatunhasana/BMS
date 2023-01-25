@extends('backend.partials.app', ['title' => __('Create User')])
@push('css')
<link rel="stylesheet" href="{{ asset('backend') }}/auth/css/jquery.passwordRequirements.css" />
@endpush
@section('content')
<div class="content-wrapper">
  @include('backend.partials.user.header', [
  'title' => __('Add Users Data'),
  ])
  @component('backend.partials.cards',[
  'action' => route("users.store"),
  'route_back' => route("users.index"),
  'method' => 'post',
  'type' => 'store',
  'enctype' => true
  ])
  @slot('body')
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" id="email" placeholder="Email">
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="role">Role</label>
    @if(isset(Auth::user()->role) && Auth::user()->role === 1)
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="role" placeholder="Writer" name="role" value="2" required autocomplete="name" autofocus readonly>
    @else
    <select class="form-select @error('role') is-invalid @enderror" name="role" id="roleCreate">
      <option disabled selected>- Select Role -</option>
      @foreach ($arrUserType as $status=>$value)
      <option value="{{ $value }}">{{ $status }}</option>
      @endforeach
    </select>
    @endif
    @error('role')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <div class="input-group input-group-merge" id="show_hide_password">
      <input id="password" type="password" id="password" placeholder="Password" class="pr-password form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
      <div class="input-group-append">
        <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
      </div>
    </div>
    @error('password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="confirm_password">Confirm Password</label>
    <div class="input-group input-group-merge" id="show_hide_confirm_password">
      <input id="password-confirm" id="confirm_password" type="password" placeholder="Confirm Password" class="form-control form-control-lg confirm_password" name="password_confirmation" required autocomplete="new-password">
      <div class="input-group-append">
        <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
      </div>
      <span class="invalid-feedback" role="alert">
        <strong id="message"></strong>
      </span>
    </div>
  </div>
  @endslot
  @endcomponent

</div>
@endsection

@push('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!-- Password Requirements JS -->
<script src="{{ asset('backend') }}/auth/js/jquery.passwordRequirements.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
      event.preventDefault();
      if ($('#show_hide_password input').attr("type") == "text") {
        $('#show_hide_password input').attr('type', 'password');
        $('#show_hide_password i').addClass("fa-eye-slash");
        $('#show_hide_password i').removeClass("fa-eye");
      } else if ($('#show_hide_password input').attr("type") == "password") {
        $('#show_hide_password input').attr('type', 'text');
        $('#show_hide_password i').removeClass("fa-eye-slash");
        $('#show_hide_password i').addClass("fa-eye");
      }
    });
  });
  $(document).ready(function() {
    $("#show_hide_confirm_password a").on('click', function(event) {
      event.preventDefault();
      if ($('#show_hide_confirm_password input').attr("type") == "text") {
        $('#show_hide_confirm_password input').attr('type', 'password');
        $('#show_hide_confirm_password i').addClass("fa-eye-slash");
        $('#show_hide_confirm_password i').removeClass("fa-eye");
      } else if ($('#show_hide_confirm_password input').attr("type") == "password") {
        $('#show_hide_confirm_password input').attr('type', 'text');
        $('#show_hide_confirm_password i').removeClass("fa-eye-slash");
        $('#show_hide_confirm_password i').addClass("fa-eye");
      }
    });
  });
  $(document).ready(function() {
    $(".pr-password").passwordRequirements();
  });

  $('#password, #confirm_password').on('keyup', function() {
    if ($('#password').val() == $('#confirm_password').val()) {
      $('#message').html('Confirm Passsword is Matching').css('color', 'green');
    } else
      $('#message').html('Confirm Passsword Not Matching').css('color', 'red');
  });
</script>

@endpush