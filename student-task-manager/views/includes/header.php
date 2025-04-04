<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME; ?> - Gestor de Tareas para Estudiantes</title>

    <link rel="icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="./assets/css/styles.css?v=<?php echo time(); ?>">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php if (isLoggedIn()): ?>
        <?php include_once 'views/includes/navbar.php'; ?>
    <?php endif; ?>
    
    <?php if (isLoggedIn()): ?>
    <div class="container">
        <?php
        $message = flashMessage();
        if (!empty($message)) {
            echo '<div class="alert alert-success" role="alert">';
            echo '<div class="alert-content">';
            echo '<i class="fas fa-check-circle alert-icon"></i>';
            echo '<p>' . $message . '</p>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    <?php endif; ?>



