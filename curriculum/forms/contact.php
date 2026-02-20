<?php
/**
 * Procesador de formulario de contacto
 * Cypherstudios - Víctor Visús García
 */

require_once __DIR__ . '/../includes/mailer.php';

// Solo procesar si es POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . SITE_URL);
    exit;
}

// Sanitizar y validar datos
$data = [
    'name' => sanitize_input($_POST['name'] ?? ''),
    'email' => sanitize_input($_POST['email'] ?? ''),
    'subject' => sanitize_input($_POST['subject'] ?? ''),
    'message' => sanitize_input($_POST['message'] ?? '')
];

// Enviar email
$result = send_contact_email($data);

// Redirigir con resultado
if ($result['success']) {
    header('Location: ' . SITE_URL . '#contacto?contact=success');
} else {
    header('Location: ' . SITE_URL . '#contacto?contact=error');
}
exit;
?>
