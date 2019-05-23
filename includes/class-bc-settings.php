<?php

class BC_Settings {
    
    public function init() {
        $args = [
            'sanitize_callback' => 'bc_filtrando',
            'default' => 'Este nombre de opción no fue encontrado en la tabla de opciones'
        ];

        // registrando una nueva configuración en la página "general"
        register_setting( 'bc_pruebas', 'bc_miprimera_configuracion', $args );

        // Registrando una nueva sección en la página "general"
        add_settings_section(
            'bc_config_seccion',
            'Configuración',
            [ $this, 'config_seccion_cb' ],
            'bc_pruebas'
        );

        add_settings_field(
            'bc_config_campo1',
            'Configuración 1',
            [ $this, 'config_campo1_cb' ],
            'bc_pruebas',
            'bc_config_seccion',
            [
                'label_for' => 'bc_campo_1',
                'class' => 'clase_campo',
                'bc_dato_personalizado' => 'valor personalizado 1'
            ]
        );

        add_settings_field(
            'bc_config_campo2',
            'Configuración 2',
            [ $this, 'config_campo2_cb' ],
            'bc_pruebas',
            'bc_config_seccion',
            [
                'label_for' => 'bc_campo_2',
                'class' => 'clase_campo',
                'bc_dato_personalizado' => 'valor personalizado 2'
            ]
        );
    }
    
    private function config_seccion_cb() {
        echo "<p>Sección configuración</p>";        
    }
    
    private function config_campo1_cb($args) {

        $bc_config = get_option('bc_miprimera_configuracion');

        if( $bc_config !== false ) {
            $valor = isset($bc_config[$args['label_for']]) ? esc_attr($bc_config[$args['label_for']]) : '';        
        } else {
            $valor = $bc_config;
        }   

        $output = "<input class='{$args['class']}' data-custom='{$args['bc_dato_personalizado']}' type='text' name='bc_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";

        echo $output;

    }

    function config_campo2_cb($args) {

        $bc_config = get_option('bc_miprimera_configuracion');

        if( $bc_config != false ) {
            $valor = isset($bc_config[$args['label_for']]) ? esc_attr($bc_config[$args['label_for']]) : '';
        } else {
            $valor = $bc_config;
        }

        $html = "<input class='{$args['class']}' data-custom='{$args['bc_dato_personalizado']}' type='text' name='bc_miprimera_configuracion[{$args['label_for']}]' value='$valor'>";

        echo $html;

    }
    
    public function filtrando( $valor ) {
    
        $valor['bc_campo_1'] = $valor['bc_campo_1'];
        $valor['bc_campo_2'] = $valor['bc_campo_2'];

        return $valor;

    }
    
}


