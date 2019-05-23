<?php

/**
 * Permite crear cajas de metadatos 
 * para algún tipo de post
 *
 * @link       http://misitioweb.com
 * @since      1.0.0
 *
 * @package    Beziercode-Blank
 * @subpackage Beziercode-Blank/includes
 */

/**
 * Ésta clase define todo lo necesario para
 * crear una caha con uno o más metatados 
 *
 * @since      1.0.0
 * @package    Beziercode-Blank
 * @subpackage Beziercode-Blank/includes
 * @author     Gilbert Rodríguez <email@example.com>
 */
abstract class BC_Metabox {
    
    /**
	 * Método estático
	 *
	 * Permite agregar el metabox a los
     * tipos de post pasados en $post_types
	 *
	 * @since    1.0.0
     * @access   public static
	 */ 
    public static function add() {
        
        $post_types = ['bc_post_type', 'post'];
    
        add_meta_box(
            'bc_id_metabox',
            __('Título', 'beziercode-textdomain'),
            [self::class, 'html'],
            $post_types,
            'normal',
            'high',
            [
                "datos",
            ]
        );
        
    }
    
    /**
	 * Método estático que obtiene el meta post en el callback
	 *
     * @since    1.0.0
     * @access   public static
     * 
     * @param WP_Post $post - Un objeto del post_type actual obtenido desde la DB
     * @param array $metabox - Obtiene un array con el ( id, title, callback, y elementos de argumentos )
	 */ 
    public static function html($post, $metabox) {
        
        wp_nonce_field( 'bc_nonce_seguridad', 'bc_nonce' );
        
        $valor = get_post_meta( $post->ID, '_bc_identificador', true );
        
        // Campos de formulario para mostrar
        $output = "
            <div>
                <label for='bc_label'>Text label</label>
                <input type='text' name='bc_name' id='bc_label' value=''> 
            </div>
        ";
        
        echo $output;
                
    }
    
    /**
	 * Método estático que se ejecuta al guardar un post_type
	 * con un metabox agregado
     * 
     * @since    1.0.0
     * @access   public static
     * 
     * @param int $post_id El ID del post actual 
	 */ 
    public static function save($post_id) {
        
        $valor_nonce = isset( $_POST['bc_nonce'] ) ? $_POST['bc_nonce'] : '';
        $action_nonce = 'bc_nonce_seguridad';
        
        if( ! isset($valor_nonce) ) {
             return;
        }
        
        if( ! wp_verify_nonce( $valor_nonce, $action_nonce ) ) {
            return;
        }
        
        if( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
        
        if( array_key_exists( 'bc_name', $_POST ) ) {
        
            update_post_meta(
                $post_id,
                '_bc_identificador',
                $_POST['bc_name']
            );

        }
        
    }
    
}
