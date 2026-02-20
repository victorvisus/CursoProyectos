import { validateField, validateForm } from "./validaciones.js";

/**
 * TechCalendar - Lógica Frontend para WordPress (Independiente de Tailwind)
 */

document.addEventListener("DOMContentLoaded", () => {
  const wrapper = document.getElementById("tech-calendar-wp-wrapper");
  if (!wrapper) return;

  // Referencias DOM
  const form = wrapper.querySelector("#appointmentForm");
  const dateInput = wrapper.querySelector("#date");
  const timeSelect = wrapper.querySelector("#time");
  const calendarGrid = wrapper.querySelector("#calendarGrid");
  const calendarMonth = wrapper.querySelector("#calendarMonth");
  const prevMonthBtn = wrapper.querySelector("#prevMonth");
  const nextMonthBtn = wrapper.querySelector("#nextMonth");
  const tooltip = wrapper.querySelector("#availabilityTooltip");
  const tooltipList = wrapper.querySelector("#availableHoursList");
  const modalOverlay = wrapper.querySelector("#modalOverlay");
  const modalContent = wrapper.querySelector("#modalContent");
  const modalTitle = wrapper.querySelector("#modalTitle");
  const modalBody = wrapper.querySelector("#modalBody");
  const closeModalBtn = wrapper.querySelector("#closeModalBtn");

  let currentViewDate = new Date();
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

  const availabilityCache = {};

  async function getBookedSlotsFromServer(fecha) {
    if (availabilityCache[fecha]) return availabilityCache[fecha];
    const formData = new FormData();
    formData.append("action", "get_booked_slots");
    formData.append("fecha", fecha);
    formData.append("nonce", techCalendarData.nonce);
    try {
      const response = await fetch(techCalendarData.ajax_url, {
        method: "POST",
        body: formData,
      });
      const result = await response.json();
      if (result.success) {
        availabilityCache[fecha] = result.data;
        return result.data;
      }
    } catch (error) {
      console.error("Error:", error);
    }
    return [];
  }

  async function getAvailableHours(fecha) {
    const dateObj = new Date(fecha);
    const dayOfWeek = dateObj.getDay();
    if (
      dayOfWeek === 0 ||
      dayOfWeek === 6 ||
      festivosZaragoza2026.includes(fecha)
    )
      return [];
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
    const bookedSlots = await getBookedSlotsFromServer(fecha);
    return allHours.filter((hora) => {
      const isOccupied = bookedSlots.includes(hora);
      let isPast = false;
      if (fecha === today) {
        const [h] = hora.split(":").map(Number);
        if (h <= currentHour) isPast = true;
      }
      return !isOccupied && !isPast;
    });
  }

  async function renderCalendar() {
    calendarGrid.innerHTML = "";
    const year = currentViewDate.getFullYear();
    const month = currentViewDate.getMonth();
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
    const firstDay = new Date(year, month, 1);
    let startDay = firstDay.getDay();
    startDay = startDay === 0 ? 6 : startDay - 1;
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const prevMonthDays = new Date(year, month, 0).getDate();
    for (let i = startDay - 1; i >= 0; i--) {
      const dayDiv = document.createElement("div");
      dayDiv.className = "calendar-day other-month";
      dayDiv.innerText = prevMonthDays - i;
      calendarGrid.appendChild(dayDiv);
    }
    const todayStr = new Date().toISOString().split("T")[0];
    for (let i = 1; i <= daysInMonth; i++) {
      const dayDiv = document.createElement("div");
      const dateObj = new Date(year, month, i);
      const dayOfWeek = dateObj.getDay();
      const fullDate = `${year}-${String(month + 1).padStart(2, "0")}-${String(i).padStart(2, "0")}`;
      const isHoliday = festivosZaragoza2026.includes(fullDate);
      dayDiv.className = "calendar-day";
      dayDiv.innerText = i;
      if (fullDate === todayStr) dayDiv.classList.add("today");
      if (isHoliday) dayDiv.classList.add("holiday");
      if (
        fullDate < todayStr ||
        dayOfWeek === 0 ||
        dayOfWeek === 6 ||
        isHoliday
      ) {
        dayDiv.classList.add("disabled");
      } else {
        dayDiv.addEventListener("mouseenter", (e) => showTooltip(e, fullDate));
        dayDiv.addEventListener("mouseleave", hideTooltip);
        dayDiv.addEventListener("click", () => {
          dateInput.value = fullDate;
          updateAvailableHours();
          highlightSelectedDay(fullDate);
        });
      }
      calendarGrid.appendChild(dayDiv);
    }
  }

  async function showTooltip(e, date) {
    const available = await getAvailableHours(date);
    tooltipList.innerHTML =
      available.length === 0
        ? "<li>Sin horas libres</li>"
        : available.map((h) => `<li>• ${h}</li>`).join("");

    tooltip.classList.remove("tc-hidden");
    // Forzar reflow para la transición de opacidad
    tooltip.offsetHeight;
    tooltip.classList.add("tc-visible");

    const rect = e.target.getBoundingClientRect();
    const tooltipRect = tooltip.getBoundingClientRect();

    // Posicionamiento inteligente: intentar derecha, si no hay espacio, arriba
    let top = rect.top;
    let left = rect.left + rect.width + 10;

    // Si se sale por la derecha
    if (left + tooltipRect.width > window.innerWidth) {
      left = rect.left - tooltipRect.width - 10;
    }

    // Si se sale por abajo
    if (top + tooltipRect.height > window.innerHeight) {
      top = window.innerHeight - tooltipRect.height - 10;
    }

    tooltip.style.left = `${left}px`;
    tooltip.style.top = `${top}px`;
  }

  function hideTooltip() {
    tooltip.classList.remove("tc-visible");
    setTimeout(() => {
      if (!tooltip.classList.contains("tc-visible")) {
        tooltip.classList.add("tc-hidden");
      }
    }, 200);
  }

  function highlightSelectedDay(date) {
    wrapper
      .querySelectorAll(".calendar-day")
      .forEach((day) => day.classList.remove("selected"));
    const [y, m, d] = date.split("-").map(Number);
    if (
      y === currentViewDate.getFullYear() &&
      m - 1 === currentViewDate.getMonth()
    ) {
      const days = wrapper.querySelectorAll(".calendar-day:not(.other-month)");
      if (days[d - 1]) days[d - 1].classList.add("selected");
    }
  }

  async function updateAvailableHours() {
    const selectedDate = dateInput.value;
    if (!selectedDate) return;
    const available = await getAvailableHours(selectedDate);
    timeSelect.querySelectorAll("option").forEach((opt) => {
      if (opt.value === "") return;
      const isAvail = available.includes(opt.value);
      opt.disabled = !isAvail;
      opt.style.color = isAvail ? "" : "gray";
    });
    if (timeSelect.value && !available.includes(timeSelect.value))
      timeSelect.value = "";
    highlightSelectedDay(selectedDate);
  }

  prevMonthBtn.addEventListener("click", () => {
    currentViewDate.setMonth(currentViewDate.getMonth() - 1);
    renderCalendar();
  });
  nextMonthBtn.addEventListener("click", () => {
    currentViewDate.setMonth(currentViewDate.getMonth() + 1);
    renderCalendar();
  });
  dateInput.addEventListener("change", () => {
    const selectedDate = dateInput.value;
    if (!selectedDate) return;
    const [y, m] = selectedDate.split("-").map(Number);
    if (
      y !== currentViewDate.getFullYear() ||
      m - 1 !== currentViewDate.getMonth()
    ) {
      currentViewDate = new Date(y, m - 1, 1);
      renderCalendar();
    }
    updateAvailableHours();
  });

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    if (!validateForm(form)) return;
    const formData = new FormData();
    formData.append("action", "save_appointment");
    formData.append("nombre", wrapper.querySelector("#fullName").value);
    formData.append("tel", wrapper.querySelector("#phone").value);
    formData.append("email", wrapper.querySelector("#email").value);
    formData.append("fecha", wrapper.querySelector("#date").value);
    formData.append("hora", wrapper.querySelector("#time").value);
    formData.append("comentarios", wrapper.querySelector("#comments").value);
    formData.append("nonce", techCalendarData.nonce);
    try {
      const response = await fetch(techCalendarData.ajax_url, {
        method: "POST",
        body: formData,
      });
      const result = await response.json();
      if (result.success) {
        showModal("success", result.data);
        form.reset();
        delete availabilityCache[result.data.fecha];
        updateAvailableHours();
        renderCalendar();
      } else {
        showModal("error", result.data);
      }
    } catch (error) {
      showModal("error", { message: "Error técnico." });
    }
  });

  function showModal(type, data) {
    modalOverlay.classList.add("tc-flex");
    setTimeout(() => modalContent.classList.add("tc-active"), 10);
    if (type === "success") {
      modalTitle.innerText = "¡Cita Confirmada!";
      modalTitle.style.color = "var(--tc-accent)";
      modalBody.innerHTML = `<p>Gracias ${data.nombre}, tu cita para el día ${data.fecha} a las ${data.hora} ha sido registrada.</p>`;
    } else {
      modalTitle.innerText = "Error";
      modalTitle.style.color = "var(--tc-red)";
      modalBody.innerHTML = `<p>${data.message}</p>`;
    }
  }

  closeModalBtn.addEventListener("click", () => {
    modalContent.classList.remove("tc-active");
    setTimeout(() => modalOverlay.classList.remove("tc-flex"), 200);
  });

  renderCalendar();
});
