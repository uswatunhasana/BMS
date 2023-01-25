@extends('backend.partials.app',['title' => __('Register')])

@push('css')
<link rel="stylesheet" href="{{ asset('backend') }}/auth/css/jquery.passwordRequirements.css" />
@endpush
@section('content')
<div class="content-wrapper d-flex align-items-center auth px-0">
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    <img src="{{ asset('backend') }}/images/logo.svg" alt="logo">
                </div>
                <h4><b>Register an Account</b></h4>
                <form class="pt-3" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input id="name" type="text" placeholder="Full Name" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="email" type="email" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge" id="show_hide_password">
                            <input id="password" type="password" placeholder="Password" class="pr-password form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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
                        <div class="input-group input-group-merge" id="show_hide_confirm_password">
                            <input id="password-confirm" type="password" placeholder="Confirm Password" class="form-control form-control-lg confirm_password" name="password_confirmation" required autocomplete="new-password">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a></span>
                            </div>
                            <span id='message'></span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register Now</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                        Do you have an account before?<a href="{{ route('login')}}" class="text-primary"> Yes, I Have an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('pluginjs')

@endpush

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
</script>

@endpush