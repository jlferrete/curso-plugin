<?php

/**
 * Define la funcionalidad de internacionalización
 *
 * Carga y define los archivos de internacionalización de este plugin para que esté listo para su traducción.
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
class BC_i18n {
    
    /**
	 * Carga el dominio de texto (textdomain) del plugin para la traducción.
	 *
     * @since    1.0.0
     * @access public static
	 */    
    public function load_plugin_textdomain() {
        
        load_plugin_textdomain(
            'beziercode-textdomain',
            false,
            BC_PLUGIN_DIR_PATH . 'languages'
        );
        
    }
    
}