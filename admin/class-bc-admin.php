<?php

/**
 * La funcionalidad específica de administración del plugin.
 *
 * @link       http://misitioweb.com
 * @since      1.0.0
 *
 * @package    Beziercode_blank
 * @subpackage Beziercode_blank/admin
 */

/**
 * Define el nombre del plugin, la versión y dos métodos para
 * Encolar la hoja de estilos específica de administración y JavaScript.
 * 
 * @since      1.0.0
 * @package    Beziercode-Blank
 * @subpackage Beziercode-Blank/admin
 * @author     Gilbert Rodríguez <email@example.com>
 * 
 * @property string $plugin_name
 * @property string $version
 */
class BC_Admin {
    
    /**
	 * El identificador único de éste plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name  El nombre o identificador único de éste plugin
	 */
    private $plugin_name;
    
    /**
	 * Versión actual del plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version  La versión actual del plugin
	 */
    private $version;
    
    /**
	 * Objeto wpdb
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object   $db  @global $wpdb
	 */
    private $db;
    
    /**
	 * Objeto registrador de menus
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object   $build_menupage  Instancia del objeto BC_Build_Menupage
	 */
    private $build_menupage;
    
    
    
    /**
     * @param string $plugin_name nombre o identificador único de éste plugin.
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $plugin_name, $version ) {
        
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->build_menupage = new BC_Build_Menupage();
        
        global $wpdb;
        $this->db = $wpdb;
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_styles( $hook ) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en BC_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El BC_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        /*
        * Bc-admin.css
        * Archivo de hojas de estilo principales de la administracion
        */
        wp_enqueue_style( 'bc_wordpress_icons_css', BC_PLUGIN_DIR_URL . 'admin/css/bc-wordpress.css', array(), $this->version, 'all' );
        
        if( $hook != 'toplevel_page_bc_data' )
        {
            return;
        }
        
