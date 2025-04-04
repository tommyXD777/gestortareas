<?php require_once 'views/includes/header.php'; ?>
<div class="content-wrapper">
    <div class="page-header">
        <div class="page-title">
            <a href="index.php?controller=task&action=index" class="back-link">
                <i class="fas fa-arrow-left"></i> Volver a Tareas
            </a>
            <h2><i class="fas fa-plus-circle"></i> Agregar Nueva Tarea</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="index.php?controller=task&action=create" method="POST" class="task-form">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="title" class="form-label required">Título de la Tarea</label>
                        <input type="text" name="title" id="title" class="form-control" 
                               value="<?php echo isset($data['title']) ? $data['title'] : ''; ?>" 
                               placeholder="Escribe un título descriptivo" required>
                        <span class="form-error"><?php echo isset($data['title_err']) ? $data['title_err'] : ''; ?></span>
                    </div>
                    
                    <div class="form-group col-12">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea name="description" id="description" class="form-control" 
                                  placeholder="Describe los detalles de la tarea" rows="4"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="category" class="form-label">Categoría</label>
                        <select name="category" id="category" class="form-control">
                            <option value="school" <?php echo (isset($data['category']) && $data['category'] == 'school') ? 'selected' : ''; ?>>Escuela</option>
                            <option value="homework" <?php echo (isset($data['category']) && $data['category'] == 'homework') ? 'selected' : ''; ?>>Deberes</option>
                            <option value="exam" <?php echo (isset($data['category']) && $data['category'] == 'exam') ? 'selected' : ''; ?>>Exámenes</option>
                            <option value="project" <?php echo (isset($data['category']) && $data['category'] == 'project') ? 'selected' : ''; ?>>Proyectos</option>
                            <option value="personal" <?php echo (isset($data['category']) && $data['category'] == 'personal') ? 'selected' : ''; ?>>Personal</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="priority" class="form-label">Prioridad</label>
                        <select name="priority" id="priority" class="form-control">
                            <option value="low" <?php echo (isset($data['priority']) && $data['priority'] == 'low') ? 'selected' : ''; ?>>Baja</option>
                            <option value="medium" <?php echo (isset($data['priority']) && $data['priority'] == 'medium') ? 'selected' : ''; ?>>Media</option>
                            <option value="high" <?php echo (isset($data['priority']) && $data['priority'] == 'high') ? 'selected' : ''; ?>>Alta</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="due_date" class="form-label required">Fecha de Entrega</label>
                        <input type="date" name="due_date" id="due_date" class="form-control" 
                               value="<?php echo isset($data['due_date']) ? $data['due_date'] : ''; ?>" required>
                        <span class="form-error"><?php echo isset($data['due_date_err']) ? $data['due_date_err'] : ''; ?></span>
                    </div>
                    
                    <div class="form-group col-12">
                        <div class="form-buttons">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Agregar Tarea
                            </button>
                            <a href="index.php?controller=task&action=index" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'views/includes/footer.php'; ?>

