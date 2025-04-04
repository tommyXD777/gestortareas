<?php
require_once 'models/UsuariosModel.php';

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login() {
        if (isset($_SESSION['user_id'])) {
            redirect('index.php?controller=task&action=index');
        }
        require_once 'views/login/iniciar.php';
    }
    
    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            if (empty($data['email'])) {
                $data['email_err'] = 'Ingrese su Email';
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Ingrese la Contraseña';
            }
            if (empty($data['email_err']) && empty($data['password_err'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']); 
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Contraseña Incorrecta';
                    require_once 'views/login/inicio.php';
                }
            } else {
                require_once 'views/login/inicio.php';
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            require_once 'views/login/iniciar.php';
        }
    }
    
    public function register() {
        if (isset($_SESSION['user_id'])) {
            redirect('index.php?controller=task&action=index');
        }
        require_once 'views/login/registrarse.php';
    }
    public function processRegister() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            if (empty($data['name'])) {
                $data['name_err'] = 'Ingrese su Nombre';
            }

            if (empty($data['email'])) {
                $data['email_err'] = 'Ingrese su Email';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'El Email ya se encuentra Registrado';
                }
            }
            if (empty($data['password'])) {
                $data['password_err'] = 'Ingrese su Contraseña';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'La Contraseña debe tener 6 carácteres';
            }
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Confirme su contraseña';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Las contraseñas No coinciden';
                }
            }
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                $userId = $this->userModel->register($data);
                
                if ($userId) {
                    setFlashMessage('Registro Éxitoso, puedes Iniciar Sesión.');
                    redirect('index.php?controller=auth&action=login');
                } else {
                    die('Algo está mal');
                }
            } else {
                require_once 'views/login/inicio.php';
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            require_once 'views/login/registrarse.php';
        }
    }
    
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_email'] = $user->email;
        redirect('index.php?controller=task&action=index');
    }
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit();
    }

    public function profile() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        $user = $this->userModel->getById($_SESSION['user_id']);
        require_once 'views/login/perfil.php';
    }
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'name_err' => ''
            ];
            if (empty($data['name'])) {
                $data['name_err'] = 'Por favor Ingrese su Nombre';
            }
            if (empty($data['name_err'])) {
                if ($this->userModel->updateProfile($data)) {
                    $_SESSION['user_name'] = $data['name'];

                    setFlashMessage('Perfil Actualizado con Éxito');
                    redirect('index.php?controller=auth&action=profile');
                } else {
                    die('Algo va mal');
                }
            } else {
                require_once 'views/login/perfil.php';
            }
        } else {
            redirect('index.php?controller=auth&action=profile');
        }
    }
}



