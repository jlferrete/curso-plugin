<?php
/**
 * Archivo del plugin 
 * Este archivo es leído por WordPress para generar la información del plugin
 * en el área de administración del complemento. Este archivo también incluye 
 * todas las dependencias utilizadas por el complemento, registra las funciones 
 * de activación y desactivación y define una función que inicia el complemento.
 *
 * @link                http://misitioweb.com
 * @since               1.0.0
 * @package             Beziercode Blank
 *
 * @wordpress-plugin
 * Plugin Name:         Beziercode Blank
 * Plugin URI:          http://miprimerplugin.com
 * Description:         Descripción corta de nuestro plugin
 * Version:             1.0.0
 * Author:              Gilbert Rodríguez
 * Author URI:          http://miurlpersonal.com
 * License:             GPL2
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         beziercode-textdomain
 * Domain Path:         /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
global $wpdb;
define( 'BC_REALPATH_BASENAME_PLUGIN', dirname( plugin_basename( __FILE__ ) ) . '/' );
define( 'BC_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BC_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'BC_TABLE', "{$wpdb->prefix}beziercode_data" );

/**
 * Código que se ejecuta en la activación del plugin
 */
function activate_beziercode_blank() {
    require_once BC_PLUGIN_DIR_PATH . 'includes/class-bc-activator.php';
	BC_Activator::activate();
}

/**
 * Código que se ejecuta en la desactivación del plugin
 */
function deactivate_beziercode_blank() {
    require_once BC_PLUGIN_DIR_PATH . 'includes/class-bc-deactivator.php';
	BC_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_beziercode_blank' );
register_deactivation_hook( __FILE__, 'deactivate_beziercode_blank' );

require_once BC_PLUGIN_DIR_PATH . 'includes/class-bc-master.php';

function run_bc_master() {
    $bc_master = new BC_Master;
    $bc_master->run();
}

run_bc_master();
























