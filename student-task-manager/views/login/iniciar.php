<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Student Task Manager</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php require_once 'views/includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon"><i class="fas fa-tasks"></i></div>
            <h2><?php echo APP_NAME; ?></h2>
            <p>Organiza tus tareas de forma eficiente</p>
        </div>
        
        <div class="auth-body">
            <div class="auth-title">
                <h3>¡Bienvenido de nuevo!</h3>
                <p>Inicia sesión para continuar</p>
            </div>
            
            <form action="index.php?controller=auth&action=processLogin" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Correo electrónico
                    </label>
                    <input type="email" name="email" id="email" class="form-control" 
                           value="<?php echo isset($data['email']) ? $data['email'] : ''; ?>" 
                           placeholder="tu@email.com" required>
                    <span class="form-error"><?php echo isset($data['email_err']) ? $data['email_err'] : ''; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i> Contraseña
                    </label>
                    <div class="password-field">
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="••••••••" required>
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="form-error"><?php echo isset($data['password_err']) ? $data['password_err'] : ''; ?></span>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                    </button>
                </div>
            </form>
            
            <div class="auth-links">
                <p>
                    ¿No tienes una cuenta? 
                    <a href="index.php?controller=auth&action=register">Regístrate aquí</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>







