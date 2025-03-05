<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Don Pepe - Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tienda Don Pepe - Iniciar Sesión">
    <meta name="keywords" content="Login, Usuarios, password">
    <meta name="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="{{asset('img/logo-tiendaa.png')}}" type="image/x-icon">
    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
    <!-- Estilos personalizados -->
    <style>
        /* Animación de fondo */
        body {
            background: linear-gradient(-45deg, #0d6efd, #6610f2, #6f42c1, #d63384);
            background-size: 400% 400%;
            animation: gradientBG 8s ease infinite;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Tarjeta de login */
        .login-card {
            width: 380px;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Logo */
        .logo {
            width: 120px;
            margin-bottom: 10px;
        }

        /* Título mejorado */
        .login-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        /* Botón */
        .btn-primary {
            background: #0d6efd;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #6610f2;
        }

        /* Recordarme estilizado */
        .form-check-input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .form-check-label {
            font-size: 14px;
            margin-left: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="{{asset('img/logo-tiendaa.png')}}" alt="Logo Don Pepe" class="logo">
        <h3 class="login-title">Bienvenido a <span class="text-primary">Don Pepe</span></h3>
        <p class="text-muted">Inicia sesión para continuar</p>

        <form action="{{route('login')}}" method="POST">
            @csrf

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" placeholder="Correo electrónico" name="email" value="{{old('email')}}">
                </div>
                {{-- @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" placeholder="Contraseña" name="password">
                </div>
                {{-- @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror --}}
            </div>

            <div class="d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe">
                <label class="form-check-label" for="rememberMe"> Recordarme </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>

            @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
