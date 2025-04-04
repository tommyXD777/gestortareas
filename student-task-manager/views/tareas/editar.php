<?php require_once 'views/includes/header.php'; ?>

<div class="task-edit-container">
  <div class="task-edit-header">
    <a href="index.php?controller=task&action=index" class="back-link">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m15 18-6-6 6-6"/>
      </svg>
      <span>Volver</span>
    </a>
    <h1 class="page-title">Editar Tarea</h1>
  </div>

  <div class="task-edit-form-container">
    <form action="index.php?controller=task&action=update" method="POST" class="task-edit-form">
      <input type="hidden" name="id" value="<?php echo $task->id; ?>">
      
      <div class="form-group">
        <label for="title">
          Título <span class="required">*</span>
        </label>
        <input 
          type="text" 
          name="title" 
          id="title" 
          value="<?php echo $task->title; ?>" 
          required
        >
        <?php if(isset($data['title_err'])): ?>
          <p class="error-message"><?php echo $data['title_err']; ?></p>
        <?php endif; ?>
      </div>

      <div class="form-group">
        <label for="description">Descripción</label>
        <textarea 
          name="description" 
          id="description" 
          rows="4"
        ><?php echo $task->description; ?></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="category">Categoría</label>
          <div class="select-wrapper">
            <select name="category" id="category">
              <option value="school" <?php echo ($task->category == 'school') ? 'selected' : ''; ?>>Colegio</option>
              <option value="homework" <?php echo ($task->category == 'homework') ? 'selected' : ''; ?>>Deberes</option>
              <option value="exam" <?php echo ($task->category == 'exam') ? 'selected' : ''; ?>>Exámenes</option>
              <option value="project" <?php echo ($task->category == 'project') ? 'selected' : ''; ?>>Proyectos</option>
              <option value="personal" <?php echo ($task->category == 'personal') ? 'selected' : ''; ?>>Personal</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="priority">Prioridad</label>
          <div class="select-wrapper">
            <select name="priority" id="priority">
              <option value="high" <?php echo ($task->priority == 'high') ? 'selected' : ''; ?>>Alta</option>
              <option value="medium" <?php echo ($task->priority == 'medium') ? 'selected' : ''; ?>>Media</option>
              <option value="low" <?php echo ($task->priority == 'low') ? 'selected' : ''; ?>>Baja</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="due_date">
            Fecha de Vencimiento <span class="required">*</span>
          </label>
          <div class="date-wrapper">
            <input 
              type="date" 
              name="due_date" 
              id="due_date" 
              value="<?php echo $task->due_date; ?>" 
              required
            >
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
              <line x1="16" x2="16" y1="2" y2="6"/>
              <line x1="8" x2="8" y1="2" y2="6"/>
              <line x1="3" x2="21" y1="10" y2="10"/>
            </svg>
          </div>
          <?php if(isset($data['due_date_err'])): ?>
            <p class="error-message"><?php echo $data['due_date_err']; ?></p>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="status">Estado</label>
          <div class="select-wrapper">
            <select name="status" id="status">
              <option value="pending" <?php echo ($task->status == 'pending') ? 'selected' : ''; ?>>Pendiente</option>
              <option value="in-progress" <?php echo ($task->status == 'in-progress') ? 'selected' : ''; ?>>En Proceso</option>
              <option value="completed" <?php echo ($task->status == 'completed') ? 'selected' : ''; ?>>Completada</option>
            </select>
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" name="submit" class="btn btn-primary">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/>
            <polyline points="7 3 7 8 15 8"/>
          </svg>
          Actualizar Tarea
        </button>
        <a href="index.php?controller=task&action=index" class="btn btn-secondary">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<style>
/* Variables globales */
:root {
  --bg-main: #0f172a;
  --bg-surface: #1e293b;
  --bg-surface-hover: #334155;
  --bg-input: #1e293b;
  --bg-input-focus: #1e293b;
  --text-primary: #f8fafc;
  --text-secondary: #cbd5e1;
  --text-muted: #94a3b8;
  --border-color: #334155;
  --border-focus: #60a5fa;
  --accent-color: #3b82f6;
  --accent-hover: #2563eb;
  --error-color: #ef4444;
  --success-color: #10b981;
  --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --radius-sm: 0.25rem;
  --radius-md: 0.375rem;
  --radius-lg: 0.5rem;
  --transition: all 0.2s ease;
}

/* Estilos generales */
body {
  background-color: var(--bg-main);
  color: var(--text-primary);
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
  line-height: 1.5;
}

