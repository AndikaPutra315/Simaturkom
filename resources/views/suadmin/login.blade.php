<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMATURKOM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Latar belakang gradien dengan pola garis halus */
            background-color: #eef2f9;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        .login-container {
            width: 100%;
            max-width: 420px;
        }
        .login-logo {
            display: block;
            margin: 0 auto 30px auto;
            height: 60px; /* Atur tinggi logo */
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            /* Efek kaca buram (frosted glass) */
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.1)!important;
        }
        .login-card .card-title {
            font-weight: 700;
            color: #343a40;
        }
        .btn-login {
            background-color: #1a237e;
            border-color: #1a237e;
            padding: 0.75rem;
            font-weight: 600;
        }
        .btn-login:hover {
            background-color: #151c68;
            border-color: #151c68;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="{{ asset('images/logotabalong.png') }}" alt="Logo Kabupaten Tabalong" class="login-logo">

        <div class="card login-card">
            <div class="card-body p-4 p-sm-5">
                <h5 class="card-title text-center mb-4">Super Admin Login</h5>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="ID">
                        <label for="email">ID</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    @error('email')
                        <div class="alert alert-danger py-2" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="d-grid pt-2">
                        <button class="btn btn-primary btn-login text-uppercase" type="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
