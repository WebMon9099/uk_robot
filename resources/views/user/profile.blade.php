@extends('layout.app')
@section('main_section')
<style>
@media (max-width: 768px) {
    .btn {
        margin-bottom: 10px;
    }
}

.btn {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.5;
    display: inline-block;
    padding: .625rem 1.25rem;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    border: 1px solid transparent;
    border-radius: .375rem;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    border: 1px solid rgba(0, 0, 0, .05);
    border-radius: .375rem;
    background-color: #fff;
    background-clip: border-box;
}

.card>hr {
    margin-right: 0;
    margin-left: 0;
}

.card-body {
    padding: 1.5rem;
    flex: 1 1 auto;
}

.card-header {
    margin-bottom: 0;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, .05);
    background-color: #fff;
}

.card-header:first-child {
    border-radius: calc(.375rem - 1px) calc(.375rem - 1px) 0 0;
}

.card-profile-image {
    position: relative;
}

.card-profile-image img {
    position: absolute;
    left: 50%;
    max-width: 180px;
    max-height: 140px;
    height: 140px;
    transition: all .15s ease;
    transform: translate(-50%, -30%);
    border-radius: .375rem;
}

.card-profile-image img:hover {
    transform: translate(-50%, -33%);
}

.card-profile-stats {
    padding: 1rem 0;
}

.card-profile-stats>div {
    margin-right: 1rem;
    padding: .875rem;
    text-align: center;
}

.card-profile-stats>div:last-child {
    margin-right: 0;
}

.card-profile-stats>div .heading {
    font-size: 1.1rem;
    font-weight: bold;
    display: block;
}

.card-profile-stats>div .description {
    font-size: .875rem;
    color: #adb5bd;
}

.shadow,
.card-profile-image img {
    box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15) !important;
}

.card-profile-image img {
    transition: all 0.3s ease;
    border: 5px solid transparent;
    /* Prevent size change */
}

.card-profile-image img:hover {
    /* transform: scale(1.05); */
    /* Slightly enlarge */
    border: 5px solid #007bff;
    /* Border color on hover */
}

