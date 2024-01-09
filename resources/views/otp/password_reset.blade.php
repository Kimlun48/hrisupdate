<!-- resources/views/auth/password_reset.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>

    <form method="POST" action="{{ route('resetPassword') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus><br><br>
    
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
    
        <label for="password_confirmation">Confirm Password:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation" required><br><br>
    
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