        /*
        *   Framework Materializecss - https://materializecss.com/getting-started.html
        *   Material Icons Google
        */
        wp_enqueue_style( 'bc_material_admin_icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), $this->version, 'all' );
        wp_enqueue_style( 'bc_materialize_admin_css', BC_PLUGIN_DIR_URL . 'helpers/materialize/css/materialize.min.css', array(), '0.100.1', 'all' );
                
        /*
        * Sweet Alert
        * https://sweetalert.js.org/docs/
        */
        wp_enqueue_style( 'bc_sweet_alert_css', BC_PLUGIN_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.css', array(), $this->version, 'all' );
        
        /*
        * Bc-admin.css
        * Archivo de hojas de estilo principales de la administracion
        */
        wp_enqueue_style( $this->plugin_name, BC_PLUGIN_DIR_URL . 'admin/css/bc-admin.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts( $hook ) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en BC_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El BC_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        
        /*
        * Condicional para controlar la carga de los archivos
        * solamente en la página del plugin
        */
        
         if( $hook != 'toplevel_page_bc_data' )
        {
            return;
        }
        
        
        wp_enqueue_media();
        
        
        /*
        *   Framework Materializecss - https://materializecss.com/getting-started.html
        *   Material Icons Google
        */
        
        wp_enqueue_script( 'bc_materialize_admin_js', BC_PLUGIN_DIR_URL . 'helpers/materialize/js/materialize.min.js', ['jquery'], '0.100.1', true );
                
        /*
        * Sweet Alert
        * https://sweetalert.js.org/docs/
        */
        wp_enqueue_script( 'bc_sweet_alert_js', BC_PLUGIN_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.min.js', ['jquery'], $this->version, true );
        
        /*
        * Bc-admin.css
        * Archivo de hojas de estilo principales de la administracion
        */
        wp_enqueue_script( $this->plugin_name, BC_PLUGIN_DIR_URL . 'admin/js/bc-admin.js', ['jquery'], $this->version, true );
        
        /**
        * Localizando el archivo JavaScript principal del area de administracion
        * para pasarle el objeto "bcdata" con los parámetros:
        * @param bcdata.url         Url del archivo admin-ajax.php
        * @param bcdata.seguridad   Nonce de seguridad para el envio seguro de datos
        *
        */
        wp_localize_script(
            $this->plugin_name,
            'bcdata',
            [
                'url'       => admin_url( 'admin-ajax.php'),
                'seguridad' => wp_create_nonce( 'bcdata_seg' )
                
            ]
        );
        
    }
    
    /**
	 * Registra los menus del plugin en el area de administracion
	 *
	 * @since    1.0.0
     * @access   public
	 */
    
    public function add_menu() {
        
        $this->build_menupage->add_menu_page(
            __( 'Beziercode Datos', 'beziercode-textdomain' ),
            __( 'Beziercode Datos', 'beziercode-textdomain' ),
            'manage_options',
            'bc_data',
            [$this, 'controlador_display_menu' ],
            'dashicons-beziercode',
            22
        );
        
        $this->build_menupage->run();
        
        
    }
    
    /**
	 * Controla las visualizaciones del menú en el area de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    
    public function controlador_display_menu() {
        
        if(
            $_GET['page'] == 'bc_data' &&
            $_GET['action'] == 'edit' &&
            isset( $_GET['id'] )
        ) {
            require_once BC_PLUGIN_DIR_PATH . 'admin/partials/bc-admin-display-edit.php';
        }else{
           require_once BC_PLUGIN_DIR_PATH . 'admin/partials/bc-admin-display.php'; 
        }
        
        
    }
    
    public function ajax_crud_table() {
        
        check_ajax_referer( 'bcdata_seg', 'nonce');
        
        if( current_user_can( 'manage_options') ) {
            
            extract( $_POST, EXTR_OVERWRITE );
            
            if( $tipo == 'add'){
                
                $columns = [
                'nombre'       => $nombre,
                'data'         => '',
                ];
            
                $result = $this->db->insert( BC_TABLE, $columns );

                $json = json_encode( [
                    'result'        => $result,
                    'nombre'        => $nombre,
                    'insert_id'     => $this->db->insert_id
                ]);
            }
            
            
            
            echo $json;
            wp_die();
        }
        
    }
    
    
    /**
	 * Método que controla el envío
     * de datos con POST, desde el lado público
     * hacia el lado del servidor
     * para guardar la información en
     * formato JSON
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function ajax_crud_json() {
        
        check_ajax_referer( 'bcdata_seg', 'nonce' );
        
        if( current_user_can( 'manage_options' ) ) {
            
            extract( $_POST, EXTR_OVERWRITE );
            
            $sql = $this->db->prepare("SELECT data FROM " . BC_TABLE . " WHERE id = %d", $idtable );
            $resultado = $this->db->get_var( $sql );
            
            if( $tipo == 'add' ) {
                
//                $data = $this->crud_json->add_item( $resultado, $nombres, $apellidos, $email, $media );
//                
//                $columns = [
//                    'data' => json_encode($data)
//                ];
//                
//                $where = [
//                    "id" => $idtable
//                ];
//                
//                $format = [
//                    "%s"
//                ];
//                
//                $where_format = [
//                    "%d"
//                ];
//                
//                $result_update = $this->db->update( BC_TABLE, $columns, $where, $format, $where_format );
//                
//                $last_item = end( $data['items'] );
//                $insert_id = $last_item['id'];

//                $json = json_encode( [
//                    'result'        => $result_update,
//                    'insert_id'     => $insert_id
//                ] );
                
                $json = json_encode( [
                    'result'        => true,
                    'valores'     => $_POST
                ] );
                
//            } elseif( $tipo == 'update' ) {
//                
//                $data = $this->crud_json->update_item( $resultado, $iduser, $nombres, $apellidos, $email, $media );
//                
//                $columns = [
//                    'data' => json_encode($data)
//                ];
//                
//                $where = [
//                    "id" => $idtable
//                ];
//                
//                $format = [
//                    "%s"
//                ];
//                
//                $where_format = [
//                    "%d"
//                ];
//                
//                $result_update = $this->db->update( BC_TABLE, $columns, $where, $format, $where_format );
//                
//                $json = json_encode( [
//                    'result'        => $result_update
//                ] );
//                
//            } elseif( $tipo == 'delete' ) {
//                
//                $data = $this->crud_json->delete_item( $resultado, $iduser );
//                
//                $columns = [
//                    'data' => json_encode($data)
//                ];
//                
//                $where = [
//                    "id" => $idtable
//                ];
//                
//                $format = [
//                    "%s"
//                ];
//                
//                $where_format = [
//                    "%d"
//                ];
//                
//                $result_update = $this->db->update( BC_TABLE, $columns, $where, $format, $where_format );
//                
//                $json = json_encode( [
//                    'result'        => $result_update
//                ] );
                
            }
            
            echo $json;
            wp_die();
            
        }
        
    }
    
    
    
    
    
}
