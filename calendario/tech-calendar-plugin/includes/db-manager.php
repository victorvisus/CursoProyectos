<?php
/**
 * Gestión de la Base de Datos para TechCalendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Tech_Calendar_DB {

    public static function get_table_name() {
        global $wpdb;
        return $wpdb->prefix . 'tech_appointments';
    }

    /**
     * Crea la tabla de citas si no existe
     */
    public static function create_tables() {
        global $wpdb;
        $table_name = self::get_table_name();
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            nombre varchar(100) NOT NULL,
            telefono varchar(20) NOT NULL,
            email varchar(100) NOT NULL,
            fecha date NOT NULL,
            hora time NOT NULL,
            comentarios text,
            fecha_registro datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    /**
     * Guarda una nueva cita
     */
    public static function save_appointment($data) {
        global $wpdb;
        return $wpdb->insert(
            self::get_table_name(),
            array(
                'nombre'      => $data['nombre'],
                'telefono'    => $data['tel'],
                'email'       => $data['email'],
                'fecha'       => $data['fecha'],
                'hora'        => $data['hora'],
                'comentarios' => $data['comentarios']
            )
        );
    }

    /**
     * Obtiene las horas ocupadas para una fecha concreta
     */
    public static function get_booked_slots($fecha) {
        global $wpdb;
        $table_name = self::get_table_name();
        
        $results = $wpdb->get_results(
            $wpdb->prepare("SELECT hora FROM $table_name WHERE fecha = %s", $fecha),
            ARRAY_A
        );

        return array_map(function($row) {
            return substr($row['hora'], 0, 5); // Convertir HH:MM:SS a HH:MM
        }, $results);
    }
}
