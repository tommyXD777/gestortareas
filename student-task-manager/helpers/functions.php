<?php
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function redirect($url) {
    header("Location: $url");
    exit();
}

function flashMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return '';
}

function setFlashMessage($message) {
    $_SESSION['message'] = $message;
}

function formatDate($date) {
    return date('M d, Y', strtotime($date));
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function getCurrentUser() {
    if (isLoggedIn()) {
        require_once 'models/UsuariosModel.php';
        $userModel = new UserModel();
        return $userModel->getById($_SESSION['user_id']);
    }
    return null;
}