/* Contenedor principal */
.task-edit-container {
  max-width: 800px;
  margin: 2rem auto;
  padding: 0 1rem;
}

/* Encabezado */
.task-edit-header {
  display: flex;
  align-items: center;
  margin-bottom: 1.5rem;
}

.back-link {
  display: flex;
  align-items: center;
  color: var(--accent-color);
  text-decoration: none;
  font-weight: 500;
  margin-right: 1rem;
  transition: var(--transition);
}

.back-link:hover {
  color: var(--accent-hover);
}

.back-link svg {
  margin-right: 0.5rem;
}

.page-title {
  font-size: 1.875rem;
  font-weight: 700;
  color: var(--text-primary);
  margin: 0;
}

/* Contenedor del formulario */
.task-edit-form-container {
  background-color: var(--bg-surface);
  border-radius: var(--radius-lg);
  box-shadow: var(--shadow-lg);
  overflow: hidden;
}

/* Formulario */
.task-edit-form {
  padding: 2rem;
}

/* Grupos de formulario */
.form-group {
  margin-bottom: 1.5rem;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1.5rem;
  margin-bottom: 1.5rem;
}

@media (min-width: 640px) {
  .form-row {
    grid-template-columns: 1fr 1fr;
  }
}

/* Etiquetas */
label {
  display: block;
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--text-secondary);
  margin-bottom: 0.5rem;
}

.required {
  color: var(--error-color);
  margin-left: 0.25rem;
}

/* Campos de entrada */
input[type="text"],
input[type="date"],
textarea,
select {
  width: 100%;
  padding: 0.75rem 1rem;
  background-color: var(--bg-input);
  color: var(--text-primary);
  border: 1px solid var(--border-color);
  border-radius: var(--radius-md);
  font-size: 1rem;
  transition: var(--transition);
  appearance: none;
}

input[type="text"]:focus,
input[type="date"]:focus,
textarea:focus,
select:focus {
  outline: none;
  border-color: var(--border-focus);
  box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.3);
}

textarea {
  resize: vertical;
  min-height: 100px;
}

/* Contenedores de select */
.select-wrapper {
  position: relative;
}

.select-wrapper::after {
  content: '';
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid var(--text-secondary);
  pointer-events: none;
}

/* Contenedor de fecha */
.date-wrapper {
  position: relative;
}

.date-wrapper svg {
  position: absolute;
  top: 50%;
  right: 1rem;
  transform: translateY(-50%);
  color: var(--text-secondary);
  pointer-events: none;
}

/* Mensajes de error */
.error-message {
  color: var(--error-color);
  font-size: 0.875rem;
  margin-top: 0.5rem;
}

/* Botones de acción */
.form-actions {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  margin-top: 2rem;
}

@media (min-width: 640px) {
  .form-actions {
    flex-direction: row;
  }
}

.btn {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  font-weight: 500;
  border-radius: var(--radius-md);
  cursor: pointer;
  transition: var(--transition);
  text-decoration: none;
  border: none;
  flex: 1;
}

.btn svg {
  margin-right: 0.5rem;
}

.btn-primary {
  background-color: var(--accent-color);
  color: white;
}

.btn-primary:hover {
  background-color: var(--accent-hover);
  transform: translateY(-1px);
  box-shadow: var(--shadow-md);
}

.btn-secondary {
  background-color: var(--bg-surface-hover);
  color: var(--text-primary);
}

.btn-secondary:hover {
  background-color: var(--border-color);
  transform: translateY(-1px);
  box-shadow: var(--shadow-md);
}

/* Efectos de hover y focus */
input:hover,
textarea:hover,
select:hover {
  border-color: var(--text-muted);
}

/* Personalización de campos de fecha */
input[type="date"]::-webkit-calendar-picker-indicator {
  opacity: 0;
  position: absolute;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

/* Animaciones */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.task-edit-form-container {
  animation: fadeIn 0.3s ease-out;
}

/* Mejoras de accesibilidad */
input:focus, 
textarea:focus, 
select:focus, 
button:focus, 
a:focus {
  outline: none;
  box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.5);
}

/* Estilos para estados de botones */
.btn:active {
  transform: translateY(0);
  box-shadow: var(--shadow-sm);
}

/* Mejoras para dispositivos móviles */
@media (max-width: 480px) {
  .task-edit-form {
    padding: 1.5rem;
  }
  
  .page-title {
    font-size: 1.5rem;
  }
  
  .btn {
    padding: 0.75rem 1rem;
  }
}
</style>

