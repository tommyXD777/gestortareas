/**
 * Student Task Manager - Main JavaScript
 * Este archivo contiene todas las funcionalidades JavaScript para la aplicación
 */

document.addEventListener("DOMContentLoaded", () => {
  // Inicializar todos los componentes
  initializeComponents()

  // Configurar listeners para elementos interactivos
  setupEventListeners()

  // Animaciones de entrada
  runEntranceAnimations()
})

/**
 * Inicializa todos los componentes de la aplicación
 */
function initializeComponents() {
  // Inicializar menú móvil
  initializeMobileMenu()

  // Inicializar mensajes flash
  initializeFlashMessages()

  // Inicializar tooltips
  initializeTooltips()

  // Inicializar validación de formularios
  initializeFormValidation()

  // Inicializar datepickers
  initializeDatepickers()
}

/**
 * Configura el menú móvil
 */
function initializeMobileMenu() {
  // Toggle para el menú móvil
  const mobileMenuButton = document.querySelector(".mobile-menu-button")
  const mobileMenu = document.getElementById("mobile-menu")

  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener("click", () => {
      mobileMenu.classList.toggle("hidden")
    })
  }

  // Toggle para los submenús en móvil
  const dropdownToggles = document.querySelectorAll(".mobile-dropdown-toggle")

  dropdownToggles.forEach((toggle) => {
    toggle.addEventListener("click", function () {
      const menu = this.nextElementSibling
      menu.classList.toggle("hidden")

      // Cambiar el ícono
      const icon = this.querySelector(".fas.fa-chevron-down, .fas.fa-chevron-up")
      if (icon) {
        if (menu.classList.contains("hidden")) {
          icon.classList.remove("fa-chevron-up")
          icon.classList.add("fa-chevron-down")
        } else {
          icon.classList.remove("fa-chevron-down")
          icon.classList.add("fa-chevron-up")
        }
      }
    })
  })
}

/**
 * Configura los mensajes flash para que desaparezcan automáticamente
 */
function initializeFlashMessages() {
  const flashMessages = document.querySelectorAll('[role="alert"]')
  flashMessages.forEach((message) => {
    setTimeout(() => {
      message.classList.add("opacity-80")
      setTimeout(() => {
        message.style.transition = "opacity 1s ease-in-out"
        message.classList.add("opacity-0")
        setTimeout(() => {
          message.remove()
        }, 1000)
      }, 3000)
    }, 2000)
  })
}

/**
 * Inicializa tooltips para elementos con el atributo data-tooltip
 */
function initializeTooltips() {
  const tooltipElements = document.querySelectorAll("[data-tooltip]")

  tooltipElements.forEach((element) => {
    element.addEventListener("mouseenter", function () {
      const tooltipText = this.getAttribute("data-tooltip")

      // Crear el tooltip
      const tooltip = document.createElement("div")
      tooltip.className = "tooltip"
      tooltip.textContent = tooltipText

      // Posicionar y mostrar el tooltip
      document.body.appendChild(tooltip)

      const rect = this.getBoundingClientRect()
      tooltip.style.top = rect.top - tooltip.offsetHeight - 10 + "px"
      tooltip.style.left = rect.left + rect.width / 2 - tooltip.offsetWidth / 2 + "px"
      tooltip.style.opacity = "1"

      // Guardar referencia al tooltip
      this._tooltip = tooltip
    })

    element.addEventListener("mouseleave", function () {
      if (this._tooltip) {
        this._tooltip.remove()
        this._tooltip = null
      }
    })
  })
}

/**
 * Inicializa la validación de formularios
 */
