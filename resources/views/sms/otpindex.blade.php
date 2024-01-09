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
        

        .otp-Form {
        width: 230px;
        height: 300px;
        background-color: rgb(255, 255, 255);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 30px;
        gap: 20px;
        position: relative;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.082);
        border-radius: 15px;
        }

        .mainHeading {
        font-size: 1.1em;
        color: rgb(15, 15, 15);
        font-weight: 700;
        }

        .otpSubheading {
        font-size: 0.7em;
        color: black;
        line-height: 17px;
        text-align: center;
        }

        .inputContainer {
        width: 100%;
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
        justify-content: center;
        }

        .otp-input {
        background-color: rgb(228, 228, 228);
        width: 30px;
        height: 30px;
        text-align: center;
        border: none;
        border-radius: 7px;
        caret-color: rgb(127, 129, 255);
        color: rgb(44, 44, 44);
        outline: none;
        font-weight: 600;
        }

        .otp-input:focus,
        .otp-input:valid {
        background-color: rgba(127, 129, 255, 0.199);
        transition-duration: .3s;
        }

        .verifyButton {
        width: 100%;
        height: 30px;
        border: none;
        background-color: rgb(127, 129, 255);
        color: white;
        font-weight: 600;
        cursor: pointer;
        border-radius: 10px;
        transition-duration: .2s;
        }

        .verifyButton:hover {
        background-color: rgb(144, 145, 255);
        transition-duration: .2s;
        }

        .exitBtn {
        position: absolute;
        top: 5px;
        right: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.171);
        background-color: rgb(255, 255, 255);
        border-radius: 50%;
        width: 25px;
        height: 25px;
        border: none;
        color: black;
        font-size: 1.1em;
        cursor: pointer;
        }

        .resendNote {
        font-size: 0.7em;
        color: black;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        }

        .resendBtn {
        background-color: transparent;
        border: none;
        color: rgb(127, 129, 255);
        cursor: pointer;
        font-size: 1.1em;
        font-weight: 700;
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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
        <form class="otp-Form" action="/veriotp" method="POST">
    @csrf
    <span class="mainHeading">Enter OTP</span>
    <p class="otpSubheading">We have sent a verification code to your mobile number</p>
    <div class="inputContainer">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input1" oninput="moveToNextInput(this, 2)" onkeydown="handleBackspace(this, event)">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input2" oninput="moveToNextInput(this, 3)" onkeydown="handleBackspace(this, event)">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input3" oninput="moveToNextInput(this, 4)" onkeydown="handleBackspace(this, event)">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input4" oninput="moveToNextInput(this, 5)" onkeydown="handleBackspace(this, event)">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input5" oninput="moveToNextInput(this, 6)" onkeydown="handleBackspace(this, event)">
        <input required="required" maxlength="1" type="text" class="otp-input" name="otp-input6" onkeydown="handleBackspace(this, event)">
    </div>
    <button class="verifyButton" type="submit">Verify</button>
    <button class="exitBtn">×</button>
</form>
<form class="form-container" method="POST" action="/resendotp">
    @csrf
    <p class="resendNote">Didn't receive the code? 
        <input name="to" placeholder="Phone Number" value="{{ $to }}" readonly>
        <button class="resendBtn" type="submit" >Resend Code</button>
    </p>
</form>


    </div>
<script>
        function moveToNextInput(currentInput, nextInputIndex) {
            if (currentInput.value.length === currentInput.maxLength) {
                const inputs = document.getElementsByClassName('otp-input');
                if (nextInputIndex <= inputs.length) {
                    inputs[nextInputIndex - 1].focus();
                } else {
                    currentInput.blur(); // Remove focus from the last input
                }
            }
        }

        function handleBackspace(currentInput, event) {
            if (event.key === 'Backspace' && currentInput.value.length === 0) {
                const inputs = document.getElementsByClassName('otp-input');
                const currentIndex = Array.from(inputs).indexOf(currentInput);
                if (currentIndex > 0) {
                    inputs[currentIndex - 1].focus();
                }
            }
        }
    </script>

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


