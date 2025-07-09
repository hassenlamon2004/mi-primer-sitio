<?php
session_start();
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $contraseña = $_POST['contraseña'];

    $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE telefono = ?");
    $stmt->execute([$user]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($contraseña, $usuario['contrasena'])) {
        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Credenciales incorrectas';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
</head>
<body>
<div class="container">
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="form-group">
            <label>Usuario</label>
            <input type="number" name="user" class="form-control" placeholder="Número de celular" required>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="contraseña" class="form-control" min="3000000000" max="3250000000" required>
        </div>
        <button type="submit" class="boton">Iniciar Sesión</button>
    </form>
    <p class="mt-3">¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
</div>
</body>
</html>
<style>
    /* Estilos CSS Innovadores */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #f6d365, #fda085); /* Degradado suave */
        color: #4a4a4a;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        perspective: 1000px;
    }

    .container {
        max-width: 450px;
        width: 100%;
        margin: 20px;
        padding: 40px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        transform-style: preserve-3d;
        transform: rotateX(10deg) scale(0.95);
    }

    .container:hover {
        transform: rotateX(0) scale(1);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
    }

    h2 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 40px;
        color: #333;
        position: relative;
        letter-spacing: 1px;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, #ff9e00, #ffa726);
        transform: translateX(-50%);
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group label {
        font-size: 16px;
        font-weight: 600;
        color: #4a4a4a;
        margin-bottom: 10px;
        display: block;
        transition: color 0.3s ease;
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 2px solid transparent;
        border-radius: 8px;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
        outline: none;
    }

    .form-control:focus {
        border-color: #ff9e00;
        box-shadow: 0 0 10px rgba(255, 158, 0, 0.2);
        background-color: #fff;
    }

    .boton {
        width: 100%;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        color: white;
        background: linear-gradient(to right, #28a745, #2ecc71);
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .boton:hover {
        background: linear-gradient(to right, #2ecc71, #27ae60);
        transform: translateY(-3px);
        box-shadow: 0 7px 15px rgba(0, 0, 0, 0.15);
    }

    .boton:active {
        transform: translateY(1px);
        box-shadow: 0 3px 7px rgba(0, 0, 0, 0.1);
    }

    .alert {
        padding: 15px;
        margin-bottom: 25px;
        font-size: 16px;
        text-align: center;
        border-radius: 8px;
        background-color: #e74c3c;
        color: white;
        animation: shake 0.5s;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    p {
        text-align: center;
        font-size: 16px;
        margin-top: 20px;
    }

    p a {
        color: #ff9e00;
        text-decoration: none;
        font-weight: 600;
        position: relative;
        transition: color 0.3s ease;
    }

    p a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #ff9e00;
        transition: width 0.3s ease;
    }

    p a:hover {
        color: #e67e22;
    }

    p a:hover::after {
        width: 100%;
    }

    @media (max-width: 768px) {
        .container {
            padding: 30px 20px;
            margin: 10px;
        }

        h2 {
            font-size: 24px;
        }

        .form-control, .boton {
            font-size: 14px;
            padding: 12px;
        }
    }
</style>