function initializeFormValidation() {
  const forms = document.querySelectorAll("form[data-validate]")

  forms.forEach((form) => {
    form.addEventListener("submit", (e) => {
      let isValid = true

      // Validar campos requeridos
      const requiredFields = form.querySelectorAll("[required]")
      requiredFields.forEach((field) => {
        if (!field.value.trim()) {
          isValid = false
          showFieldError(field, "Este campo es obligatorio")
        } else {
          clearFieldError(field)
        }
      })

      // Validar emails
      const emailFields = form.querySelectorAll('input[type="email"]')
      emailFields.forEach((field) => {
        if (field.value.trim() && !isValidEmail(field.value)) {
          isValid = false
          showFieldError(field, "Por favor, introduce un email válido")
        }
      })

      // Validar contraseñas
      const passwordField = form.querySelector('input[name="password"]')
      const confirmPasswordField = form.querySelector('input[name="confirm_password"]')

      if (passwordField && confirmPasswordField) {
        if (passwordField.value.trim() && passwordField.value.length < 6) {
          isValid = false
          showFieldError(passwordField, "La contraseña debe tener al menos 6 caracteres")
        }

        if (passwordField.value !== confirmPasswordField.value) {
          isValid = false
          showFieldError(confirmPasswordField, "Las contraseñas no coinciden")
        }
      }

      if (!isValid) {
        e.preventDefault()
      }
    })
  })
}

/**
 * Muestra un mensaje de error para un campo de formulario
 */
function showFieldError(field, message) {
  // Limpiar error anterior
  clearFieldError(field)

  // Añadir clase de error
  field.classList.add("border-red-500")

  // Crear mensaje de error
  const errorElement = document.createElement("p")
  errorElement.className = "text-red-500 text-sm mt-1"
  errorElement.textContent = message

  // Insertar después del campo
  field.parentNode.insertBefore(errorElement, field.nextSibling)
}

/**
 * Limpia el mensaje de error de un campo
 */
function clearFieldError(field) {
  field.classList.remove("border-red-500")

  // Buscar y eliminar mensaje de error
  const nextSibling = field.nextSibling
  if (nextSibling && nextSibling.tagName === "P" && nextSibling.classList.contains("text-red-500")) {
    nextSibling.remove()
  }
}

/**
 * Valida un email
 */
function isValidEmail(email) {
  const re =
    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  return re.test(String(email).toLowerCase())
}

/**
 * Inicializa datepickers para campos de fecha
 */
function initializeDatepickers() {
  // Si se está usando una librería de datepicker, inicializarla aquí
  // Por ejemplo, flatpickr o similar

  // Ejemplo básico para prevenir fechas pasadas en campos de fecha
  const dateInputs = document.querySelectorAll('input[type="date"]')

  dateInputs.forEach((input) => {
    // Si el campo no tiene un valor mínimo establecido, establecer la fecha actual como mínimo
    if (!input.hasAttribute("min") && !input.classList.contains("allow-past-dates")) {
      const today = new Date().toISOString().split("T")[0]
      input.setAttribute("min", today)
    }
  })
}

/**
 * Configura listeners para elementos interactivos
 */
function setupEventListeners() {
  // Confirmación para eliminar
  const deleteButtons = document.querySelectorAll("[data-confirm]")

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      const message = this.getAttribute("data-confirm") || "¿Estás seguro de que deseas eliminar este elemento?"

      if (!confirm(message)) {
        e.preventDefault()
      }
    })
  })

  // Cambio de estado de tareas
  const statusSelects = document.querySelectorAll('select[name="status"]')

  statusSelects.forEach((select) => {
    select.addEventListener("change", function () {
      // Si el select está dentro de un formulario con data-auto-submit, enviarlo
      const form = this.closest("form[data-auto-submit]")
      if (form) {
        form.submit()
      }
    })
  })
}

/**
 * Ejecuta animaciones de entrada para elementos
 */
function runEntranceAnimations() {
  // Animar elementos con la clase animate-on-load
  const animatedElements = document.querySelectorAll(".animate-on-load")

  animatedElements.forEach((element, index) => {
    setTimeout(() => {
      element.classList.add("animate-fade-in")
      element.style.opacity = "1"
    }, index * 100) // Escalonar las animaciones
  })
}

/**
 * Función para mostrar/ocultar contraseñas
 * Si se proporciona un ID, usa ese elemento específico
 * Si no, asume que el ícono está cerca del campo de entrada
 */
