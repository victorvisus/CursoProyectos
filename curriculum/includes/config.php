<?php
/**
 * Configuración del sitio
 * Cypherstudios - Víctor Visús García
 */

// Cargar variables de entorno
function loadEnv($file) {
    if (!file_exists($file)) {
        error_log("Archivo .env no encontrado en: $file");
        return;
    }
    
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        
        if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
            putenv(sprintf('%s=%s', $key, $value));
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

// Cargar archivo .env si existe (buscar en múltiples ubicaciones)
loadEnv(__DIR__ . '/.env');           // Dentro de includes/
loadEnv(__DIR__ . '/../.env');         // En curriculum/
loadEnv(__DIR__ . '/../../.env');       // Fuera de curriculum/

// Configuración SMTP con valores por defecto funcionales
define('SMTP_HOST', $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com');
define('SMTP_PORT', $_ENV['SMTP_PORT'] ?? 587);
define('SMTP_USER', $_ENV['SMTP_USER'] ?? 'victor.vxg@gmail.com');
define('SMTP_PASS', $_ENV['SMTP_PASS'] ?? '');
define('SMTP_SECURE', $_ENV['SMTP_SECURE'] ?? 'tls');

// Emails con valores por defecto
define('EMAIL_TO', $_ENV['EMAIL_TO'] ?? 'victor.vxg@gmail.com');
define('EMAIL_FROM', $_ENV['EMAIL_FROM'] ?? 'noreply@cypherstudios.ddns.net');
define('EMAIL_FROM_NAME', $_ENV['EMAIL_FROM_NAME'] ?? 'Cypherstudios');

// Configuración del sitio con valores por defecto
define('SITE_NAME', $_ENV['SITE_NAME'] ?? 'Cypherstudios');
define('SITE_URL', $_ENV['SITE_URL'] ?? 'https://cypherstudios.ddns.net/victor/curriculum');
define('SITE_AUTHOR', $_ENV['SITE_AUTHOR'] ?? 'Víctor Visús García');
define('SITE_DESCRIPTION', $_ENV['SITE_DESCRIPTION'] ?? 'Diseño y desarrollo web con enfoque técnico y criterio visual');
define('SITE_KEYWORDS', $_ENV['SITE_KEYWORDS'] ?? 'desarrollo web, diseño web, PHP, JavaScript, frontend, backend, portfolio');

// Configuración de seguridad
define('RECAPTCHA_SECRET_KEY', '');
define('RECAPTCHA_SITE_KEY', '');

// Zona horaria
date_default_timezone_set('Europe/Madrid');

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Sesión
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);

// Límites
ini_set('max_execution_time', 30);
ini_set('memory_limit', '128M');
?>