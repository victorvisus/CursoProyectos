import { validateField, validateForm } from "./validaciones.js";

// --- Configuración de Tailwind ---
tailwind.config = {
  theme: {
    extend: {
      colors: {
        "bg-main": "#0E0E11",
        "card-bg": "#1C1E22",
        "border-base": "#3A3D42",
        "text-sec": "#B5B8BE",
        accent: "#3AFF7A",
        "text-main": "#F2F3F5",
      },
      fontFamily: {
        sans: ['"Source Sans 3"', "sans-serif"],
        title: ["Inter", "sans-serif"],
      },
    },
  },
};

// --- Lógica del Calendario ---

// Inicializar almacenamiento
let citasRegistradas =
  JSON.parse(localStorage.getItem("citasRegistradas")) || [];

// Festivos Zaragoza 2026
const festivosZaragoza2026 = [
  "2026-01-01",
  "2026-01-06",
  "2026-01-29",
  "2026-03-05",
  "2026-04-02",
  "2026-04-03",
  "2026-04-23",
  "2026-05-01",
  "2026-08-15",
  "2026-10-12",
  "2026-11-02",
  "2026-12-07",
  "2026-12-08",
  "2026-12-25",
];

const form = document.getElementById("appointmentForm");
const modalOverlay = document.getElementById("modalOverlay");
const modalContent = document.getElementById("modalContent");
const modalTitle = document.getElementById("modalTitle");
const modalBody = document.getElementById("modalBody");
const dateInput = document.getElementById("date");

// Elementos del calendario visual
const calendarGrid = document.getElementById("calendarGrid");
const calendarMonth = document.getElementById("calendarMonth");
const prevMonthBtn = document.getElementById("prevMonth");
const nextMonthBtn = document.getElementById("nextMonth");
const tooltip = document.getElementById("availabilityTooltip");
const tooltipList = document.getElementById("availableHoursList");

let currentViewDate = new Date();

// Función para validar disponibilidad
function checkAvailability(fecha, hora) {
  return !citasRegistradas.some(
    (cita) => cita.fecha === fecha && cita.hora === hora,
  );
}

// Función para obtener horas disponibles de un día
function getAvailableHours(fecha) {
  const dateObj = new Date(fecha);
  const dayOfWeek = dateObj.getDay();

  // Sábados (6), Domingos (0) o Festivos no se trabaja
  if (
    dayOfWeek === 0 ||
    dayOfWeek === 6 ||
    festivosZaragoza2026.includes(fecha)
  ) {
    return [];
  }

  const allHours = [
    "09:00",
    "10:00",
    "11:00",
    "12:00",
    "13:00",
    "15:00",
    "16:00",
    "17:00",
    "18:00",
  ];

  const now = new Date();
  const today = now.toISOString().split("T")[0];
  const currentHour = now.getHours();
  const currentMinutes = now.getMinutes();

  return allHours.filter((hora) => {
    const isOccupied = !checkAvailability(fecha, hora);
    let isPast = false;

    if (fecha === today) {
      const [h, m] = hora.split(":").map(Number);
      if (h < currentHour || (h === currentHour && m <= currentMinutes)) {
        isPast = true;
      }
    }

    return !isOccupied && !isPast;
  });
}

