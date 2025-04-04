<?php
require_once 'models/TareasModel.php';

class TaskController {
    private $taskModel;
    
    public function __construct() {
        $this->taskModel = new TaskModel();
    }
    public function index() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        $tasks = $this->taskModel->getTasksByUserId($_SESSION['user_id']);
        require_once 'views/tareas/index.php';
    }
    public function add() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        require_once 'views/tareas/agregar.php';
    }
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'category' => trim($_POST['category']),
                'priority' => trim($_POST['priority']),
                'due_date' => trim($_POST['due_date']),
                'status' => 'pending',
                'title_err' => '',
                'due_date_err' => ''
            ];
            if (empty($data['title'])) {
                $data['title_err'] = 'Por favor, ingrese el título de la Tarea';
            }
            if (empty($data['due_date'])) {
                $data['due_date_err'] = 'Seleccione la Fecha de Vencimiento';
            }
            if (empty($data['title_err']) && empty($data['due_date_err'])) {
                if ($this->taskModel->create($data)) {
                    setFlashMessage('Tarea Agregada con éxito');
                    redirect('index.php?controller=task&action=index');
                } else {
                    die('Algo esta mal');
                }
            } else {
                require_once 'views/tareas/agregar.php';
            }
        } else {
            redirect('index.php?controller=task&action=add');
        }
    }
    public function edit() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            redirect('index.php?controller=task&action=index');
        }
        $task = $this->taskModel->getTaskById($_GET['id']);
        if (!$task || $task->user_id != $_SESSION['user_id']) {
            redirect('index.php?controller=task&action=index');
        }
        require_once 'views/tareas/editar.php';
    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $_POST['id'],
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'category' => trim($_POST['category']),
                'priority' => trim($_POST['priority']),
                'due_date' => trim($_POST['due_date']),
                'status' => trim($_POST['status']),
                'title_err' => '',
                'due_date_err' => ''
            ];
            if (empty($data['title'])) {
                $data['title_err'] = 'Por favor, ingrese un título';
            }
            if (empty($data['due_date'])) {
                $data['due_date_err'] = 'Seleccione Fecha de Vencimiento';
            }
            if (empty($data['title_err']) && empty($data['due_date_err'])) {
                if ($this->taskModel->update($data)) {
                    setFlashMessage('Tarea actualizada con éxito');
                    redirect('index.php?controller=task&action=index');
                } else {
                    die('Algo esta mal');
                }
            } else {
                $task = (object) $data;
                require_once 'views/tareas/editar.php';
            }
        } else {
            redirect('index.php?controller=task&action=index');
        }
    }
    public function delete() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            redirect('index.php?controller=task&action=index');
        }
        if ($this->taskModel->delete($_GET['id'], $_SESSION['user_id'])) {
            setFlashMessage('Tarea eliminada con éxito');
        } else {
            setFlashMessage('No se puede eliminar la Tarea');
        }
        redirect('index.php?controller=task&action=index');
    }
    
    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $id = $_POST['id'];
            $status = $_POST['status'];
            if ($this->taskModel->updateStatus($id, $_SESSION['user_id'], $status)) {
                setFlashMessage('Tarea actualizada con éxito');
            } else {
                setFlashMessage('No se puede actualizar la Tarea');
            }
            redirect('index.php?controller=task&action=index');
        } else {
            redirect('index.php?controller=task&action=index');
        }
    }
    public function category() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        if (!isset($_GET['category']) || empty($_GET['category'])) {
            redirect('index.php?controller=task&action=index');
        }
        $category = $_GET['category'];
        $tasks = $this->taskModel->getTasksByCategory($_SESSION['user_id'], $category);
        require_once 'views/tareas/categoria.php';
    }
    
    public function status() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        if (!isset($_GET['status']) || empty($_GET['status'])) {
            redirect('index.php?controller=task&action=index');
        }
        $status = $_GET['status'];
        $tasks = $this->taskModel->getTasksByStatus($_SESSION['user_id'], $status);
        require_once 'views/tareas/estado.php';
    }
    
    public function upcoming() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        
        $tasks = $this->taskModel->getUpcomingTasks($_SESSION['user_id']);
        require_once 'views/tareas/proximas.php';
    }
    public function overdue() {
        if (!isLoggedIn()) {
            redirect('index.php?controller=auth&action=login');
        }
        $tasks = $this->taskModel->getOverdueTasks($_SESSION['user_id']);
        require_once 'views/tareas/atrasadas.php';
    }
}

