<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barra de Navegación Mejorada</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <div class="navbar-brand">
            <a href="index.php?controller=task&action=index">
                <i class="fas fa-tasks"></i> Student Task Manager
            </a>
        </div>

        <div class="navbar-menu">
            <a href="index.php?controller=task&action=index" class="nav-item">
                <i class="fas fa-home"></i> Inicio
            </a>
            <a href="index.php?controller=task&action=add" class="nav-item">
                <i class="fas fa-plus-circle"></i> Nueva Tarea
            </a>
            <a href="index.php?controller=auth&action=profile" class="nav-item">
                <i class="fas fa-user"></i> Mi Perfil
            </a>
            <a href="index.php?controller=auth&action=logout" class="nav-item logout">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>
</nav>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navbarMenu = document.querySelector('.navbar-menu');

    menuToggle.addEventListener('click', function() {
        navbarMenu.classList.toggle('active');
    });
});
</script>
</body>
</html>







