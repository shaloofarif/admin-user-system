<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Forgot Password</h2>

                <!-- Status message for reset link sent -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Forgot Password Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h2>Forgot Password</h2>
                    
                    @if (session('status'))
                        <div>{{ session('status') }}</div>
                    @endif

                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit">Send Password Reset Link</button>
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
