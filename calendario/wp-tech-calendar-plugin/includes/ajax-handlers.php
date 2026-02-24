<?php
/**
 * Manejadores AJAX para TechCalendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Obtener slots ocupados
add_action( 'wp_ajax_get_booked_slots', 'tech_calendar_get_booked_slots' );
add_action( 'wp_ajax_nopriv_get_booked_slots', 'tech_calendar_get_booked_slots' );

function tech_calendar_get_booked_slots() {
    check_ajax_referer( 'tech_calendar_nonce', 'nonce' );

    $fecha = sanitize_text_field( $_POST['fecha'] );
    if ( ! $fecha ) {
        wp_send_json_error( array( 'message' => 'Fecha no proporcionada' ) );
    }

    $booked = Tech_Calendar_DB::get_booked_slots( $fecha );
    wp_send_json_success( $booked );
}

// Guardar cita
add_action( 'wp_ajax_save_appointment', 'tech_calendar_save_appointment' );
add_action( 'wp_ajax_nopriv_save_appointment', 'tech_calendar_save_appointment' );

function tech_calendar_save_appointment() {
    check_ajax_referer( 'tech_calendar_nonce', 'nonce' );

    $data = array(
        'nombre'      => sanitize_text_field( $_POST['nombre'] ),
        'tel'         => sanitize_text_field( $_POST['tel'] ),
        'email'       => sanitize_email( $_POST['email'] ),
        'fecha'       => sanitize_text_field( $_POST['fecha'] ),
        'hora'        => sanitize_text_field( $_POST['hora'] ),
        'comentarios' => sanitize_textarea_field( $_POST['comentarios'] )
    );

    // Validación básica en el servidor (como respaldo a la de JS)
    if ( empty( $data['nombre'] ) || empty( $data['fecha'] ) || empty( $data['hora'] ) ) {
        wp_send_json_error( array( 'message' => 'Faltan campos obligatorios' ) );
    }

    // Verificar si ya está ocupado
    $booked = Tech_Calendar_DB::get_booked_slots( $data['fecha'] );
    if ( in_array( $data['hora'], $booked ) ) {
        wp_send_json_error( array( 'message' => 'Este horario ya ha sido reservado.' ) );
    }

    $result = Tech_Calendar_DB::save_appointment( $data );

    if ( $result ) {
        wp_send_json_success( $data );
    } else {
        wp_send_json_error( array( 'message' => 'Error al guardar en la base de datos.' ) );
    }
}
