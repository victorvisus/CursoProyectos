<?php
/**
 * Funciones SEO
 * Cypherstudios - Víctor Visús García
 */

require_once __DIR__ . '/config.php';

/**
 * Generar meta tags SEO
 */
function generate_meta_tags($title = '', $description = '', $keywords = '', $url = '', $image = '') {
    $site_name = SITE_NAME;
    $site_url = SITE_URL;
    $author = SITE_AUTHOR;
    
    $full_title = $title ? "$title | $site_name" : $site_name;
    $meta_description = $description ?: SITE_DESCRIPTION;
    $meta_keywords = $keywords ?: SITE_KEYWORDS;
    $meta_url = $url ?: $site_url;
    $meta_image = $image ?: "$site_url/assets/img/logo.svg";
    
    ob_start();
    ?>
    <!-- Meta tags básicas -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO -->
    <title><?= htmlspecialchars($full_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="author" content="<?= htmlspecialchars($author) ?>">
    <meta name="robots" content="index, follow">
    <meta name="language" content="es">
    
    <!-- Canonical -->
    <link rel="canonical" href="<?= htmlspecialchars($meta_url) ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($full_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($meta_url) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($meta_image) ?>">
    <meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>">
    <meta property="og:locale" content="es_ES">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($full_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($meta_image) ?>">
    <meta name="twitter:creator" content="@<?= htmlspecialchars($author) ?>">
    
    <!-- Schema.org JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "<?= htmlspecialchars($author) ?>",
        "jobTitle": "Desarrollador Web",
        "description": "<?= htmlspecialchars($meta_description) ?>",
        "url": "<?= htmlspecialchars($site_url) ?>",
        "sameAs": [],
        "knowsAbout": ["Desarrollo Web", "PHP", "JavaScript", "HTML", "CSS", "Diseño Web"],
        "offers": {
            "@type": "Service",
            "serviceType": "Desarrollo Web",
            "description": "Servicios de diseño y desarrollo web profesional"
        }
    }
    </script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= htmlspecialchars($site_url) ?>/assets/img/logo.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= htmlspecialchars($site_url) ?>/assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= htmlspecialchars($site_url) ?>/assets/img/favicon-16x16.png">
    
    <?php
    return ob_get_clean();
}

/**
 * Limpiar texto para URLs
 */
function clean_url($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

/**
 * Escapar salida segura
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Validar email
 */
function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Sanitizar input
 */
function sanitize_input($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
?>
