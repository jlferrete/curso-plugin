(function ($) {
    'use strict';

    /**
     * Todo el código Javascript orientado a la administración
     * debe estar escrito aquí
     */

    var $precargador = $('.precargador'),
        urledit = "?page=bc_data&action=edit&id=",
        $marcoimg = $('.marcoimg img'),
        $selectimgval = $('#selectimgval'),
        $idTable = $('#idTable').val(),
        $nombres = $('#nombres'),
        $apellidos = $('#apellidos'),
        $email = $('#email'),
        marco;

    /**
     * Helpers
     */

    /* Limpiador de enlaces para las imagenes */

    function limpiarEnlace(url) {

        var local = /localhost/;

        if (local.test(url)) {

            var url_pathname = location.pathname,
                indexPos = url_pathname.indexOf('wp-admin'),
                url_pos = url_pathname.substr(0, indexPos),
                url_delete = location.protocol + "//" + location.host + url_pos;

            return url_pos + url.replace(url_delete, '');

        } else {

            var url_real = location.protocol + "//" + location.hostname;
            return url.replace(url_real, '');
        }

    }

    /* Validando que los campos no esten vacios */

    function validarCamposVacios(selector) {

        var $inputs = $(selector),
            result = false;

        $.each($inputs, function (k, v) {

            var $input = $(v),
                inputVal = $input.val();

            if (inputVal == '' && $input.attr('type') != 'file') {

                if (!$input.hasClass('invalid')) {
                    $input.addClass('invalid');
                }

                result = true;

            }

        });

        if (result) {
            return true;
        } else {
            return false;
        }

    }

    /* Validar el email */

    function validarEmail(email) {

        var er = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        return er.test(email);
    }

    function quitarInvalid(selector) {

        var $inputs = $(selector);

        $.each($inputs, function (k, v) {

            var $input = $(v);

            if ($input.hasClass('invalid')) {
                $input.removeClass('invalid');
            } else if ($input.hasClass('active')) {
                $input.removeClass('active');
            }

        });

    }



    $('.modal').modal();

    $('.add-bc-table').on('click', function (e) {
        e.preventDefault;
        $('#add_bc_table.modal').modal('open');
    });

    $('#crear-tabla').on('click', function (e) {
        e.preventDefault();

        if (marco) {
            marco.open();
            return;
        }

        var marco = vp.media({
            frame: 'select',
            title: 'Seleccionar imagen para el usuario',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false,
            libraty: {
                type: image
            }

        });

        marco.on('select', function () {

            var imagen = marco.state().get('selection').first().toJSON();

        });

    });

    /**
     * Evento click para guardar el registro en la base de datos mediante AJAX
     */

    $('#crear-tabla').on('click',
        function (e) {
            e.preventDefault();

            var $nombre = $('#nombre-tabla'),
                nv = $nombre.val();

            if (nv != '') {

                $precargador.css('display', 'flex');

                //Envio AJAX

                $.ajax({
                    url: bcdata.url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'bc_crud_table',
                        nonce: bcdata.seguridad,
                        nombre: nv,
                        tipo: 'add'
                    },
                    success: function (data) {

                        if (data.result) {

                            urledit += data.insert_id;

                            setTimeout(function () {
                                location.href = urledit;
                            }, 1300);

                        }
                    },
                    error: function (d, x, v) {

                        console.log(d);
                        console.log(x);
                        console.log(v);

                    }

                });

            } else {

                $precargador.css('display', 'none');

                if (!$nombre.hasClass('invalid')) {
                    $nombre.addClass('invalid');
                }
            }

        });

    /* Agregando interaccion del boton de edicion de las tablas de datos */

    $(document).on('click', '[data-bc-id-edit]', function () {

        var id = $(this).attr('data-bc-id-edit');
        location.href = urledit + id;

    });

    $('.addItem').on('click', function (e) {

        $('#addUpdate').modal('open');
    });

    $('#selectimg').on('click', function (e) {

        e.preventDefault();

        if (marco) {
            marco.open();
            return;
        }

        var marco = wp.media({
            frame: 'select',
            title: 'Seleccionar imagen para el usuario',
            button: {
                text: 'Usar esta imagen'
            },
            multiple: false,
            library: {
                type: 'image'
            }

        });

        marco.on('select', function () {

            var imagen = marco.state().get('selection').first().toJSON(),
                urlLimpia = limpiarEnlace(imagen.url);

            $selectimgval.val(urlLimpia);
            $marcoimg.attr('src', urlLimpia);
            //            console.log(limpiarEnlace(imagen.url));

        });

        marco.open();

    });

    /**
     * Agregando usuario
     */

    $('#agregar').on('click', function () {

        var $n = $('#nombres'),
            $a = $('#apellidos'),
            $e = $('#email'),
            nombres = $n.val(),
            apellidos = $a.val(),
            email = $e.val(),
            imgVal = $selectimgval.val();

        // Validando campos

        if (validarCamposVacios('.formuData input')) {

            console.log('validar inputs vacíos');

        } else if (!validarEmail(email)) {

            $('.formuData input').removeClass('invalid');

            if (!$e.hasClass('invalid')) {
                $e.addClass('invalid');
            }

        } else {

            quitarInvalid('.formuData input');
            $precargador.css('display', 'flex');

            console.log('Todo correcto');

            // Envío de AJAX

            $.ajax({
                url: bcdata.url,
                type: 'POST',
                dataType: 'json',
                data: {
                    action: 'bc_crud_json',
                    nonce: bcdata.seguridad,
                    tipo: 'add',
                    idtable: $idTable,
                    nombres: nombres,
                    apellidos: apellidos,
                    email: email,
                    media: imgVal
                },
                success: function (data) {

                    console.log(data);
                    if (data.result) {

                        $precargador.css('display', 'none');

                        swal({
                            title: 'Agregado',
                            text: 'El usuario ' + nombres + " ha sido agregado correctamente!",
                            type: 'success',
                            timer: 2000
                        });

                        console.log(data.valores);

                    } else {

                        $precargador.css('display', 'none');

                        swal({
                            title: 'Error',
                            text: 'Hubo un error al guardar los datos, por favor intenta más tarde',
                            type: 'error',
                            timer: 2000
                        });

                    }

                },
                error: function (d, x, v) {

                    console.log(d);
                    console.log(x);
                    console.log(v);

                }

            });



        }

    });


})(jQuery);
