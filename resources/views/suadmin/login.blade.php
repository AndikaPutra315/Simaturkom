<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMATURKOM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7fc;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
        }
        .login-card .card-title {
            font-weight: 700;
        }
        .btn-login {
            background-color: #1a237e;
            border-color: #1a237e;
        }
        .btn-login:hover {
            background-color: #151c68;
            border-color: #151c68;
        }
    </style>
</head>
<body>
    <div class="card login-card">
        <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-4">Super Admin Login</h5>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-floating mb-3">
                    {{-- Kita gunakan name="email" karena ini default Laravel, tapi labelnya "ID" --}}
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ID">
                    <label for="email">ID</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                    <label for="password">Password</label>
                </div>

                {{-- Menampilkan pesan error jika login gagal --}}
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="d-grid">
                    <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
