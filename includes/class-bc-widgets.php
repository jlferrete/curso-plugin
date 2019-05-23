<?php

class BC_Widget extends WP_Widget {
    
    public function __construct() {
        
        $widget_options = [
            'classname'     => 'mp-widget',
            'description'   => 'Este es un widget de pruebas'
        ];
        
        $control_options = [
            'height' => 200,
            'width' => 250
        ];
        
        parent::__construct( 'mp-widget', __('Mi Widget Personalizado', 'miprimerplugin'), $widget_options, $control_options  );
        
    }
    
    public function widget( $args, $instance ) {
        
        extract( $args, EXTR_SKIP );
        
        $titulo = isset( $instance['titulo'] ) ? $instance['titulo'] : 'Por favor, coloca algún título';
        $cuerpo = isset( $instance['cuerpo'] ) ? $instance['cuerpo'] : 'Por favor, un texto';
        
        $output = "
            $before_widget
                $before_title $titulo $after_title
                <p>
                $cuerpo
                </p>
            $after_widget
        ";
        
        echo $output;
        
    }
    
    public function update( $new_instance, $old_instance ) {
        
        return $new_instance;
        
    }
    
    public function form( $instance ) {
        
        $titulo_id = $this->get_field_id( 'titulo' );
        $titulo_name = $this->get_field_name( 'titulo' );
        $titulo_val = esc_attr( $instance['titulo'] );
        
        $cuerpo_id = $this->get_field_id( 'cuerpo' );
        $cuerpo_name = $this->get_field_name( 'cuerpo' );
        $cuerpo_val = esc_attr( $instance['cuerpo'] );
        
        $form = "
            <label for='$titulo_id'>Título</lable>
            <input id='$titulo_id' name='$titulo_name' value='$titulo_val' type='text'>
            <label for='$cuerpo_id'>Cuerpo</lable>
            <textarea id='$cuerpo_id' name='$cuerpo_name'>$cuerpo_val</textarea>
        ";
        
        echo $form;
        
    }
    
}