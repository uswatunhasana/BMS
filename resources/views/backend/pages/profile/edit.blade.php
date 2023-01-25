@extends('backend.partials.app', ['title' => __('Update Profile')])
@push('pluginscss')

@endpush
@section('content')
<div class="content-wrapper">

  @include('backend.partials.user.header', [
  'title' => __('Update Profile'),
  ])

  @component('backend.partials.cards',[
  'action' => route('profile.update', $data->id),
  'route_back' => route("home"),
  'title' => __('Information User Data'),
  'button' => 'Update Data',
  'method' => 'put',
  'type' => 'update',
  'enctype' => true
  ])
  @slot('body')
  <div class="mb-3">
    <label for="name" class="form-label"><b>Full Name</b></label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameProfile" value="{{ $data->name }}" name="name">
    @error('name')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="mb-3">
    <label for="name" class="form-label"><b>Email</b></label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailProfile" value="{{ $data->email }}" name="email">
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  @endslot
  @endcomponent

  <hr class="my-4" />
  @component('backend.partials.cards',[
  'action' => route('profile.password'),
  'route_back' => route("home"),
  'title' => __('Update Password User'),
  'button' => 'Update Data',
  'method' => 'put',
  'type' => 'update',
  'enctype' => true
  ])
  @slot('body')
  <div class="mb-3">
    <label for="name" class="form-label"><b>Old Password</b></label>
    <div class="input-group input-group-merge" id="show_hide_password">
      <input id="old_password" type="password" placeholder="Old Password" class="pr-password form-control form-control-lg @error('old_password') is-invalid @enderror" name="old_password">
      <div class="input-group-append">
        <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
      </div>
    </div>
    @error('old_password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
  <div class="form-group">
    <label for="password">New Password</label>
    <div class="input-group input-group-merge" id="show_hide_password">
      <input id="password" type="password" placeholder="Password" class="pr-password form-control form-control-lg @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
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
    <label for="confirm_password">Confirm New Password</label>
    <div class="input-group input-group-merge" id="show_hide_confirm_password">
      <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control form-control-lg confirm_password" name="password_confirmation" autocomplete="new-password">
      <div class="input-group-append">
        <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
      </div>
      <span id='message'></span>
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

  // $('#password, #confirm_password').on('keyup', function() {
  //   if ($('#password').val() == $('#confirm_password').val()) {
  //     $('#message').html('Confirm Passsword is Matching').css('color', 'green');
  //   } else
  //     $('#message').html('Confirm Passsword Not Matching').css('color', 'red');
  // });
</script>

@endpush