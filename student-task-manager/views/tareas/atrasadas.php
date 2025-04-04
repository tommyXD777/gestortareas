<?php require_once 'views/includes/header.php'; ?>

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="index.php?controller=task&action=index" class="text-blue-600 hover:underline mr-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <h2 class="text-2xl font-bold">Tareas Atrasadas</h2>
        </div>
        <a href="index.php?controller=task&action=add" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
            <i class="fas fa-plus mr-2"></i> Agregar Nueva Tarea
        </a>
    </div>
</div>

<?php if (empty($tasks)): ?>
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <p class="text-gray-600 mb-4">No tienes Ninguna Tarea Atrasada. Buen Trabajo!</p>
        <a href="index.php?controller=task&action=add" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">
            <i class="fas fa-plus mr-2"></i> Add a Task
        </a>
    </div>
<?php else: ?>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tareas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioridad</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Vencimiento</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900"><?php echo $task->title; ?></div>
                            <div class="text-sm text-gray-500"><?php echo substr($task->description, 0, 50) . (strlen($task->description) > 50 ? '...' : ''); ?></div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                <?php echo ucfirst($task->category); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if ($task->priority == 'high'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Alta</span>
                            <?php elseif ($task->priority == 'medium'): ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Media</span>
                            <?php else: ?>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Baja</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900"><?php echo formatDate($task->due_date); ?></div>
                            <?php 
                                $today = date('Y-m-d');
                                $due_date = date('Y-m-d', strtotime($task->due_date));
                                $days_overdue = floor((strtotime($today) - strtotime($due_date)) / (60 * 60 * 24));
                            ?>
                            <span class="text-xs text-red-600">
                                <?php echo $days_overdue == 0 ? 'Due today' : ($days_overdue == 1 ? 'Overdue by 1 day' : 'Overdue by ' . $days_overdue . ' days'); ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="index.php?controller=task&action=updateStatus" method="POST" class="inline">
                                <input type="hidden" name="id" value="<?php echo $task->id; ?>">
                                <select name="status" onchange="this.form.submit()" class="text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 <?php
                                    if ($task->status == 'completed') echo 'bg-green-100 text-green-800';
                                    elseif ($task->status == 'in-progress') echo 'bg-blue-100 text-blue-800';
                                    else echo 'bg-yellow-100 text-yellow-800';
                                ?>">
                                    <option value="pending" <?php if ($task->status == 'pending') echo 'selected'; ?>>Pendiente</option>
                                    <option value="in-progress" <?php if ($task->status == 'in-progress') echo 'selected'; ?>>En Proceso</option>
                                    <option value="completed" <?php if ($task->status == 'completed') echo 'selected'; ?>>Completada</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="index.php?controller=task&action=edit&id=<?php echo $task->id; ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="index.php?controller=  Edit
                            </a>
                            <a href="index.php?controller=task&action=delete&id=<?php echo $task->id; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Estás seguro de Eliminar esta Tarea?');">
                                <i class="fas fa-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require_once 'views/includes/footer.php'; ?>

