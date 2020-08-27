<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>LOGIN - UNICEF MIS</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <style>
        .form-group{
            padding: 0 15px 0 15px!important;
        }
        .form-group label{
            padding-left: 15px!important;
            font-weight: bold!important;
        }
        .form-group input{
            border-radius: 15px!important;
            padding-left: 15px!important;
            font-size: 16px!important;
            letter-spacing: 1px;
        }
        /*Eye Icon in Password Field*/
        .field-icon {
            float: right;
            margin-right: 15px!important;
            margin-top: -25px!important;
            position: relative;
            z-index: 2;
            font-size: 16px!important;
        }
        @media only screen and (max-width: 992px) {
            .salt_spoon {
                display: none;
            }
        }
    </style>

</head>

<body class="login-layout light-login" style="background-image: url('assets/images/salt_login/salt_bg_photo.jpg');background-repeat: no-repeat;background-size: cover">

<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-md-2 col-md-offset-1 offset-2">
                <img class="img-responsive salt_spoon" src="{{ url('assets/images/salt_login/salt_spoon.png') }}" width="80%"/>
            </div>
            <div class="col-md-3 col-md-offset-5">
                <div class="row" style="min-height: 420px;margin-top: 30px;border: 2px solid #4685B1;background: #EDF3F7">
                    <img class="img-responsive" src="{{ url('assets/images/salt_login/form-header.png') }}" style="height: 150px;width: 100%"/>
                    {{-- Custom alert message --}}
                    @include('includes.alert')
                    {{-- Custom alert message --}}
                    <h5 class="text-center">
                        @if (isset($errors) && count($errors) > 0)
                            <b class="text-danger"> Invalid Email or Password !</b>
                        @endif
                    </h5>
                    <form method="POST" action="{{ route('login') }}" style="margin-top: 20px!important;">
                            @csrf
                        <div class="form-group">
                            <label for="usr">Email Address</label>
                            <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="&#xf0e0;" style="font-family:Arial, FontAwesome" required autofocus autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="&#xf023;" style="font-family:Arial, FontAwesome" required>

                            <span toggle="#password-field" class="fa fa-eye-slash field-icon toggle-password"></span>
                        </div>
                        <div class=" col-md-8 col-md-offset-2 form-group text-center" style="margin-top: 5px">
                            <button type="submit" style="background-image: url('assets/images/salt_login/btn-login.png');background-repeat: no-repeat;background-size: cover;height: 30px;width: 150px;border: none;"></button>
                        </div>

                        <div class="row" style="padding: 15px">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="checkbox"/> Remember
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                <a href="{{ route('password.request') }}">Forgot Password</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<div class="container-fluid" style="padding: 0!important;position: fixed;bottom: 0;">
    <img class="img-responsive" src="{{ url('assets/images/salt_login/footer.png') }}" />
</div>

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

<!-- <![endif]-->

<!-- inline scripts related to this page -->
<script type="text/javascript">

    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye-slash fa-eye");
        let $input = $(this).closest('.form-group').find('input');
        if ($input.attr("type") === "password") {
            $input.attr("type", "text");
        } else {
            $input.attr("type", "password");
        }
    });
</script>
</body>
