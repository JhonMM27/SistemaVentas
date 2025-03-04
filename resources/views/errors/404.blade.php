<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #343a40;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .error-page {
            max-width: 600px;
            animation: fadeIn 2s ease-in-out;
        }
        .error-logo {
            font-size: 120px;
            font-weight: bold;
            color: #ffc107;
            text-shadow: 4px 4px 10px rgba(255, 193, 7, 0.7);
            animation: bounce 2s infinite;
        }
        .error-text {
            font-size: 22px;
            animation: fadeInUp 1.5s ease-in-out;
        }
        .btn-warning {
            font-size: 18px;
            padding: 12px 24px;
            border-radius: 8px;
            animation: pulse 2s infinite;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-logo animate__animated animate__bounce">404</div>
        <h2 class="error-text animate__animated animate__fadeInDown">¡Oops! Página no encontrada</h2>
        <p class="error-text animate__animated animate__fadeInUp">No pudimos encontrar la página que buscas. Es posible que haya sido eliminada o que la URL sea incorrecta.</p>
        <a href="/" class="btn btn-warning animate__animated animate__pulse animate__infinite">Volver al inicio</a>
    </div>
</body>
</html>
