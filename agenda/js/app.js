// Aplicación de Agenda - Script principal

let events = JSON.parse(localStorage.getItem("events")) || [];

const eventInput = document.getElementById("eventInput");
const addBtn = document.getElementById("addBtn");
const eventsList = document.getElementById("eventsList");

/**
 * Añade un evento a la lista de eventos
 *
 * @function addEvent
 */
function addEvent() {
  /**
   * Texto del evento a agregar
   * @type {string}
   */
  const eventText = eventInput.value.trim();

  // Si el texto del evento está vacío, no se puede agregar
  if (eventText === "") {
    alert("Por favor, ingresa un evento");
    return;
  }

  /**
   * Crear un objeto de evento con el texto, fecha y estado
   * @type {{id: number, text: string, completed: boolean, date: string}}
   */
  const event = {
    id: Date.now(),
    text: eventText,
    completed: false,
    date: new Date().toLocaleDateString("es-ES"),
  };

  // Agregar el evento a la lista de eventos y guardar en el local storage
  events.push(event);
  localStorage.setItem("events", JSON.stringify(events));
  eventInput.value = "";
  renderEvents();
  eventInput.focus();
}

// Función para eliminar un evento
function deleteEvent(id) {
  events = events.filter((event) => event.id !== id);
  localStorage.setItem("events", JSON.stringify(events));
  renderEvents();
}

// Función para marcar como completado
function toggleEvent(id) {
  const event = events.find((e) => e.id === id);
  if (event) {
    event.completed = !event.completed;
    localStorage.setItem("events", JSON.stringify(events));
    renderEvents();
  }
}

// Función para renderizar los eventos
function renderEvents() {
  eventsList.innerHTML = "";

  if (events.length === 0) {
    eventsList.innerHTML =
      '<p class="text-gray-400 text-center py-8">No hay eventos yet. ¡Añade uno!</p>';
    return;
  }

  events.forEach((event) => {
    const eventDiv = document.createElement("div");
    eventDiv.className = `event-item flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition ${event.completed ? "opacity-60" : ""}`;

    eventDiv.innerHTML = `
      <input 
        type="checkbox" 
        ${event.completed ? "checked" : ""} 
        onchange="toggleEvent(${event.id})"
        class="w-5 h-5 text-blue-500 cursor-pointer"
      >
      <div class="flex-1">
        <p class="text-gray-800 ${event.completed ? "line-through text-gray-400" : ""}">${event.text}</p>
        <p class="text-sm text-gray-400">${event.date}</p>
      </div>
      <button 
        onclick="deleteEvent(${event.id})"
        class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded transition duration-200 text-sm"
      >
        Eliminar
      </button>
    `;

    eventsList.appendChild(eventDiv);
  });
}

// Event listeners
addBtn.addEventListener("click", addEvent);
eventInput.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    addEvent();
  }
});

// Renderizar eventos al cargar
renderEvents();
