<?php
/**
 * Sistema de envío de emails
 * Cypherstudios - Víctor Visús García
 */

require_once __DIR__ . '/config.php';

/**
 * Enviar email usando PHP mail() como fallback
 */
function send_email($to, $subject, $message, $from_email = null, $from_name = null) {
    $headers = [];
    
    // Headers básicos
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    
    // From
    $from_email = $from_email ?: EMAIL_FROM;
    $from_name = $from_name ?: EMAIL_FROM_NAME;
    $headers[] = "From: " . $from_name . " <" . $from_email . ">";
    $headers[] = "Reply-To: " . $from_email;
    $headers[] = "X-Mailer: PHP/" . phpversion();
    
    // Enviar email
    return mail($to, $subject, $message, implode("\r\n", $headers));
}

/**
 * Preparar email de contacto
 */
function prepare_contact_email($name, $email, $subject, $message) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Desconocida';
    $date = date('d/m/Y H:i:s');
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Desconocido';
    
    $html_message = "
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Nuevo mensaje desde Cypherstudios</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: #0E0E11; color: #3AFF7A; padding: 20px; text-align: center; }
            .content { padding: 20px; background: #f9f9f9; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #0E0E11; }
            .value { background: #fff; padding: 10px; border-left: 3px solid #3AFF7A; margin-top: 5px; }
            .footer { background: #1C1E22; color: #B5B8BE; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1>Nuevo mensaje desde Cypherstudios</h1>
        </div>
        <div class='content'>
            <div class='field'>
                <div class='label'>Nombre:</div>
                <div class='value'>" . htmlspecialchars($name) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Email:</div>
                <div class='value'>" . htmlspecialchars($email) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Asunto:</div>
                <div class='value'>" . htmlspecialchars($subject) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Mensaje:</div>
                <div class='value'>" . nl2br(htmlspecialchars($message)) . "</div>
            </div>
            <div class='field'>
                <div class='label'>IP del remitente:</div>
                <div class='value'>" . htmlspecialchars($ip) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Fecha y hora:</div>
                <div class='value'>" . htmlspecialchars($date) . "</div>
            </div>
            <div class='field'>
                <div class='label'>Navegador:</div>
                <div class='value'>" . htmlspecialchars($user_agent) . "</div>
            </div>
        </div>
        <div class='footer'>
            <p>Este mensaje fue enviado desde el formulario de contacto de Cypherstudios</p>
            <p>" . SITE_URL . "</p>
        </div>
    </body>
    </html>";
    
    return $html_message;
}

/**
 * Validar datos del formulario
 */
function validate_contact_form($data) {
    $errors = [];
    
    // Nombre
    if (empty($data['name']) || strlen($data['name']) < 2) {
        $errors['name'] = 'El nombre es obligatorio y debe tener al menos 2 caracteres';
    }
    
    // Email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El email no es válido';
    }
    
    // Asunto
    if (empty($data['subject']) || strlen($data['subject']) < 3) {
        $errors['subject'] = 'El asunto es obligatorio y debe tener al menos 3 caracteres';
    }
    
    // Mensaje
    if (empty($data['message']) || strlen($data['message']) < 10) {
        $errors['message'] = 'El mensaje es obligatorio y debe tener al menos 10 caracteres';
    }
    
    // Protección contra inyección de headers
    foreach (['name', 'email', 'subject'] as $field) {
        if (isset($data[$field]) && (strpos($data[$field], "\n") !== false || strpos($data[$field], "\r") !== false)) {
            $errors[$field] = 'El campo contiene caracteres no válidos';
        }
    }
    
    return $errors;
}

/**
 * Enviar email de contacto
 */
function send_contact_email($data) {
    // Validar datos
    $errors = validate_contact_form($data);
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    // Preparar email
    $subject = "Nuevo mensaje desde Cypherstudios: " . $data['subject'];
    $message = prepare_contact_email($data['name'], $data['email'], $data['subject'], $data['message']);
    
    // Enviar email
    $sent = send_email(EMAIL_TO, $subject, $message, $data['email'], $data['name']);
    
    if ($sent) {
        return ['success' => true, 'message' => 'Mensaje enviado correctamente. Te responderé lo antes posible.'];
    } else {
        return ['success' => false, 'message' => 'Error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.'];
    }
}
?>
