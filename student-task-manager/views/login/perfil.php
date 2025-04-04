<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<?php require_once 'views/includes/header.php'; ?>
<div class="dashboard">
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-cover"></div>
            <h1 class="profile-name"><?php echo isset($user->name) ? $user->name : $_SESSION['user_name']; ?></h1>
            <p class="profile-email"><?php echo isset($user->email) ? $user->email : $_SESSION['user_email']; ?></h1>
        </div>
        
        <div class="profile-content">
            <div class="profile-card">
                <div class="card-header">
                    <h2><i class="fas fa-id-card"></i> Información Personal</h2>
                </div>
                
                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle alert-icon"></i>
                            <div class="alert-content">
                                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle alert-icon"></i>
                            <div class="alert-content">
                                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <form action="index.php?controller=auth&action=updateProfile" method="post" class="profile-form">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i> Nombre Completo
                            </label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo isset($user->name) ? $user->name : $_SESSION['user_name']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i> Correo Electrónico
                            </label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo isset($user->email) ? $user->email : $_SESSION['user_email']; ?>" readonly>
                            <small class="form-text">El correo electrónico no se puede cambiar.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Actualizar Perfil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const passwordField = this.closest('.password-field');
            const passwordInput = passwordField.querySelector('input');
            
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle icon
            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
});
</script>
</body>
</html>



