<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            <h3 class="text-center">Register</h3>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                        <span class="input-group-text">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
                <div class="mt-3 text-center">
                    Apakah Anda Sudah Memiliki Akun? <a href="{{ route('login') }}">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
