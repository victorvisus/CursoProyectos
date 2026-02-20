<?php
/**
 * Template para el shortcode [tech_calendar]
 */
?>
<div id="tech-calendar-wp-wrapper" class="tech-calendar-plugin-container">
    <main class="tech-calendar-main-grid">
        <!-- Columna Izquierda: Formulario -->
        <section class="tech-calendar-form-section">
            <header class="tech-calendar-header">
                <h1 class="tech-calendar-title">Agendar Cita</h1>
                <p class="tech-calendar-subtitle">Complete el formulario para reservar su espacio técnico.</p>
            </header>

            <form id="appointmentForm" class="tech-calendar-form">
                <div class="tech-calendar-form-row">
                    <div class="tech-calendar-field">
                        <label for="fullName">Nombre y Apellidos</label>
                        <input type="text" id="fullName" required placeholder="Ej. Juan Pérez" />
                        <p id="fullNameError" class="error-text tc-hidden"></p>
                    </div>
                    <div class="tech-calendar-field">
                        <label for="phone">Teléfono</label>
                        <input type="tel" id="phone" required placeholder="+34 600 000 000" />
                        <p id="phoneError" class="error-text tc-hidden"></p>
                    </div>
                </div>

                <div class="tech-calendar-form-row">
                    <div class="tech-calendar-field">
                        <label for="email">Email</label>
                        <input type="email" id="email" required placeholder="juan@ejemplo.com" />
                        <p id="emailError" class="error-text tc-hidden"></p>
                    </div>
                    <div class="tech-calendar-field">
                        <label for="date">Fecha</label>
                        <input type="date" id="date" required />
                    </div>
                </div>

                <div class="tech-calendar-form-row">
                    <div class="tech-calendar-field">
                        <label for="time">Hora</label>
                        <select id="time" required>
                            <option value="" disabled selected>Seleccionar hora</option>
                            <option value="09:00">09:00 - 10:00</option>
                            <option value="10:00">10:00 - 11:00</option>
                            <option value="11:00">11:00 - 12:00</option>
                            <option value="12:00">12:00 - 13:00</option>
                            <option value="13:00">13:00 - 14:00</option>
                            <option value="15:00">15:00 - 16:00</option>
                            <option value="16:00">16:00 - 17:00</option>
                            <option value="17:00">17:00 - 18:00</option>
                            <option value="18:00">18:00 - 19:00</option>
                        </select>
                    </div>
                </div>

                <div class="tech-calendar-field">
                    <label for="comments">Comentarios</label>
                    <textarea id="comments" rows="3" placeholder="Detalles adicionales..."></textarea>
                </div>

                <button type="submit" class="tech-calendar-submit-btn">Agendar Cita</button>
            </form>
        </section>

        <!-- Columna Derecha: Calendario Visual -->
        <aside class="tech-calendar-aside">
            <div class="tech-calendar-visual-box">
                <div class="tech-calendar-nav">
                    <h2 id="calendarMonth" class="tech-calendar-month-title">Febrero 2026</h2>
                    <div class="tech-calendar-btns">
                        <button id="prevMonth" type="button" title="Mes anterior">
                            <svg class="icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                        <button id="nextMonth" type="button" title="Siguiente mes">
                            <svg class="icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                <div class="tech-calendar-week-labels">
                    <div>Lu</div><div>Ma</div><div>Mi</div><div>Ju</div><div>Vi</div><div>Sá</div><div>Do</div>
                </div>

                <div id="calendarGrid" class="tech-calendar-grid"></div>

                <!-- Tooltip -->
                <div id="availabilityTooltip" class="tech-calendar-tooltip tc-hidden">
                    <h4 class="tooltip-title">Disponibilidad</h4>
                    <ul id="availableHoursList" class="tooltip-list"></ul>
                </div>
            </div>

            <!-- Leyenda -->
            <div class="tech-calendar-info-card">
                <p class="legend-item"><span class="dot dot-accent"></span> Pasa el ratón para ver huecos libres.</p>
                <p class="legend-item"><span class="dot dot-gray"></span> Días pasados bloqueados.</p>
                <p class="legend-item"><span class="dot dot-red"></span> Festivos no laborales.</p>
            </div>
        </aside>
    </main>

    <!-- Modal -->
    <div id="modalOverlay" class="tech-calendar-modal-overlay tc-hidden">
        <div id="modalContent" class="tech-calendar-modal-content">
            <div id="modalHeader" class="modal-header">
                <h3 id="modalTitle"></h3>
            </div>
            <div id="modalBody" class="modal-body"></div>
            <div class="modal-footer">
                <button id="closeModalBtn" type="button" class="modal-close-btn">Cerrar</button>
            </div>
        </div>
    </div>
</div>
