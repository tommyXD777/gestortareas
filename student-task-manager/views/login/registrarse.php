<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Student Task Manager</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<?php require_once 'views/includes/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon"><i class="fas fa-user-plus"></i></div>
            <h2>Crear Cuenta</h2>
            <p>Únete a <?php echo APP_NAME; ?> hoy</p>
        </div>
        
        <div class="auth-body">
            <div class="auth-title">
                <h3>Información Personal</h3>
                <p>Completa tus datos para registrarte</p>
            </div>
            
            <form action="index.php?controller=auth&action=processRegister" method="POST" class="auth-form">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-user"></i> Nombre Completo
                    </label>
                    <input type="text" name="name" id="name" class="form-control" 
                           value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" 
                           placeholder="Tu nombre completo" required>
                    <span class="form-error"><?php echo isset($data['name_err']) ? $data['name_err'] : ''; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i> Correo Electrónico
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
                               placeholder="Mínimo 6 caracteres" required>
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="form-error"><?php echo isset($data['password_err']) ? $data['password_err'] : ''; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password" class="form-label">
                        <i class="fas fa-check-circle"></i> Confirmar Contraseña
                    </label>
                    <div class="password-field">
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" 
                               placeholder="Repite tu contraseña" required>
                        <button type="button" class="password-toggle" onclick="togglePasswordVisibility('confirm_password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <span class="form-error"><?php echo isset($data['confirm_password_err']) ? $data['confirm_password_err'] : ''; ?></span>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-user-plus"></i> Crear Cuenta
                    </button>
                </div>
            </form>
            
            <div class="auth-links">
                <p>
                    ¿Ya tienes una cuenta? 
                    <a href="index.php?controller=auth&action=login">Inicia sesión</a>
                </p>
            </div>
            
            <div class="terms-text">
                Al registrarte, aceptas nuestros <a href="#">Términos de servicio</a> y <a href="#">Política de privacidad</a>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const iconContainer = passwordInput.parentNode.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            iconContainer.classList.remove('fa-eye');
            iconContainer.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            iconContainer.classList.remove('fa-eye-slash');
            iconContainer.classList.add('fa-eye');
        }
    }
</script>
</body>
</html>





