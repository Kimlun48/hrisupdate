<!-- resources/views/verification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Nomor Telepon</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        .phone-form,
        .otp-form {
            width: 50%;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="phone-form">
            <h1>Verifikasi Nomor Telepon</h1>

            <form method="POST" action="{{ route('verify') }}">
                @csrf
                <label for="phone_number">Masukkan Nomor Telepon:</label><br>
                <input type="text" id="phone_number" name="phone_number" required><br><br>

                <button type="submit">Kirim OTP</button>
            </form>
        </div>

        <div class="otp-form">
            <h1>Verifikasi OTP</h1>

            <form method="POST" action="{{ route('verifyOTP') }}">
                @csrf
                <input type="hidden" name="phone_number" value="{{ $phoneNumber }}">

                <label for="otp">Masukkan OTP:</label><br>
                <input type="text" id="otp" name="otp" required><br><br>

                <button type="submit">Verifikasi</button>
            </form>
        </div>
    </div>
</body>
</html>
