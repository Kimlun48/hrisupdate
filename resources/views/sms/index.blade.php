<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HRIS || ANYAR GROUP</title>
    <link rel="icon" href="{!! url('assets/bootstrap/img/icon-office.png')!!}">

    <!--<title>Laravel Starter</title>-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            display: block
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
            height: 10px
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
        label.col-md-4.col-form-label.text-md-right {
            padding-left: 16px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="flex-center position-ref full-height">
        
        <form class="form-container" method="POST" action="/sendotp">
            @csrf
            <p class="navbar-brand"><img src="{!! url('assets/bootstrap/img/head.png')!!}" style="height:20px, width:100px;" alt="logo"></p>
            <h3>Kirim SMS OTP</h3>

            <div class="form-group row">
                <label for="to" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="col-md-6">
                    <input id="to" type="text" placeholder="08*******" class="form-control @error('to') is-invalid @enderror" name="to" value="{{ old('to') }}" required autocomplete="off">

                    @error('to')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary" onclick="showSwalFire()">
                        Kirim SMS OTP
                    </button>
                </div>
            </div>
        </form>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000 // Durasi tampilan pesan (ms)
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            timer: 3000 // Durasi tampilan pesan (ms)
        });
    </script>
@endif

</body>
</html>
