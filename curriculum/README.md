# Cypherstudios - Curriculum Web

Proyecto web profesional simple y mantenible que funciona como curriculum web y portfolio profesional de Cypherstudios (Víctor Visús García).

## 🚀 Características

- ✅ **Producción Ready**: Listo para copiar directamente en un servidor Apache
- 📧 **Formularios Funcionales**: Sistema de contacto con envío de emails
- 🎨 **Diseño Moderno**: Interfaz oscura con acentos verdes tecnológicos
- 📱 **Responsive**: Adaptado para todos los dispositivos
- 🔍 **SEO Optimizado**: Meta tags, Open Graph, Schema.org
- ⚡ **Alto Rendimiento**: Sin dependencias pesadas, CSS/JS vanilla
- 🛡️ **Seguro**: Protección contra inyecciones y validación de datos

## 📋 Requisitos

- Apache2
- PHP 8.3+
- Función `mail()` habilitada
- Sin base de datos
- Sin Node.js/npm

## 🗂️ Estructura de Archivos

```
/curriculum
├── index.php                 # Página principal
├── .htaccess                 # Configuración Apache
├── README.md                 # Este archivo
├── assets/
│   ├── css/
│   │   └── styles.css        # Estilos personalizados
│   ├── js/
│   │   └── main.js          # JavaScript vanilla
│   └── img/
│       └── logo.svg         # Logo del sitio
├── includes/
│   ├── header.php           # Cabecera HTML
│   ├── nav.php              # Navegación
│   ├── footer.php           # Pie de página
│   ├── seo.php              # Funciones SEO
│   ├── config.php           # Configuración del sitio
│   └── mailer.php           # Sistema de emails
└── forms/
    └── contact.php          # Procesador de formulario
```

## 🛠️ Instalación

1. **Subir archivos**: Copia todo el contenido del directorio `curriculum` a tu servidor
2. **Configurar variables de entorno**:
   - Copia `.env.example` a `.env` en el directorio **padre** (fuera del webroot)
   - Configura tus credenciales SMTP y datos del sitio
3. **Permisos**: Asegúrate que Apache tenga permisos de escritura en logs (opcional)
4. **Listo**: ¡Visita tu dominio y funciona!

### ⚠️ Seguridad - Variables de Entorno

**Importante**: Este proyecto usa variables de entorno para máxima seguridad. No hay datos sensibles en el código PHP.

#### Configuración del archivo `.env`:

```bash
# Crear archivo .env fuera del directorio web (ej: /var/www/.env)
SMTP_HOST=smtp.gmail.com
SMTP_PORT=587
SMTP_USER=victor.vxg@gmail.com
SMTP_PASS=tu-contraseña-de-aplicación
SMTP_SECURE=tls

EMAIL_TO=victor.vxg@gmail.com
EMAIL_FROM=noreply@cypherstudios.ddns.net
EMAIL_FROM_NAME=Cypherstudios

SITE_NAME=Cypherstudios
SITE_URL=https://cypherstudios.ddns.net/victor/curriculum
SITE_AUTHOR=Víctor Visús García
SITE_DESCRIPTION=Diseño y desarrollo web con enfoque técnico y criterio visual
SITE_KEYWORDS=desarrollo web, diseño web, PHP, JavaScript, frontend, backend, portfolio
```

#### Estructura segura recomendada:

```
/var/www/
├── .env                    # ← Archivo de configuración (fuera del webroot)
└── curriculum/              # ← Directorio web accesible
    ├── index.php
    ├── includes/
    ├── assets/
    └── .htaccess          # ← Protege archivos sensibles
```

#### Generar Contraseña de Aplicación Gmail:

1. Activa verificación en dos pasos en tu cuenta Google
2. Ve a: https://myaccount.google.com/apppasswords
3. Selecciona "Otra (nombre personalizado)"
4. Escribe "Cypherstudios Web" y genera
5. Copia la contraseña de 16 caracteres generada
6. Úsala en `SMTP_PASS`

## 🎨 Paleta de Colores

- **Negro carbón**: `#0E0E11`
- **Gris antracita**: `#1C1E22`
- **Gris acero**: `#3A3D42`
- **Gris claro técnico**: `#B5B8BE`
- **Blanco técnico**: `#F2F3F5`
- **Verde acento**: `#3AFF7A`

## 📱 Secciones del Sitio

1. **Header**: Logo y navegación principal
2. **Hero**: Presentación profesional con formulario simple
3. **Qué hago**: Servicios ofrecidos
4. **Proyectos**: Portfolio de trabajos
5. **Tecnologías**: Stack técnico
6. **Sobre mí**: Información personal
7. **Contacto**: Formulario completo y datos de contacto

## 🔧 Tecnologías Utilizadas

### Frontend

- **HTML5 Semántico**: Estructura accesible y SEO-friendly
- **Tailwind CSS**: Framework CSS via CDN
- **JavaScript Vanilla**: Funcionalidad sin dependencias
- **Google Fonts**: Inter, Source Sans 3, JetBrains Mono

### Backend

- **PHP 8.3**: Lógica del servidor
- **PHPMailer**: Envío de emails (incluido)
- **Sin Base de Datos**: Arquitectura simple

## 📈 Características SEO

- Meta tags optimizados
- Open Graph para redes sociales
- Twitter Cards
- Schema.org JSON-LD
- URLs amigables
- Imágenes optimizadas
- Estructura semántica HTML5

## 🛡️ Seguridad

- Sanitización de inputs
- Protección contra inyección de headers
- Validación backend
- Headers de seguridad HTTP
- Protección de archivos sensibles

## 📝 Personalización

### Cambiar Información

Edita estos archivos:

- `includes/config.php`: Configuración general
- `index.php`: Contenido principal
- `includes/footer.php`: Datos de contacto

### Modificar Estilos

- Edita `assets/css/styles.css` para cambios visuales
- Los colores están definidos como variables CSS

### Añadir Proyectos

Modifica la sección "Proyectos" en `index.php` siguiendo el patrón existente.

## 🔄 Actualizaciones

Para mantener el proyecto actualizado:

1. **Backup**: Respaldar archivos personalizados
2. **Reemplazar**: Sobrescribir archivos del sistema
3. **Restaurar**: Volver a aplicar personalizaciones

## 📞 Soporte

- **Email**: victor.vxg@gmail.com
- **Web**: https://cypherstudios.ddns.net/victor/curriculum

## 📄 Licencia

Este proyecto es propiedad de Cypherstudios - Víctor Visús García. Todos los derechos reservados.

---

**Desarrollado con ❤️ y mucho café por Cypherstudios**