function togglePasswordVisibility(inputId) {
  let passwordInput, icon

  if (inputId) {
    // Si se proporciona un ID, obtener ese elemento específico
    passwordInput = document.getElementById(inputId)
    // Buscar el ícono dentro del contenedor padre
    icon = passwordInput.parentNode.querySelector(".fa-eye, .fa-eye-slash")
  } else {
    // Si se llama sin argumentos, asumir que estamos usando el evento click
    // y el botón está cerca del campo de contraseña
    const button = event.currentTarget
    const inputContainer = button.closest(".relative")
    passwordInput = inputContainer.querySelector('input[type="password"], input[type="text"]')
    icon = button.querySelector(".fa-eye, .fa-eye-slash")
  }

  if (!passwordInput || !icon) return

  if (passwordInput.type === "password") {
    passwordInput.type = "text"
    icon.classList.remove("fa-eye")
    icon.classList.add("fa-eye-slash")
  } else {
    passwordInput.type = "password"
    icon.classList.remove("fa-eye-slash")
    icon.classList.add("fa-eye")
  }
}

/**
 * Función para filtrar tareas en tablas
 */
function filterTasks(input, tableId) {
  const filter = input.value.toUpperCase()
  const table = document.getElementById(tableId)
  const rows = table.getElementsByTagName("tr")

  for (let i = 1; i < rows.length; i++) {
    // Empezar desde 1 para omitir el encabezado
    const cells = rows[i].getElementsByTagName("td")
    let found = false

    for (let j = 0; j < cells.length; j++) {
      const cell = cells[j]
      if (cell) {
        const text = cell.textContent || cell.innerText
        if (text.toUpperCase().indexOf(filter) > -1) {
          found = true
          break
        }
      }
    }

    rows[i].style.display = found ? "" : "none"
  }
}

/**
 * Función para ordenar tablas
 */
function sortTable(tableId, columnIndex) {
  const table = document.getElementById(tableId)
  let switching = true
  let direction = "asc"
  let switchcount = 0

  while (switching) {
    switching = false
    const rows = table.rows

    let i // Declare i here
    for (i = 1; i < rows.length - 1; i++) {
      let shouldSwitch = false // Declare shouldSwitch here
      const x = rows[i].getElementsByTagName("td")[columnIndex]
      const y = rows[i + 1].getElementsByTagName("td")[columnIndex]

      if (direction === "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true
          break
        }
      } else if (direction === "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true
          break
        }
      }
    }

    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i])
      switching = true
      switchcount++
    } else {
      if (switchcount === 0 && direction === "asc") {
        direction = "desc"
        switching = true
      }
    }
  }

  // Actualizar indicadores de ordenación
  const headers = table.getElementsByTagName("th")
  for (let i = 0; i < headers.length; i++) {
    headers[i].classList.remove("sorting-asc", "sorting-desc")
  }

  const currentHeader = headers[columnIndex]
  currentHeader.classList.add(direction === "asc" ? "sorting-asc" : "sorting-desc")
}

/**
 * Función para mostrar/ocultar secciones
 */
function toggleSection(sectionId, buttonId) {
  const section = document.getElementById(sectionId)
  const button = document.getElementById(buttonId)

  if (section.classList.contains("hidden")) {
    section.classList.remove("hidden")
    button.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Ocultar'
  } else {
    section.classList.add("hidden")
    button.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Mostrar'
  }
}

/**
 * Función para cambiar entre modo claro y oscuro
 * Nota: Requiere configuración adicional de CSS para soportar modo oscuro
 */
function toggleDarkMode() {
  document.body.classList.toggle("dark-mode")

  // Guardar preferencia en localStorage
  const isDarkMode = document.body.classList.contains("dark-mode")
  localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled")
}

// Verificar preferencia de modo oscuro al cargar
if (localStorage.getItem("darkMode") === "enabled") {
  document.body.classList.add("dark-mode")
}

