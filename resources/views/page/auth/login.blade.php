<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            /* background-image: url('vendor/assets/img/bg3.webp'); */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
        .card-transparent {
            background-color: rgba(255, 255, 255, 0.418);
            backdrop-filter: blur(10px);
        }
        .input-group-text {
            background: transparent;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card card-transparent p-4" style="width: 400px;">
            <h3 class="text-center">Login</h3>

            @if (session()->has('loginError'))
            <div class="alert alert-danger">{{ session('loginError') }}</div>
            @endif

            <form action="/login/do" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" required>
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                </div>

                @error ('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" required>
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                </div>

                @error ('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                 @enderror

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="mt-3 text-center">
                    <p class="mb-0">
                        Belum Punya Akun?
                        <a href="register" class="text-center">Register</a>
                    </p>
                    {{-- <a href="{{ route('register') }}">Register a new account</a> --}}
                </div>
            </form>
        </div>
    </div>
</body>
</html>
