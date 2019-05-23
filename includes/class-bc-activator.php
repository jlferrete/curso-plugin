<?php

/**
 * Se activa en la activación del plugin
 *
 * @link       http://misitioweb.com
 * @since      1.0.0
 *
 * @package    Beziercode-Blank
 * @subpackage Beziercode-Blank/includes
 */

/**
 * Ésta clase define todo lo necesario durante la activación del plugin
 *
 * @since      1.0.0
 * @package    Beziercode-Blank
 * @subpackage Beziercode-Blank/includes
 * @author     Gilbert Rodríguez <email@example.com>
 */
class BC_Activator {

	/**
	 * Método estático que se ejecuta al activar el plugin
	 *
	 * Creación de la tabla {$wpdb->prefix}beziercode_data
     * para guardar toda la información necesaria
	 *
	 * @since 1.0.0
     * @access public static
	 */
	public static function activate() {
        
        global $wpdb;
        
        $sql = "CREATE TABLE IF NOT EXISTS ". BC_TABLE . " (
            id int(11) NOT NULL AUTO_INCREMENT,
            nombre varchar(50) NOT NULL,
            data longtext NOT NULL,
            PRIMARY KEY (id)
        );";
        
        $wpdb->query( $sql);
        
	}

}
