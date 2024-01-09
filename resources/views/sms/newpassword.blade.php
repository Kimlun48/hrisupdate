<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRIS || ANYAR GROUP</title>
    <link rel="icon" href="{!! url('assets/bootstrap/img/icon-office.png')!!}">
    <!--<title>Laravel Starter</title>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #f1f1f1;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            width: 600px;
            margin: 0 auto;
            display: block;
        }
        .full-height {
            height: 100vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        input {
            padding: 10pt;
            width: 60%;
            font-size: 14px;
            border-radius: 5pt;
            border: 1px solid lightgray;
            margin: 10pt;
            height: 10px;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            width: 60%;
            align-items: center;
            margin: 20pt;
            border: 1px solid lightgray;
            padding: 20pt;
            border-radius: 5pt;
            background: white;
        }
        button {
            border-radius: 5pt;
            padding: 5pt 14pt;
            background: #1572a1;
            border: none;
            font-size: 13pt;
            margin: 20pt;
            color: #fff;
        }
        button:hover {
            background: #014161;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <form class="form-container" action="/resetpass" method="POST">
        @csrf
        <p class="navbar-brand"><img src="{!! url('assets/bootstrap/img/head.png')!!}" style="height:20px; width:100px;" alt="logo"></p>
        <h3>Forgot Password?</h3>

        <input name="otp" placeholder="Enter OTP" value="{{ $otp }}" readonly>
        <input name="email" placeholder="Email" value="{{ $email }}" readonly>
        <input name="password" type="password" placeholder="Enter new password">
        <input name="password_confirmation" type="password" placeholder="Confirm new password">

        <button type="submit">Submit</button>
    </form>
</div>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
        });
    </script>
@endif
</body>
</html>
