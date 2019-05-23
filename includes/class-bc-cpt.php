<?php

class BC_CPT {
    
    public function beziercode() {
        $labels = [
            'name' => __( 'Plurar', 'beziercode-textdomain' ),
            'singular_name' => __( 'Singular', 'beziercode-textdomain' ),
            'add_new' => __( 'Agregar nuevo', 'beziercode-textdomain' ),
            'add_new_item' => __( 'Agregar nuevo item', 'beziercode-textdomain' ),
            'edit_item' => __( 'Editar items', 'beziercode-textdomain' ),
            'view_item' => __( 'Ver items', 'beziercode-textdomain' ),
            'featured_image' => __( 'Imagen de portada items', 'beziercode-textdomain' ),
            'set_featured_image' => __( 'Definir portada item', 'beziercode-textdomain' ),
            'remove_featured_image' => __( 'Remover imagen del item', 'beziercode-textdomain' ),
            'use_featured_image' => __( 'Usar como imagen de item', 'beziercode-textdomain' ),
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => [ 'title', 'editor', 'thumbnail' ],
            'capability_type' => 'post',
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_admin_bar' => false,
            'rewrite' => [ 'slug' => 'items' ],
        ];

        register_post_type( 'beziercode_post_type', $args );

        flush_rewrite_rules();
    }
        
}