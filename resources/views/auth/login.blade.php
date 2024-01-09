<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/style.css" rel="stylesheet">
    <link href="assets/ColorAdmin/admin/template/assets/plugins/font-awesome/5.0/css/fontawesome-all.css" rel="stylesheet" />
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" ></script>
    
    <title>HRIS || ANYAR GROUP</title>
    <link rel="icon" href="{!! url('assets/bootstrap/img/icon-office.png')!!}">
  </head>
<body>
    @extends('layouts.auth-master')

    @section('content')
    <div class="login">
        <div class="container container-login">
            <h5 class="title-1">Welcome To Dashboard</h5>
            <h5 class="title-2">Anyar Career</h5>
            <div class="row justify-content-between row-login">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-login">
                   <div class="img-login">
                    <img src="../assets/bootstrap/img/img-login.png" class="login-img" alt="">
                   </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 col-login">
                    <div class="card card-login">
                  
                    <form class="form-login" method="post" action="{{ route('login.perform') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        
                        <h5 class="title-login">Login To Your <span class="title-login-1">Account</span></h5>
                        @include('layouts.partials.messages')
                        <div class="email mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control form-email-input" 
                            name="email" value="{{ old('email') }}" placeholder="Masukan E-mail" required="required" autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        
                        <div class="password mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group grup-password">
                            <input type="password" class="form-control form-pass-input" id="inputPassword"
                            name="password" value="{{ old('password') }}" placeholder="Password" required="required" />
                            <i class="fas fa-eye" onclick="myFunction()" id="passwordToggler"></i>
                 
                            </div>
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    
                        <div class="forgot">
                            <a rel="noopener noreferrer" href="/forgotpassword">Forgot Password ?</a>
                        </div>
                                             
                        <div class="row row-btn">
                            <div class="col col-btn-login">
                            <button class="w-100 btn btn-signin" type="submit">Sign in</button>
                            </div>
                        </div>
                        <!-- @include('auth.partials.copy') -->
                    </form>
                </div>
            </div>
        </div>
    </div>
       
    @endsection

    <script>
        function myFunction() {
            var x = document.getElementById("inputPassword");
            var passToggler = document.getElementById("passwordToggler");
            if (x.type === "password") {
                x.type = "text";
                passToggler.removeClass("fas fa-eye");
                passToggler.addClass("fas fa-eye-slash");
            } else {
                x.type = "password";
                passToggler.removeClass("fas fa-eye-slash");
                passToggler.addClass("fas fa-eye");
            }
        }

    </script>
</body>
</html>

<style>
       .forgot {
        display: flex;
        justify-content: flex-end;
        font-size: 0.90rem;
        line-height: 1rem;
        color: #4f4f4f;
        margin: -5px 0 8px 0;
    }

    .forgot a,.signup a {
    color: #4f4f4f;
    text-decoration: none;
    font-size: 14px;
    }

    .forgot a:hover, .signup a:hover {
    text-decoration: underline rgba(167, 139, 250, 1);
    }
</style>
