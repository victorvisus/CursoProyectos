# 📅 Aplicación Agenda

Una aplicación web moderna y responsiva para gestionar tu lista de eventos y tareas diarias, construida con **Tailwind CSS** y JavaScript puro.

## 🎯 Características

✅ **Agregar eventos** - Crea nuevos eventos fácilmente  
✅ **Marcar como completado** - Marca eventos completados con un checkbox  
✅ **Eliminar eventos** - Elimina eventos que ya no necesitas  
✅ **Almacenamiento persistente** - Usa localStorage para guardar tus datos  
✅ **Diseño responsivo** - Funciona perfectamente en móvil, tablet y escritorio  
✅ **Interfaz moderna** - Utiliza Tailwind CSS para un diseño limpio y atractivo  
✅ **Sin dependencias externas** - JavaScript vanilla, sin frameworks complicados

## 📁 Estructura del Proyecto

```
agenda/
├── index.html              # Página principal de la aplicación
├── package.json            # Dependencias y scripts del proyecto
├── tailwind.config.js      # Configuración de Tailwind CSS
├── README.md               # Este archivo
├── css/
│   └── styles.css          # Estilos personalizados y animaciones
├── js/
│   └── app.js              # Lógica principal de la aplicación
├── src/                    # Folder para componentes futuros
└── images/                 # Folder para imágenes del proyecto
```

## 🚀 Inicio Rápido

### Opción 1: Usando el CDN de Tailwind (Recomendado para empezar)

1. **Abre el archivo** `index.html` directamente en tu navegador
2. ¡La aplicación está lista para usar!

No requiere instalación de dependencias. Tailwind CSS se carga automáticamente desde el CDN.

### Opción 2: Instalación Local con npm

Si quieres compilar Tailwind localmente:

```bash
# Instala las dependencias
npm install

# Inicia el modo desarrollo (watch)
npm run dev

# Crea una build optimizada
npm run build
```

## 💻 Uso

### Agregar un evento

1. Escribe el evento en el campo de entrada
2. Haz clic en el botón "Añadir" o presiona **Enter**

### Marcar como completado

- Haz clic en el checkbox junto a un evento para marcarlo como completado
- El evento aparecerá atenuado y con línea cruzada

### Eliminar un evento

- Haz clic en el botón rojo "Eliminar" para remover un evento

## 🛠️ Tecnologías Utilizadas

- **HTML5** - Estructura semántica
- **Tailwind CSS** - Framework de utilidades CSS
- **JavaScript (ES6+)** - Lógica de la aplicación
- **LocalStorage API** - Almacenamiento de datos en el navegador

## 📝 Archivos Principales

### index.html

Contiene la estructura HTML de la aplicación con:

- Formulario de entrada para nuevos eventos
- Contenedor para la lista de eventos
- Referencias a CSS y JavaScript

### js/app.js

Implementa toda la funcionalidad:

- `addEvent()` - Agrega un nuevo evento
- `deleteEvent(id)` - Elimina un evento por ID
- `toggleEvent(id)` - Marca como completado/incompleto
- `renderEvents()` - Renderiza la lista de eventos en la UI
- Manejo de eventos del teclado y botones

### css/styles.css

Estilos personalizados:

- Animación `slideIn` para nuevos eventos
- Tipografía personalizada
- Mejoras visuales adicionales

### tailwind.config.js

Configuración de Tailwind CSS:

- Ruta de archivos de contenido
- Definición de colores personalizados (primary y secondary)
- Extensiones del tema

### package.json

Dependencias y scripts:

- `tailwindcss` - Framework CSS
- `autoprefixer` - Compatibilidad con navegadores antiguos
- `postcss` - Procesador de CSS

## 💾 Almacenamiento de Datos

Los eventos se guardan automáticamente en el **localStorage** del navegador. Esto significa:

- Los datos persisten incluso después de cerrar el navegador
- No se requiere un servidor backend
- Los datos se almacenan localmente en tu máquina

Estructura del objeto evento:

```javascript
{
  id: timestamp,           // Identificador único
  text: "Mi evento",       // Texto del evento
  completed: false,        // Estado de completado
  date: "26/02/2026"       // Fecha de creación
}
```

## 🎨 Personalización

### Cambiar colores

Edita `tailwind.config.js`:

```javascript
theme: {
  extend: {
    colors: {
      primary: '#TU_COLOR',
      secondary: '#TU_COLOR',
    }
  },
}
```

### Agregar nuevas funcionalidades

- Edita `js/app.js` para agregar lógica nueva
- Usa clases de Tailwind en `index.html` para cambios visuales
- Agrega estilos personalizados en `css/styles.css`

## 📱 Compatibilidad

- ✅ Chrome/Chromium
- ✅ Firefox
- ✅ Safari
- ✅ Edge
- ✅ Navegadores móviles modernos

## 🐛 Posibles Mejoras Futuras

- [ ] Categorías de eventos
- [ ] Filtrar por estado (completado/pendiente)
- [ ] Búsqueda de eventos
- [ ] Editar eventos existentes
- [ ] Notificaciones
- [ ] Exportar/Importar datos
- [ ] Tema oscuro
- [ ] Sincronización en la nube

## 📄 Licencia

MIT - Siéntete libre de usar este proyecto como base para tus propios proyectos.

## 👨‍💻 Autor

Creado para el Curso de Proyectos - Sesión de Febrero 2026

---

¡Disfruta organizando tu agenda! 📝
