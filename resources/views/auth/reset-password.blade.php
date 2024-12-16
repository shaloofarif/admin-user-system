<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Reset Password</h2>

                <!-- Reset Password Form -->
                <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    
    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ $email }}" required>
        
        @error('email')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" required>
        
        @error('password')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <button type="submit">Reset Password</button>
</form>

                <!-- Back to Login Link -->
                <div class="mt-3 text-center">
                    <a href="{{ route('user.login') }}">Back to Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
