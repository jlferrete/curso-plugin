<?php

/**
  * Proporcionar una vista de área de administración para el plugin
  *
  * Este archivo se utiliza para marcar los aspectos de administración del plugin.
  *
  * @link http://misitioweb.com
  * @since desde 1.0.0
  *
  * @package Beziercode_blank
  * @subpackage Beziercode_blank/admin/parcials
  */

/* Este archivo debe consistir principalmente en HTML con un poco de PHP. */

$sql = "SELECT id, nombre FROM ". BC_TABLE;
$result = $this->db->get_results( $sql );


?>

<!-- Modal Structure -->
<div id="add_bc_table" class="modal">
    <div class="modal-content">

        <!-- Precargador -->

        <div class="precargador">
            <div class="preloader-wrapper big active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>


        <form method="post" class="col s12">
            <div class="row">
                <div class="input-field col s4">
                    <input id="nombre-tabla" type="text" class="validate">
                    <label for="nombre">Nombre de la tabla</label>
                </div>
            </div>
            <div class="row">
                <div class="col s4">
                    <button id="crear-tabla" class="waves-effect waves-light btn" type="button" name="action">
                        Crear <i class="material-icons right">add</i>
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>



<div class="had-container">

    <div class="row">
        <div class="col s12">
            <h5> <?php echo esc_html( get_admin_page_title() ); ?> </h5>
        </div>
    </div>

    <!--Boton crear nueva tabla de datos -->

    <div class="row">

        <div class="col s4">

            <a class="add-bc-table btn btn-floating pulse">
                <i class="material-icons">add</i>
            </a>
            <span style="font-size:19px;margin-top:5px;">Crear nueva tabla de datos</span>

        </div>

    </div>

    <!-- Elementos de la tabla -->

    <div class="row">
        <div class="col s4">
            <table class="responsive-table bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Shortcode</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    
                    foreach( $result as $key => $value){
                        
                        $id         = $value->id;
                        $nombre     = $value->nombre;
                        
                        echo "
                            <tr data-table='$id'>
                                <td>$nombre</td>
                                <td>[bcdatos id='$id']</td>
                                <td>
                                    <span data-bc-id-edit='$id' class='btn btn-floating waves-effect waves-light'>
                                        <i class='tiny material-icons'>mode_edit</i>
                                    </span>
                                </td>
                                <td>
                                    <span data-bc-id-remove='$id' class='btn btn-floating waves-effect waves-light red darken-1'>
                                        <i class='tiny material-icons'>close</i>
                                    </span>
                                </td>
                            </tr>
                        ";
                    }
                    
                    
                    ?>


                </tbody>
            </table>
        </div>

    </div>

</div>
