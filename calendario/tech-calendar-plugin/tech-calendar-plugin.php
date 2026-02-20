<?php
/**
 * Plugin Name: TechCalendar - Sistema de Citas
 * Description: Sistema de gestión de citas técnicas con calendario interactivo y validación avanzada.
 * Version: 1.0.3
 * Author: Cypherstudios with Antigravity
 * Text Domain: tech-calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Definir constantes del plugin
define( 'TECH_CALENDAR_PATH', plugin_dir_path( __FILE__ ) );
define( 'TECH_CALENDAR_URL', plugin_dir_url( __FILE__ ) );

// Incluir archivos necesarios
require_once TECH_CALENDAR_PATH . 'includes/db-manager.php';
require_once TECH_CALENDAR_PATH . 'includes/ajax-handlers.php';

/**
 * Activación del plugin: Crear tablas en la BD
 */
register_activation_hook( __FILE__, 'tech_calendar_activate' );
function tech_calendar_activate() {
    Tech_Calendar_DB::create_tables();
}

/**
 * Encolar scripts y estilos
 */
add_action( 'wp_enqueue_scripts', 'tech_calendar_enqueue_assets' );
function tech_calendar_enqueue_assets() {
    // Solo encolar si el shortcode está presente (opcional, por simplicidad encolamos aquí)
    wp_enqueue_style( 'tech-calendar-style', TECH_CALENDAR_URL . 'assets/css/style-wp.css', array(), '1.0.0' );
    
    // Cargar scripts como módulos
    wp_enqueue_script( 'tech-calendar-app', TECH_CALENDAR_URL . 'assets/js/app-wp.js', array(), '1.0.0', true );
    
    // Pasar URL de AJAX al frontend
    wp_localize_script( 'tech-calendar-app', 'techCalendarData', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'tech_calendar_nonce' )
    ) );
}

/**
 * Ajustar el script principal para que se cargue como módulo
 */
add_filter( 'script_loader_tag', 'tech_calendar_script_as_module', 10, 3 );
function tech_calendar_script_as_module( $tag, $handle, $src ) {
    if ( 'tech-calendar-app' !== $handle ) {
        return $tag;
    }
    $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
    return $tag;
}

/**
 * Registro del Shortcode [tech_calendar]
 */
add_shortcode( 'tech_calendar', 'tech_calendar_render_shortcode' );
function tech_calendar_render_shortcode() {
    ob_start();
    include TECH_CALENDAR_PATH . 'templates/calendar-template.php';
    return ob_get_clean();
}
