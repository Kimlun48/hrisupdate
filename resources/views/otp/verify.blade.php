<!-- resources/views/verify.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Verifikasi Nomor Telepon</title>
</head>
<body>
    <h1>Verifikasi Nomor Telepon</h1>

    <div>
        <h3>Langkah 1: Masukkan Nomor Telepon</h3>
        <form method="POST" action="{{ route('sendOTP') }}">
            @csrf
            <label for="phone_number">Nomor Telepon:</label><br>
            <input type="text" id="phone_number" name="phone_number" required><br><br>
    
            <button type="submit">Kirim OTP</button>
        </form>
    </div>

    <div>
        <h3>Langkah 2: Verifikasi OTP</h3>
        <form method="POST" action="{{ route('verifyOTP') }}">
            @csrf
            <input type="hidden" name="phone_number" value="{{ $phoneNumber }}">
    
            <label for="otp">OTP:</label><br>
            <input type="text" id="otp" name="otp" required><br><br>
    
            <button type="submit">Verifikasi</button>
        </form>
    </div>
</body>
</html>
