<?php require_once 'views/includes/header.php'; ?>

<div class="content-wrapper">
    <div class="page-header">
        <div class="page-title">
            <h2><i class="fas fa-tasks"></i> Mis Tareas</h2>
        </div>
        <div class="page-actions">
            <a href="index.php?controller=task&action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Tarea
            </a>
        </div>
    </div>

    <?php
    function renderStatCard($icon, $label, $count, $class) {
        echo "
        <div class='stat-card $class'>
            <div class='stat-icon'><i class='fas $icon'></i></div>
            <h3 class='stat-label'>$label</h3>
            <div class='stat-value'>$count</div>
        </div>";
    }

    $pending = array_filter($tasks, fn($task) => $task->status == 'pending');
    $completed = array_filter($tasks, fn($task) => $task->status == 'completed');
    
    $categoryLabels = [
        'school' => 'Colegio',
        'homework' => 'Deberes',
        'exam' => 'Exámenes',
        'project' => 'Proyectos',
        'personal' => 'Personal'
    ];

    $priorityLabels = [
        'low' => 'Baja',
        'medium' => 'Media',
        'high' => 'Alta'
    ];
    ?>

    <div class="stats-container">
        <?php 
            renderStatCard('fa-tasks', 'Total Tareas', count($tasks), 'primary');
            renderStatCard('fa-clock', 'Pendientes', count($pending), 'warning');
            renderStatCard('fa-check-circle', 'Completadas', count($completed), 'success');
        ?>
    </div>

    <?php if (empty($tasks)): ?>
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fas fa-clipboard-list"></i></div>
            <h3>No tienes tareas todavía</h3>
            <p>¡Comienza a organizar tus actividades agregando tu primera tarea!</p>
            <a href="index.php?controller=task&action=add" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Primera Tarea
            </a>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tarea</th>
                                <th>Categoría</th>
                                <th>Prioridad</th>
                                <th>Fecha de Entrega</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td>
                                        <div class="task-name"><?php echo $task->title; ?></div>
                                        <div class="task-description">
                                            <?php echo strlen($task->description) > 50 ? substr($task->description, 0, 50) . '...' : $task->description; ?>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-info"><?php echo $categoryLabels[$task->category] ?? ucfirst($task->category); ?></span></td>
                                    <td>
                                        <?php 
                                        $priorityClass = match($task->priority) {
                                            'high' => 'badge-danger',
                                            'medium' => 'badge-warning',
                                            default => 'badge-success',
                                        };
                                        ?>
                                        <span class="badge <?php echo $priorityClass; ?>">
                                            <?php echo $priorityLabels[$task->priority] ?? ucfirst($task->priority); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="due-date"><?php echo formatDate($task->due_date); ?></div>
                                        <?php if (strtotime($task->due_date) < strtotime(date('Y-m-d')) && $task->status != 'completed'): ?>
                                            <span class="overdue-label">Vencida</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="index.php?controller=task&action=updateStatus" method="POST" class="status-form">
                                            <input type="hidden" name="id" value="<?php echo $task->id; ?>">
                                            <select name="status" onchange="this.form.submit()" class="status-select <?php echo $task->status; ?>">
                                                <option value="pending" <?php echo $task->status == 'pending' ? 'selected' : ''; ?>>Pendiente</option>
                                                <option value="in-progress" <?php echo $task->status == 'in-progress' ? 'selected' : ''; ?>>En Proceso</option>
                                                <option value="completed" <?php echo $task->status == 'completed' ? 'selected' : ''; ?>>Completada</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="index.php?controller=task&action=edit&id=<?php echo $task->id; ?>" class="btn-icon edit" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="index.php?controller=task&action=delete&id=<?php echo $task->id; ?>" class="btn-icon delete"
                                               onclick="return confirm('¿Estás seguro de que deseas eliminar esta tarea?');" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require_once 'views/includes/footer.php'; ?>

