@extends('backend.partials.app', ['title' => __('Edit Data Users')])
@push('pluginscss')

@endpush
@section('content')
<div class="content-wrapper">

    @include('backend.partials.user.header', [
    'title' => __('Update User Data'),
    ])
    @component('backend.partials.cards',[
    'action' => route('users.update', $data->id),
    'route_back' => route("users.index"),
    'title' => __('Update Data'),
    'button' => 'Update Data',
    'method' => 'put',
    'type' => 'update',
    'enctype' => true
    ])
    @slot('body')
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}" required autocomplete="email" id="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @if(isset(Auth::user()->role) && Auth::user()->role === 0)
    <select class="form-select" name="category" id="categoryUpdate">
        <option disabled>-Select Role-</option>
        @foreach ($arrUserType as $status=>$value)
        <option @if($data->role == $value)
            selected="selected"
            @endif
            value="{{ $value }}">{{ $status }}</option>
        @endforeach
    </select>
    @endif
    <hr />
    <label for="password mb-3"><b>Request New Password</b></label>
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