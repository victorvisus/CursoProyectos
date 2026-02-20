# TechCalendar - Sistema de Gestión de Citas

TechCalendar es una aplicación web ligera y profesional para la gestión de reservas técnicas. Ha sido diseñada con un enfoque en la experiencia de usuario, ofreciendo validaciones avanzadas en tiempo real y una interfaz visual interactiva.

## 📁 Estructura del Proyecto

El proyecto sigue una arquitectura modular y de separación de intereses (Separation of Concerns):

```text
proyecto-calendario/
├── calendario_citas.html  # Estructura principal y maquetación responsiva
├── css/
│   └── style_citas.css    # Diseño personalizado y componentes visuales
├── js/
│   ├── app_citas.js       # Lógica de negocio y orquestación (Módulo ES6)
│   └── validaciones.js    # Módulo especializado en validación de datos
└── README.md              # Documentación técnica
```

## 🚀 Funcionalidades Destacadas

1.  **Calendario Visual Interactivo**:
    - Navegación por meses y sincronización bidireccional con el formulario.
    - Días laborables vs. festivos claramente diferenciados.
2.  **Validación de Formulario Avanzada**:
    - **Módulo Independiente**: Lógica de validación desacoplada en `validaciones.js`.
    - **Tiempo Real**: Feedback inmediato mediante colores y mensajes de error al completar campos (Nombre, Teléfono, Email).
    - **Seguridad**: Bloqueo de envío si los datos no cumplen los requisitos técnicos.
3.  **Consulta de Disponibilidad (Hover)**:
    - Información instantánea de huecos libres al pasar el ratón sobre días laborables.
    - Filtro inteligente de citas previas y horas pasadas.
4.  **Gestión de No Laborables (Zaragoza 2026)**:
    - Bloqueo automático de **fines de semana**.
    - Integración de los **festivos de Zaragoza** (marcados en rojo), impidiendo citas en días como San Valero o la Cincomarzada.
5.  **Tecnología y Estética**:
    - Arquitectura basada en **Módulos ES6**.
    - Diseño _Premium_ con Tailwind CSS, persistencia en `localStorage` y modales animados.

## 🛠️ Tecnologías

- **JavaScript Moderno (ES6 Modules)**: Código limpio y mantenible.
- **Tailwind CSS**: Estilizado moderno y responsivo.
- **HTML5 & CSS3**: Estructura semántica y diseño visual avanzado.

## 📖 Instrucciones de Uso

1.  Abre `calendario_citas.html` en un navegador moderno (requiere soporte para módulos JS).
2.  **Completa el formulario**: Introduce tus datos. Verás avisos en rojo si el formato de texto, teléfono o email es incorrecto.
3.  **Elige tu fecha**: Haz clic en el calendario o usa el selector. Los domingos, sábados y festivos de Zaragoza estarán deshabilitados.
4.  **Verifica la hora**: Antes de seleccionar, puedes pasar el ratón por los días del calendario para ver qué horas están disponibles.
5.  **Confirma**: Agenda tu cita y recibe una confirmación instantánea a través del modal.