// Función para renderizar el calendario visual
function renderCalendar() {
  if (!calendarGrid) return;

  calendarGrid.innerHTML = "";
  const year = currentViewDate.getFullYear();
  const month = currentViewDate.getMonth();

  // Nombre del mes
  const monthNames = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];
  calendarMonth.innerText = `${monthNames[month]} ${year}`;

  // Primer día del mes
  const firstDay = new Date(year, month, 1);
  let startDay = firstDay.getDay();
  startDay = startDay === 0 ? 6 : startDay - 1; // Ajuste para que la semana empiece en Lunes (0: Lu, ..., 6: Do)

  // Días totales del mes
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Días del mes anterior para rellenar
  const prevMonthDays = new Date(year, month, 0).getDate();
  for (let i = startDay - 1; i >= 0; i--) {
    const dayDiv = document.createElement("div");
    dayDiv.className = "calendar-day other-month";
    dayDiv.innerText = prevMonthDays - i;
    calendarGrid.appendChild(dayDiv);
  }

  // Días del mes actual
  const todayStr = new Date().toISOString().split("T")[0];
  for (let i = 1; i <= daysInMonth; i++) {
    const dayDiv = document.createElement("div");
    const dateObj = new Date(year, month, i);
    const dayOfWeek = dateObj.getDay(); // 0: Dom, 6: Sab
    const fullDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(i).padStart(2, "0")}`;
    const isHoliday = festivosZaragoza2026.includes(fullDate);

    dayDiv.className = "calendar-day";
    dayDiv.innerText = i;

    if (fullDate === todayStr) dayDiv.classList.add("today");
    if (isHoliday) dayDiv.classList.add("holiday");

    // Bloquear si es pasado o si es fin de semana o festivo
    if (
      fullDate < todayStr ||
      dayOfWeek === 0 ||
      dayOfWeek === 6 ||
      isHoliday
    ) {
      dayDiv.classList.add("disabled");
    } else {
      // Eventos de hover solo para días laborables futuros
      dayDiv.addEventListener("mouseenter", (e) => showTooltip(e, fullDate));
      dayDiv.addEventListener("mouseleave", hideTooltip);

      // Al hacer click, seleccionar en el input
      dayDiv.addEventListener("click", () => {
        dateInput.value = fullDate;
        updateAvailableHours();
        highlightSelectedDay(fullDate);
      });
    }

    calendarGrid.appendChild(dayDiv);
  }
}

function highlightSelectedDay(date) {
  document.querySelectorAll(".calendar-day").forEach((day) => {
    day.classList.remove("selected");
  });

  const [y, m, d] = date.split("-").map(Number);
  if (
    y === currentViewDate.getFullYear() &&
    m - 1 === currentViewDate.getMonth()
  ) {
    const days = document.querySelectorAll(".calendar-day:not(.other-month)");
    if (days[d - 1]) days[d - 1].classList.add("selected");
  }
}

function showTooltip(e, date) {
  const available = getAvailableHours(date);
  tooltipList.innerHTML = "";

  if (available.length === 0) {
    tooltipList.innerHTML = "<li>Sin horas libres</li>";
  } else {
    available.forEach((h) => {
      const li = document.createElement("li");
      li.innerText = `• ${h}`;
      tooltipList.appendChild(li);
    });
  }

  tooltip.classList.remove("hidden");

  const rect = e.target.getBoundingClientRect();
  const parentRect = e.target.offsetParent.getBoundingClientRect();

  tooltip.style.left = `${rect.left - parentRect.left + rect.width + 10}px`;
  tooltip.style.top = `${rect.top - parentRect.top}px`;
}

function hideTooltip() {
  tooltip.classList.add("hidden");
}

// Navegación del calendario
if (prevMonthBtn) {
  prevMonthBtn.addEventListener("click", () => {
    currentViewDate.setMonth(currentViewDate.getMonth() - 1);
    renderCalendar();
  });
}

if (nextMonthBtn) {
  nextMonthBtn.addEventListener("click", () => {
    currentViewDate.setMonth(currentViewDate.getMonth() + 1);
    renderCalendar();
  });
}

// Función para mostrar modal
function showModal(type, data = null) {
  modalOverlay.classList.remove("hidden");
  modalOverlay.classList.add("flex");

  // Animación de entrada
  setTimeout(() => {
    modalContent.classList.remove("scale-95", "opacity-0");
    modalContent.classList.add("scale-100", "opacity-100");
  }, 10);

  if (type === "success") {
    modalTitle.innerText = "¡Cita Confirmada!";
    modalTitle.classList.add("text-accent");
    modalTitle.classList.remove("text-red-500");

    modalBody.innerHTML = `
                    <div class="space-y-2">
                        <p><strong class="text-text-main">Nombre:</strong> ${data.nombre}</p>
                        <p><strong class="text-text-main">Fecha:</strong> ${data.fecha}</p>
                        <p><strong class="text-text-main">Hora:</strong> ${data.hora}</p>
                        <p><strong class="text-text-main">Email:</strong> ${data.email}</p>
                        <p><strong class="text-text-main">Teléfono:</strong> ${data.tel}</p>
                        <div class="mt-4 p-3 bg-bg-main rounded border border-border-base italic text-xs">
                            ${data.comentarios || "Sin comentarios adicionales."}
                        </div>
                    </div>
                `;
  } else {
    modalTitle.innerText = "Error en la reserva";
    modalTitle.classList.add("text-red-500");
    modalTitle.classList.remove("text-accent");

    modalBody.innerHTML = `<p>${data.message}</p>`;
  }
}

// Función para cerrar modal
function closeModal() {
  modalContent.classList.remove("scale-100", "opacity-100");
  modalContent.classList.add("scale-95", "opacity-0");

  setTimeout(() => {
    modalOverlay.classList.add("hidden");
    modalOverlay.classList.remove("flex");
  }, 200);
}

// Función para actualizar horas disponibles
function updateAvailableHours() {
  const selectedDate = dateInput.value;
  const timeSelect = document.getElementById("time");
  if (!timeSelect) return;
  const options = timeSelect.querySelectorAll("option");

  if (!selectedDate) return;

  const available = getAvailableHours(selectedDate);

  options.forEach((option) => {
    if (option.value === "") return;

    if (available.includes(option.value)) {
      option.disabled = false;
      option.classList.remove("text-gray-600");
    } else {
      option.disabled = true;
      option.classList.add("text-gray-600");
    }
  });

  const currentSelected = timeSelect.value;
  if (currentSelected && !available.includes(currentSelected)) {
    timeSelect.value = "";
  }

  highlightSelectedDay(selectedDate);
}

// Manejo del formulario
if (form) {
  // Validación en tiempo real
  ["fullName", "phone", "email"].forEach((id) => {
    const input = document.getElementById(id);
    if (input) {
      input.addEventListener("blur", () => validateField(input));
      input.addEventListener("input", () => {
        if (input.classList.contains("border-red-500")) {
          validateField(input);
        }
      });
    }
  });

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    // Ejecutar todas las validaciones antes de procesar
    if (!validateForm(form)) {
      return;
    }

    const cita = {
      nombre: document.getElementById("fullName").value,
      tel: document.getElementById("phone").value,
      email: document.getElementById("email").value,
      fecha: document.getElementById("date").value,
      hora: document.getElementById("time").value,
      comentarios: document.getElementById("comments").value,
    };

    const available = getAvailableHours(cita.fecha);

    if (available.includes(cita.hora)) {
      // Guardar cita
      citasRegistradas.push(cita);
      localStorage.setItem(
        "citasRegistradas",
        JSON.stringify(citasRegistradas),
      );

      // Mostrar éxito
      showModal("success", cita);

      // Resetear form y actualizar disponibilidad
      form.reset();
      updateAvailableHours();
      renderCalendar(); // Refrescar calendario visual
    } else {
      const dateObj = new Date(cita.fecha);
      const isWeekend = dateObj.getDay() === 0 || dateObj.getDay() === 6;
      const message = isWeekend
        ? "Lo sentimos, no trabajamos los fines de semana."
        : "Este horario ya no está disponible.";
      showModal("error", { message });
      updateAvailableHours();
      renderCalendar();
    }
  });
}

// Init
if (dateInput) {
  const today = new Date().toISOString().split("T")[0];
  dateInput.setAttribute("min", today);
  dateInput.addEventListener("change", () => {
    const selectedDate = dateInput.value;
    if (selectedDate) {
      const [y, m, d] = selectedDate.split("-").map(Number);

      // Si la fecha seleccionada está en otro mes/año, navegar a ese mes
      if (
        y !== currentViewDate.getFullYear() ||
        m - 1 !== currentViewDate.getMonth()
      ) {
        currentViewDate = new Date(y, m - 1, 1);
        renderCalendar();
      }

      updateAvailableHours();
      highlightSelectedDay(selectedDate);
    }
  });
}

renderCalendar();

// Global scope for closeModal
window.closeModal = closeModal;