.card-profile-image {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
<div class="position-relative text-white" style="background-color: #25355c;">
    @include('components.navbar')
</div>

<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center"
    style="min-height: 600px; background-image: url('{{ Auth::user()->image ? asset('images/profile_image/' . Auth::user()->image) : asset('path/to/default/image.jpg') }}'); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row ms-5">
            <!-- Added Bootstrap class for margin start -->
            <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hello {{ Auth::user()->name }}</h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made
                    with your order and manage your orders or order status</p>
                <a href="#!" class="btn btn-info">Edit profile</a>
            </div>
        </div>
    </div>
</div>


<!-- Page content -->
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
            <!-- <div class="card card-profile shadow border-0 rounded-lg">
                <div class="row justify-content-center">
                    <div class="col-lg-3 order-lg-2">
                        <div class="card-profile-image text-center">
                            <a href="#">
                                @if (Auth::user()->image != '')
                                <img src="{{ asset('images/profile_image/' . Auth::user()->image) }}" alt="avatar"
                                    class="rounded-circle img-fluid border border-primary"
                                    style="width: 150px; height: 150px;">
                                @else
                                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"
                                    class="rounded-circle img-fluid border border-primary"
                                    style="width: 150px; height: 150px;">
                                @endif
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0 pt-md-4 text-center">
                    <h3 class="text-primary font-weight-bold mb-1">
                        {{ Auth::user()->name }}
                    </h3>
                    <div class="h5 font-weight-300 text-muted mb-2">
                        <i class="ni ni-email-83 mr-2"></i>{{ Auth::user()->email }}
                    </div>
                    <div class="h5 font-weight-300 text-muted mb-2">
                        <i class="ni ni-bag-17 mr-2"></i>{{ $user->order_type }}
                    </div>

                    <div class="d-flex justify-content-center mb-3">
                        <button data-bs-toggle="modal" data-bs-target="#profileModal" type="button"
                            class="btn btn-success mr-2">Change Profile Picture</button>
                        <a data-bs-toggle="modal" data-bs-target="#passwordModal" type="button"
                            class="btn btn-secondary">Change Password</a>
                    </div>
                </div>
            </div> -->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-12">
                        <div class="our-team">
                            <div class="picture">
                                <a href="#">
                                    @if (Auth::user()->image != '')
                                    <img src="{{ asset('images/profile_image/' . Auth::user()->image) }}" alt="avatar"
                                        class="img-fluid">
                                    @else
                                    <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="img-fluid">
                                    @endif
                                </a>

                            </div>
                            <div class="team-content">
                                <h3 class="name">{{ Auth::user()->name }}</h3>
                                <h4 class="title">{{ $user->order_type }}</h4>
                            </div>
                            <div class="d-flex justify-content-center mb-3">
                                <button data-bs-toggle="modal" data-bs-target="#profileModal" type="button"
                                    class="btn btn-success mr-2">Change Profile Picture</button>
                                <a data-bs-toggle="modal" data-bs-target="#passwordModal" type="button"
                                    class="btn btn-secondary">Change Password</a>
                            </div>
                            <ul class="social">
                                <li><a href="" class="fa fa-envelope" aria-hidden="true"> {{ Auth::user()->email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card shadow mt-2">
                <div class="card-header">
                    <h1>My Orders</h1>
                    <sapn><a href="{{route('userOrderList')}}">ORDER LIST</a></sapn>
                </div>

            </div> -->
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow-md border-0 rounded-lg">
                            <div class="card-body text-center">
                                <div class="icon-container mb-3">
                                    <i class="fas fa-shopping-cart fa-2x text-primary"></i> <!-- Order icon -->
                                </div>
                                <h5 class="card-title text-dark">Order Summary</h5>
                                <p class="card-text">View your recent orders and manage your purchases.</p>
                                <a href="{{route('userOrderList')}}" class="btn btn-primary">Go to Order List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="col-xl-8 order-xl-1">

            <div class="card  shadow">
                <form id="updateProfile">
                    @csrf
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">My account</h3>
                            </div>
                            <div class="col-4 text-right">
                                {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a> <a href="#!"
                                    class="btn btn-sm btn-primary">Settings</a> --}}
                                <button class="btn btn-primary" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <h6 class="heading-small text-muted mb-4">User information</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    {{-- <div class="form-group focused">
                                        <label class="form-control-label" for="name">Username</label>
                                        <input type="text" id="name" name="name"
                                            class="form-control form-control-alternative" placeholder="First Name"
                                            value="{{ old('name', Auth::user()->name) }}">
                                    <p class="text-danger"></p>
                                </div> --}}
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-email">Email
                                        address</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control form-control-alternative" placeholder="jesse@example.com"
                                        value="{{ old('email', Auth::user()->email) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-first-name">First
                                        name</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control form-control-alternative" placeholder="First Name"
                                        value="{{ old('name', Auth::user()->name) }}">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group focused">
                                    <label for="phone" class="form-label">Mobile Number</label>
                                    <input type="text" id="phone" name="phone"
                                        class="form-control form-control-alternative" placeholder="Enter Phone Number"
                                        value="{{ old('phone', Auth::user()->phone) }}">
                                    <p class="text-danger"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-address">Address</label>
                                    <input type="text" id="address1" name="address"
                                        class="form-control form-control-alternative" placeholder="Enter Address Line 1"
                                        value="{{ $user->details->address ?? old('address') }}">

                                    <p class="text-danger"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-city">State</label>
                                    <input type="text" id="state" name="state"
                                        class="form-control form-control-alternative" placeholder="Enter State"
                                        value="{{ $user->details->state ?? old('state') }}">
                                    <p class="text-danger"></p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group focused">
                                    <label class="form-control-label" for="input-country">Country</label>
                                    <input type="text" id="country" name="country"
                                        class="form-control form-control-alternative" placeholder="Enter Country"
                                        value="{{ $user->details->country ?? old('country') }}">
                                    <p class="text-danger"></p>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-country">Postal
                                        code</label>
                                    <input type="text" id="postcode" name="postcode"
                                        class="form-control form-control-alternative" placeholder="Enter Postcode"
                                        value="{{ $user->details->postcode ?? old('postcode')}}">
                                    <p class="text-danger"></p>

                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    {{-- <h6 class="heading-small text-muted mb-4">About me</h6>
                        <div class="pl-lg-4">
                            <div class="form-group focused">
                                <label>About Me</label>
                                <textarea rows="4" class="form-control form-control-alternative"
                                    placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                            </div>
                        </div> --}}

            </div>
            </form>
        </div>
    </div>
</div>

</div>

<!-- Pay Later Request Section -->
{{-- <h3>Request Pay Later Option</h3>
@if (auth()->user()->pay_later_enabled)
<p>Your Pay Later option is enabled. You can disable it if needed.</p>
<form action="{{ route('paylater.toggle') }}" method="POST">
@csrf
<input type="hidden" name="pay_later_enabled" value="0">
<button type="submit" class="btn btn-danger">Disable Pay Later</button>
</form>
@elseif(auth()->user()->pay_later_request_status === 'pending')
<p>Your Pay Later request is under review.</p>
@elseif(auth()->user()->pay_later_request_status === 'approved')
<p>Your request was approved. Enable Pay Later to use it.</p>
<form action="{{ route('paylater.toggle') }}" method="POST">
    @csrf
    <input type="hidden" name="pay_later_enabled" value="1">
    <button type="submit" class="btn btn-success">Enable Pay Later</button>
</form>
@else
<!-- Request Form -->
<form action="" method="POST">
    @csrf
    <label for="account_details">Account Details for Pay Later:</label>
    <textarea name="account_details" id="account_details" required></textarea>

    <label for="reason">Why do you want Pay Later?</label>
    <textarea name="reason" id="reason" required></textarea>

    <button type="submit" class="btn btn-primary">Submit Request</button>
</form>
@endif --}}

<!-- update password modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pb-0" id="passwordModalLabel">Change password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form name="passwordUpdate" id="passwordUpdate" method="post" action="{{ route('password.update') }}">
                    @csrf
                    <!-- <form name="passwordUpdate" id="passwordUpdate" method="post" action=""> -->
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Old Password</label>
                        <input type="text" class="form-control" id="old_password" name="old_password">
                        <p class="text-danger" id="oldPassword_error"></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">New Password</label>
                        <input type="text" class="form-control" id="new_password" name="new_password">
                        <p class="text-danger" id="newPassword_error"></p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" id="confirm_password" name="confirm_password">
                        <p class="text-danger" id="confirmPassword_error"></p>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-3">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end update -->
{{-- <div class="container mt-5 mb-5">
    <div class="row">
        <!-- Profile Sidebar -->
        @include('user.sidebar')

        <!-- Profile Form -->
        <div class="col-md-8 col-lg-9">
            @include('Comman.message')
            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-body">
                    <h4 class="mb-4">Profile Settings</h4>
                    <form action="{{ route('user.profile.update') }}" method="POST">
@csrf
<div class="row">
    <div class="col-md-12 mb-3">
        <label for="name" class="form-label">User Name</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="First Name"
            value="{{ old('name', Auth::user()->name) }}">
        <p class="text-danger"></p>
    </div>
    {{-- <div class="col-md-6 mb-3">
                                <label for="surname" class="form-label">Last Name</label>
                                <input type="text" id="surname" name="surname" class="form-control"
                                    placeholder="Last Name" value="{{ old('surname', Auth::user()->surname) }}">
    <p class="text-danger"></p>
</div> --}}
</div>
{{-- <div class="mb-3">
                            <label for="phone" class="form-label">Mobile Number</label>
                            <input type="text" id="phone" name="phone" class="form-control"
                                placeholder="Enter Phone Number" value="{{ old('phone', Auth::user()->phone) }}">
<p class="text-danger"></p>
</div>
<div class="mb-3">
    <label for="address" class="form-label">Address Line 1</label>
    <input type="text" id="address1" name="address" class="form-control" placeholder="Enter Address Line 1"
        value="{{ old('address', $userDeatails->address) }}">
    <p class="text-danger"></p>
</div> --}}
{{-- <div class="mb-3">
                            <label for="address2" class="form-label">Address Line 2</label>
                            <input type="text" id="address2" name="address2" class="form-control"
                                placeholder="Enter Address Line 2"
                                value="{{ old('address2', Auth::user()->address2) }}">
</div> --}}
{{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="postcode" class="form-label">Postcode</label>
                                <input type="text" id="postcode" name="postcode" class="form-control"
                                    placeholder="Enter Postcode" value="{{ old('postcode', $userDeatails->postcode) }}">
<p class="text-danger"></p>
</div>
<div class="col-md-6 mb-3">
    <label for="state" class="form-label">State</label>
    <input type="text" id="state" name="state" class="form-control" placeholder="Enter State"
        value="{{ old('state', $userDeatails->state) }}">
    <p class="text-danger"></p>
</div>
</div> --}}
{{-- <div class="mb-3">
                            <label for="country" class="form-label">Country</label>
                            <input type="text" id="country" name="country" class="form-control"
                                placeholder="Enter Country" value="{{ old('country', $userDeatails->country) }}">
<p class="text-danger"></p>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email ID</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="Enter Email ID"
        value="{{ old('email', Auth::user()->email) }}">
    <p class="text-danger"></p>
</div>
<div class="text-center">
    <button class="btn btn-primary" type="submit">Save Profile</button>
</div>
</form>
</div>
</div>


</div>

</div>
</div> --}}
@include('components.news-letter')
@include('components.contact-us')




<!-- Header -->
@endsection

@section('customJs')
<script>
$("#updateProfile").submit(function(e) {
    e.preventDefault();
    var updateUserProfileUrl = @json(route('user.profile.update'));
    $.ajax({
        url: updateUserProfileUrl,
        type: 'PUT',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(response) {
            if (response.error) {
                var error = response.error;
                // Clear previous errors
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').html('');

                if (error.name) {
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback')
                        .html(error.name);
                }
                if (error.email) {
                    $("#email").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.email);
                }
                if (error.phone) {
                    $("#phone").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.phone);
                }
                if (error.address1) {
                    $("#address1").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.address1);
                }
                if (error.postcode) {
                    $("#postcode").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.postcode);
                }
                if (error.state) {
                    $("#state").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.state);
                }
                if (error.country) {
                    $("#country").addClass('is-invalid').siblings('p').addClass(
                        'invalid-feedback').html(error.country);
                }
            } else {
                window.location.href = "{{ route('user.profile.update') }}";
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
</script>
@endsection
<style>
@-ms-viewport {
    width: device-width;
}

figcaption,
header,
main,
nav,
section {
    display: block;
}

[tabindex='-1']:focus {
    outline: 0 !important;
}

hr {
    overflow: visible;
    box-sizing: content-box;
    height: 0;
}

h1,
h3,
h4,
h5,
h6 {
    margin-top: 0;
    margin-bottom: .5rem;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}

address {
    font-style: normal;
    line-height: inherit;
    margin-bottom: 1rem;
}

ul {
    margin-top: 0;
    margin-bottom: 1rem;
}

ul ul {
    margin-bottom: 0;
}

strong {
    font-weight: bolder;
}

a {
    text-decoration: none;
    color: #5e72e4;
    background-color: transparent;
    -webkit-text-decoration-skip: objects;
}

a:hover {
    text-decoration: none;
    color: #233dd2;
}

img {
    vertical-align: middle;
    border-style: none;
}

caption {
    padding-top: 1rem;
    padding-bottom: 1rem;
    caption-side: bottom;
    text-align: left;
    color: #8898aa;
}

label {
    display: inline-block;
    margin-bottom: .5rem;
}

button {
    border-radius: 0;
}

button:focus {
    outline: 1px dotted;
    outline: 5px auto -webkit-focus-ring-color;
}

legend {
    font-size: 1.5rem;
    line-height: inherit;
    display: block;
    width: 100%;
    max-width: 100%;
    margin-bottom: .5rem;
    padding: 0;
    white-space: normal;
    color: inherit;
}

::-webkit-file-upload-button {
    font: inherit;
    -webkit-appearance: button;
}

h1,
h3,
h4,
h5,
h6,
.h1,
.h3,
.h4,
.h5,
.h6 {
    font-family: inherit;
    font-weight: 600;
    line-height: 1.5;
    margin-bottom: .5rem;
    color: #32325d;
}

h1,
.h1 {
    font-size: 1.625rem;
}

h3,
.h3 {
    font-size: 1.0625rem;
}

h4,
.h4 {
    font-size: .9375rem;
}

h5,
.h5 {
    font-size: .8125rem;
}

h6,
.h6 {
    font-size: .625rem;
}

.display-2 {
    font-size: 2.75rem;
    font-weight: 600;
    line-height: 1.5;
}

hr {
    margin-top: 2rem;
    margin-bottom: 2rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, .1);
}


.container {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}

.container-fluid {
    width: 100%;
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
}

.row {
    display: flex;
    margin-right: -15px;
    margin-left: -15px;
    flex-wrap: wrap;
}

.col-4,
.col-8,
.col,
.col-md-10,
.col-md-12,
.col-lg-3,
.col-lg-4,
.col-lg-6,
.col-lg-7,
.col-xl-4,
.col-xl-6,
.col-xl-8 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}

.col {
    max-width: 100%;
    flex-basis: 0;
    flex-grow: 1;
}

.col-4 {
    max-width: 33.33333%;
    flex: 0 0 33.33333%;
}

.col-8 {
    max-width: 66.66667%;
    flex: 0 0 66.66667%;
}

@media (min-width: 768px) {

    .col-md-10 {
        max-width: 83.33333%;
        flex: 0 0 83.33333%;
    }

    .col-md-12 {
        max-width: 100%;
        flex: 0 0 100%;
    }
}

@media (min-width: 992px) {

    .col-lg-3 {
        max-width: 25%;
        flex: 0 0 25%;
    }

    .col-lg-4 {
        max-width: 33.33333%;
        flex: 0 0 33.33333%;
    }

    .col-lg-6 {
        max-width: 50%;
        flex: 0 0 50%;
    }

    .col-lg-7 {
        max-width: 58.33333%;
        flex: 0 0 58.33333%;
    }

    .order-lg-2 {
        order: 2;
    }
}

@media (min-width: 1200px) {

    .col-xl-4 {
        max-width: 33.33333%;
        flex: 0 0 33.33333%;
    }

    .col-xl-6 {
        max-width: 50%;
        flex: 0 0 50%;
    }

    .col-xl-8 {
        max-width: 66.66667%;
        flex: 0 0 66.66667%;
    }

    .order-xl-1 {
        order: 1;
    }

    .order-xl-2 {
        order: 2;
    }
}

.form-control {
    font-size: 1rem;
    line-height: 1.5;
    display: block;
    width: 100%;
    height: calc(2.75rem + 2px);
    padding: .625rem .75rem;
    transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
    color: #8898aa;
    border: 1px solid #cad1d7;
    border-radius: .375rem;
    background-color: #fff;
    background-clip: padding-box;
    box-shadow: none;
}

@media screen and (prefers-reduced-motion: reduce) {
    .form-control {
        transition: none;
    }
}

.form-control::-ms-expand {
    border: 0;
    background-color: transparent;
}

.form-control:focus {
    color: #8898aa;
    border-color: rgba(50, 151, 211, .25);
    outline: 0;
    background-color: #fff;
    box-shadow: none, none;
}

.form-control:-ms-input-placeholder {
    opacity: 1;
    color: #adb5bd;
}

.form-control::-ms-input-placeholder {
    opacity: 1;
    color: #adb5bd;
}

.form-control::placeholder {
    opacity: 1;
    color: #adb5bd;
}

.form-control:disabled,
.form-control[readonly] {
    opacity: 1;
    background-color: #e9ecef;
}

textarea.form-control {
    height: auto;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-inline {
    display: flex;
    flex-flow: row wrap;
    align-items: center;
}

@media (min-width: 576px) {
    .form-inline label {
        display: flex;
        margin-bottom: 0;
        align-items: center;
        justify-content: center;
    }

    .form-inline .form-group {
        display: flex;
        margin-bottom: 0;
        flex: 0 0 auto;
        flex-flow: row wrap;
        align-items: center;
    }

    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .form-inline .input-group {
        width: auto;
    }
}

.btn {
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.5;
    display: inline-block;
    padding: .625rem 1.25rem;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    text-align: center;
    vertical-align: middle;
    white-space: nowrap;
    border: 1px solid transparent;
    border-radius: .375rem;
}

@media screen and (prefers-reduced-motion: reduce) {
    .btn {
        transition: none;
    }
}

.btn-primary {
    color: #fff;
    border-color: #5e72e4;
    background-color: #5e72e4;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}

.btn-primary:hover {
    color: #fff;
    border-color: #5e72e4;
    background-color: #5e72e4;
}

.btn-primary:focus {
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(94, 114, 228, .5);
}

.btn-primary:disabled {
    color: #fff;
    border-color: #5e72e4;
    background-color: #5e72e4;
}

.btn-info {
    color: #fff;
    border-color: #11cdef;
    background-color: #11cdef;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}

.btn-info:hover {
    color: #fff;
    border-color: #11cdef;
    background-color: #11cdef;
}

.btn-info:focus {
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 0 rgba(17, 205, 239, .5);
}

.btn-info:disabled {
    color: #fff;
    border-color: #11cdef;
    background-color: #11cdef;
}

.btn-info:not(:disabled):not(.disabled):active {
    color: #fff;
    border-color: #11cdef;
    background-color: #0da5c0;
}

.btn-info:not(:disabled):not(.disabled):active:focus {
    box-shadow: none, 0 0 0 0 rgba(17, 205, 239, .5);
}

.btn-default {
    color: #fff;
    border-color: #172b4d;
    background-color: #172b4d;
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}

.btn-default:hover {
    color: #fff;
    border-color: #172b4d;
    background-color: #172b4d;
}

.btn-default:disabled {
    color: #fff;
    border-color: #172b4d;
    background-color: #172b4d;
}

.btn-default:not(:disabled):not(.disabled):active {
    color: #fff;
    border-color: #172b4d;
    background-color: #0b1526;
}

.btn-default:not(:disabled):not(.disabled):active:focus {
    box-shadow: none, 0 0 0 0 rgba(23, 43, 77, .5);
}

.btn-sm {
    font-size: .875rem;
    line-height: 1.5;
    padding: .25rem .5rem;
    border-radius: .375rem;
}

.input-group {
    position: relative;
    display: flex;
    width: 100%;
    flex-wrap: wrap;
    align-items: stretch;
}

.input-group>.form-control {
    position: relative;
    width: 1%;
    margin-bottom: 0;
    flex: 1 1 auto;
}

.input-group>.form-control+.form-control {
    margin-left: -1px;
}

.input-group>.form-control:focus {
    z-index: 3;
}

.input-group>.form-control:not(:last-child) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group>.form-control:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.input-group-prepend {
    display: flex;
}

.input-group-prepend .btn {
    position: relative;
    z-index: 2;
}

.input-group-prepend .btn+.btn,
.input-group-prepend .btn+.input-group-text,
.input-group-prepend .input-group-text+.input-group-text,
.input-group-prepend .input-group-text+.btn {
    margin-left: -1px;
}

.input-group-prepend {
    margin-right: -1px;
}

.input-group-text {
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    display: flex;
    margin-bottom: 0;
    padding: .625rem .75rem;
    text-align: center;
    white-space: nowrap;
    color: #adb5bd;
    border: 1px solid #cad1d7;
    border-radius: .375rem;
    background-color: #fff;
    align-items: center;
}

.input-group-text input[type='radio'],
.input-group-text input[type='checkbox'] {
    margin-top: 0;
}

.input-group>.input-group-prepend>.btn,
.input-group>.input-group-prepend>.input-group-text {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group>.input-group-prepend:not(:first-child)>.btn,
.input-group>.input-group-prepend:not(:first-child)>.input-group-text,
.input-group>.input-group-prepend:first-child>.btn:not(:first-child),
.input-group>.input-group-prepend:first-child>.input-group-text:not(:first-child) {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.media {
    display: flex;
    align-items: flex-start;
}

.media-body {
    flex: 1 1;
}

a.bg-secondary:hover,
a.bg-secondary:focus,
button.bg-secondary:hover,
button.bg-secondary:focus {
    background-color: #d2e3ee !important;
}

.bg-default {
    background-color: #172b4d !important;
}

a.bg-default:hover,
a.bg-default:focus,
button.bg-default:hover,
button.bg-default:focus {
    background-color: #0b1526 !important;
}

.bg-white {
    background-color: #fff !important;
}

a.bg-white:hover,
a.bg-white:focus,
button.bg-white:hover,
button.bg-white:focus {
    background-color: #e6e6e6 !important;
}

.bg-white {
    background-color: #fff !important;
}

.border-0 {
    border: 0 !important;
}

.rounded-circle {
    border-radius: 50% !important;
}

.d-none {
    display: none !important;
}

.d-flex {
    display: flex !important;
}

@media (min-width: 768px) {

    .d-md-flex {
        display: flex !important;
    }
}

@media (min-width: 992px) {

    .d-lg-inline-block {
        display: inline-block !important;
    }

    .d-lg-block {
        display: block !important;
    }
}

.justify-content-center {
    justify-content: center !important;
}

.justify-content-between {
    justify-content: space-between !important;
}

.align-items-center {
    align-items: center !important;
}

@media (min-width: 1200px) {

    .justify-content-xl-between {
        justify-content: space-between !important;
    }
}

.float-right {
    float: right !important;
}

.m-0 {
    margin: 0 !important;
}

.mt-0 {
    margin-top: 0 !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mr-2 {
    margin-right: .5rem !important;
}

.ml-2 {
    margin-left: .5rem !important;
}

.mr-3 {
    margin-right: 1rem !important;
}

.mt-4,
.my-4 {
    margin-top: 1.5rem !important;
}

.mr-4 {
    margin-right: 1.5rem !important;
}

.mb-4,
.my-4 {
    margin-bottom: 1.5rem !important;
}

.mb-5 {
    margin-bottom: 3rem !important;
}

.mt--7 {
    margin-top: -6rem !important;
}

.pt-0 {
    padding-top: 0 !important;
}

.pr-0 {
    padding-right: 0 !important;
}

.pb-0 {
    padding-bottom: 0 !important;
}

.pt-5 {
    padding-top: 3rem !important;
}

.pt-8 {
    padding-top: 8rem !important;
}

.pb-8 {
    padding-bottom: 8rem !important;
}

.m-auto {
    margin: auto !important;
}

@media (min-width: 768px) {

    .mt-md-5 {
        margin-top: 3rem !important;
    }

    .pt-md-4 {
        padding-top: 1.5rem !important;
        margin-top: 75px;
    }

    .pb-md-4 {
        padding-bottom: 1.5rem !important;
    }
}

@media (min-width: 992px) {

    .pl-lg-4 {
        padding-left: 1.5rem !important;
    }

    .pt-lg-8 {
        padding-top: 8rem !important;
    }

    .ml-lg-auto {
        margin-left: auto !important;
    }
}

@media (min-width: 1200px) {

    .mb-xl-0 {
        margin-bottom: 0 !important;
    }
}

.text-right {
    text-align: right !important;
}

.text-center {
    text-align: center !important;
}

.text-uppercase {
    text-transform: uppercase !important;
}

.font-weight-light {
    font-weight: 300 !important;
}

.font-weight-bold {
    font-weight: 600 !important;
}

.text-white {
    color: #fff !important;
}

.text-white {
    color: #fff !important;
}

a.text-white:hover,
a.text-white:focus {
    color: #e6e6e6 !important;
}

.text-muted {
    color: #8898aa !important;
}

@media print {

    *,
    *::before,
    *::after {
        box-shadow: none !important;
        text-shadow: none !important;
    }

    a:not(.btn) {
        text-decoration: underline;
    }

    img {
        page-break-inside: avoid;
    }

    p,
    h3 {
        orphans: 3;
        widows: 3;
    }

    h3 {
        page-break-after: avoid;
    }

    @ page {
        size: a3;
    }

    .container {
        min-width: 992px !important;
    }
}

.bg-white {
    background-color: #fff !important;
}

a.bg-white:hover,
a.bg-white:focus,
button.bg-white:hover,
button.bg-white:focus {
    background-color: #e6e6e6 !important;
}

.bg-gradient-default {
    background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
}

.bg-gradient-default {
    background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
}

@keyframes floating-lg {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(15px);
    }

    100% {
        transform: translateY(0px);
    }
}

@keyframes floating {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(10px);
    }

    100% {
        transform: translateY(0px);
    }
}

@keyframes floating-sm {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(5px);
    }

    100% {
        transform: translateY(0px);
    }
}

.opacity-8 {
    opacity: .8 !important;
}

.opacity-8 {
    opacity: .9 !important;
}

.center {
    left: 50%;
    transform: translateX(-50%);
}

[class*='shadow'] {
    transition: all .15s ease;
}

.font-weight-300 {
    font-weight: 300 !important;
}

.text-sm {
    font-size: .875rem !important;
}

.text-white {
    color: #fff !important;
}

a.text-white:hover,
a.text-white:focus {
    color: #e6e6e6 !important;
}


.btn {
    font-size: .875rem;
    position: relative;
    transition: all .15s ease;
    letter-spacing: .025em;
    text-transform: none;
    will-change: transform;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
}

.btn:not(:last-child) {
    margin-right: .5rem;
}

.btn i:not(:first-child) {
    margin-left: .5rem;
}

.btn i:not(:last-child) {
    margin-right: .5rem;
}

.input-group .btn {
    margin-right: 0;
    transform: translateY(0);
}

.btn-sm {
    font-size: .75rem;
}

[class*='btn-outline-'] {
    border-width: 1px;
}

@media (min-width: 768px) {
    .main-content .container-fluid {
        padding-right: 39px !important;
        padding-left: 39px !important;
    }
}

.form-control-label {
    font-size: .875rem;
    font-weight: 600;
    color: #525f7f;
}

.form-control {
    font-size: .875rem;
}

.form-control:focus:-ms-input-placeholder {
    color: #adb5bd;
}

.form-control:focus::-ms-input-placeholder {
    color: #adb5bd;
}

.form-control:focus::placeholder {
    color: #adb5bd;
}

textarea[resize='none'] {
    resize: none !important;
}

textarea[resize='both'] {
    resize: both !important;
}

textarea[resize='vertical'] {
    resize: vertical !important;
}

textarea[resize='horizontal'] {
    resize: horizontal !important;
}

.form-control-alternative {
    transition: box-shadow .15s ease;
    border: 0;
    box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
}

.form-control-alternative:focus {
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}

.input-group {
    transition: all .15s ease;
    border-radius: .375rem;
    box-shadow: none;
}

.input-group .form-control {
    box-shadow: none;
}

.input-group .form-control:not(:first-child) {
    padding-left: 0;
    border-left: 0;
}

.input-group .form-control:not(:last-child) {
    padding-right: 0;
    border-right: 0;
}

.input-group .form-control:focus {
    box-shadow: none;
}

.input-group-text {
    transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
}

.input-group-alternative {
    transition: box-shadow .15s ease;
    border: 0;
    box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
}

.input-group-alternative .form-control,
.input-group-alternative .input-group-text {
    border: 0;
    box-shadow: none;
}

.focused .input-group-alternative {
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08) !important;
}

.focused .input-group {
    box-shadow: none;
}

.focused .input-group-text {
    color: #8898aa;
    border-color: rgba(50, 151, 211, .25);
    background-color: #fff;
}

.focused .form-control {
    border-color: rgba(50, 151, 211, .25);
}

.header {
    position: relative;
}

.input-group {
    transition: all .15s ease;
    border-radius: .375rem;
    box-shadow: none;
}

.input-group .form-control {
    box-shadow: none;
}

.input-group .form-control:not(:first-child) {
    padding-left: 0;
    border-left: 0;
}

.input-group .form-control:not(:last-child) {
    padding-right: 0;
    border-right: 0;
}

.input-group .form-control:focus {
    box-shadow: none;
}

.input-group-text {
    transition: all .2s cubic-bezier(.68, -.55, .265, 1.55);
}

.input-group-alternative {
    transition: box-shadow .15s ease;
    border: 0;
    box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
}

.input-group-alternative .form-control,
.input-group-alternative .input-group-text {
    border: 0;
    box-shadow: none;
}

.focused .input-group-alternative {
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08) !important;
}

.focused .input-group {
    box-shadow: none;
}

.focused .input-group-text {
    color: #8898aa;
    border-color: rgba(50, 151, 211, .25);
    background-color: #fff;
}

.focused .form-control {
    border-color: rgba(50, 151, 211, .25);
}

.mask {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all .15s ease;
}

@media screen and (prefers-reduced-motion: reduce) {
    .mask {
        transition: none;
    }
}

.nav-link {
    color: #525f7f;
}

.nav-link:hover {
    color: #5e72e4;
}

.nav-link i.ni {
    position: relative;
    top: 2px;
}

.dropdown-menu.show {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.our-team {
    padding: 30px 0 40px;
    margin-bottom: 30px;
    background-color: #fff;
    text-align: center;
    overflow: hidden;
    position: relative;
    border-radius: 3px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.our-team .picture {
    display: inline-block;
    height: 130px;
    width: 130px;
    z-index: 1;
    position: relative;
}

.our-team .picture::before {
    content: "";
    width: 100%;
    height: 0;
    border-radius: 50%;
    background-color: #1369ce;
    position: absolute;
    bottom: 135%;
    right: 0;
    left: 0;
    opacity: 0.9;
    transform: scale(3);
    transition: all 0.3s linear 0s;
}

/* For hover and active states */
.our-team:hover .picture::before,
.our-team:active .picture::before,
.our-team:focus .picture::before {
    height: 100%;
}

.our-team .picture::after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #1369ce;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

.our-team .picture img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    transform: scale(1);
    transition: all 0.9s ease 0s;
}

.our-team:hover .picture img,
.our-team:active .picture img,
.our-team:focus .picture img {
    box-shadow: 0 0 0 14px #f7f5ec;
    transform: scale(0.7);
}

.our-team .title {
    display: block;
    font-size: 15px;
    color: #4e5052;
    text-transform: capitalize;
}

.our-team:hover .social,
.our-team:active .social,
.our-team:focus .social {
    bottom: 0;
}

.our-team .social li {
    display: inline-block;
}

.our-team .social li a {
    display: block;
    padding: 10px;
    font-size: 14px;
    color: white;
    transition: all 0.3s ease 0s;
    text-decoration: none;
    text-transform: none;
}

.our-team .social {
    width: 100%;
    padding: 0;
    margin: 0;
    background-color: #1369ce;
    position: absolute;
    bottom: -100px;
    left: 0;
    transition: all 0.5s ease 0s;
}

@media (max-width: 768px) {

    .our-team .social {
        position: static;
        bottom: auto;
    }
}

.icon-container {
    background-color: #f7f5ec;
    border-radius: 50%;
    padding: 20px;
    display: inline-block;
}

.card {
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-weight: bold;
    font-size: 1.75rem;
}

.btn-primary {
    margin-top: 15px;
    padding: 10px 20px;
    border-radius: 30px;
}

.card-text {
    color: #6c757d;
    font-size: 14px;
}
</style>