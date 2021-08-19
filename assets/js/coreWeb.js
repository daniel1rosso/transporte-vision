function vaciado_login() {
    //cerrar_modal_Login
    document.getElementById("login").reset();
    $("#username").val('');
    $("#password").val('');
    username.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    password.setAttribute("style", "border-color:rgba(255,255,255,0.6);")
}

function vaciado_registro() {
    //cerrar_modal_Registro
    document.getElementById("form-nuevo-usuario").reset();
    $("#nombrePersona").val('');
    $("#apellidoPersona").val('');
    $("#telefonoPersona").val('');
    $("#emailUsuario").val('');
    $("#direccionPersona").val('');
    $("#selectComuna").val('Comuna');
    $("#nombreUsuarioPersona").val('');
    $("#passwordPersona").val('');
    $("#confPasswordPersona").val('');
    nombrePersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    nombrePersona.setAttribute("placeholder", "Nombre");
    apellidoPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    apellidoPersona.setAttribute("placeholder", "Apellido");
    telefonoPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    telefonoPersona.setAttribute("placeholder", "Telefono");
    emailUsuario.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    emailUsuario.setAttribute("placeholder", "Email");
    direccionPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    direccionPersona.setAttribute("placeholder", "Direccion");
    selectComuna.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    nombreUsuarioPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    nombreUsuarioPersona.setAttribute("placeholder", "Nombre Usuario");
    passwordPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    passwordPersona.setAttribute("placeholder", "Contraseña");
    confPasswordPersona.setAttribute("style", "border-color:rgba(255,255,255,0.6);");
    confPasswordPersona.setAttribute("placeholder", "Confirmar Contraseña");
}

//Formatear numero
function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);
    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
    //return amount_parts.join('.');
    return amount_parts.toLocaleString('.');
}

$(document).ready(function() {
    $('#registrarUsuario').click(function(e) {
        e.preventDefault();
        //--- Definiciones de variables ---//
        var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10;
        var nombre = $('#nombrePersona').val();
        var apellido = $('#apellidoPersona').val();
        var telefono = $('#telefonoPersona').val();
        var email = $('#emailUsuario').val();
        var nombreUsuario = $('#nombreUsuarioPersona').val();
        var comuna = $('#selectComuna').val();
        var direccion = $('#direccionPersona').val();
        var nivel = '2';
        var password = $('#passwordPersona').val();
        var confPassword = $('#confPasswordPersona').val();

        //validacion de campos

        if (nombre == null || nombre.length == 0 || nombre == '') {
            nombrePersona.setAttribute("placeholder", "Agrega Un Nombre");
            nombrePersona.setAttribute("style", "border-color:red;")
            val1 = false;
        } else {
            val1 = true;
        }

        if (apellido == null || apellido.length == 0 || apellido == '') {
            apellidoPersona.setAttribute("placeholder", "Agrega Un Apellido");
            apellidoPersona.setAttribute("style", "border-color:red;")
            val2 = false;
        } else {

            val2 = true;
        }

        if (email == null || email.length == 0 || email == '' || !(/\S+@\S+\.\S+/.test(email))) {
            emailUsuario.setAttribute("placeholder", "Agrega Un Email Valido");
            emailUsuario.setAttribute("style", "border-color:red;");
            document.getElementById("emailUsuario").value = " ";
            val3 = false;
        } else {

            val3 = true;
        }

        if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
            nombreUsuarioPersona.setAttribute("placeholder", "Agrega Un Usuario");
            nombreUsuarioPersona.setAttribute("style", "border-color:red;")
            val4 = false;
        } else {

            val4 = true;
        }

        if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
            telefonoPersona.setAttribute("placeholder", "Agrega Un Telefono Valido");
            telefonoPersona.setAttribute("style", "border-color:red;");
            document.getElementById("telefonoPersona").value = "";
            val5 = false;
        } else {

            val5 = true;
        }

        if (password == null || password.length == 0 || password == '') {
            passwordPersona.setAttribute("placeholder", "Agrega Una Contraseña Valida");
            passwordPersona.setAttribute("style", "border-color:red;");
            val6 = false;
        } else {
            val6 = true;
        }

        if (comuna == 'Comuna') {
            selectComuna.setAttribute("style", "border-color:red;");
            val7 = false;
        } else {

            val7 = true;
        }

        if (nivel == 0) {

            val8 = false;
        } else {

            val8 = true;
        }

        if (direccion == null || direccion.length == 0 || direccion == '') {
            direccionPersona.setAttribute("placeholder", "Agrega Una Direccion");
            direccionPersona.setAttribute("style", "border-color:red;");
            val10 = false;
        } else {
            val10 = true;
        }

        if (confPassword == null || confPassword.length == 0 || confPassword == '') {
            confPasswordPersona.setAttribute("style", "border-color:red;");
            confPasswordPersona.setAttribute("placeholder", "Agrega Una Contraseña Valida");

            val9 = false;
        } else {
            val9 = true;
        }

        //--- validacion de confirmacion de contraseña ---//
        if (String(confPassword) == String(password)) {
            val9 = true;
        } else {
            confPasswordPersona.setAttribute("placeholder", "Las Contraseñas No Coinciden");
            confPasswordPersona.setAttribute("style", "border-color:red;")
            passwordPersona.setAttribute("placeholder", "Las Contraseñas No Coinciden");
            passwordPersona.setAttribute("style", "border-color:red;")
            document.getElementById("confPasswordPersona").value = "";
            document.getElementById("passwordPersona").value = "";
            val9 = false;
        }

        //--- validaciones de ingresos de datos en inputs de registro ---//
        e.preventDefault();
        var validarNombre = function(e) {
            nombrePersona.setAttribute("placeholder", "Nombre");
            nombrePersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarApellido = function(e) {
            apellidoPersona.setAttribute("placeholder", "Apellido");
            apellidoPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarTelefono = function(e) {
            telefonoPersona.setAttribute("placeholder", "Telefono");
            telefonoPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarEmail = function(e) {
            emailUsuario.setAttribute("placeholder", "Email");
            emailUsuario.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarDireccion = function(e) {
            direccionPersona.setAttribute("placeholder", "Direccion");
            direccionPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }

        var validarComuna = function(e) {
            selectComuna.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }

        var validarUsuario = function(e) {
            nombreUsuarioPersona.setAttribute("placeholder", "Nombre Usuario");
            nombreUsuarioPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarContraseña = function(e) {
            passwordPersona.setAttribute("placeholder", "Contraseña");
            passwordPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarConfirmacionContraseña = function(e) {
            confPasswordPersona.setAttribute("placeholder", "Validar Contraseña");
            confPasswordPersona.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }

        nombrePersona.addEventListener("click", validarNombre);
        apellidoPersona.addEventListener("click", validarApellido);
        telefonoPersona.addEventListener("click", validarTelefono);
        emailUsuario.addEventListener("click", validarEmail);
        selectComuna.addEventListener("click", validarComuna);
        nombreUsuarioPersona.addEventListener("click", validarUsuario);
        direccionPersona.addEventListener("click", validarDireccion);
        passwordPersona.addEventListener("click", validarContraseña);
        confPasswordPersona.addEventListener("click", validarConfirmacionContraseña);

        password = md5(password);
        confPassword = md5(confPassword);

        if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9) {
            //Agrega los append para no tener que tocar el controlador y reutilizar codigo
            var formData = new FormData($("#form-nuevo-usuario")[0]);
            formData.append("psw", password);
            formData.append("selectNivelUsuarioAgregar", nivel);
            formData.append("direccionPersona", direccion);

            $.ajax({
                    url: URL + 'usuarios/add_usuario_post/',
                    type: 'POST',
                    data: formData,
                    cache: false,

                    contentType: false,
                    processData: false
                }).done(function(data) {

                    var dato = JSON.parse(data);

                    if (dato['valid']) {

                        $("#modal-nuevo-usuario").modal("hide");
                        Swal.fire({
                            icon: 'success',
                            type: "success",
                            title: 'Usuario',
                            html: '<p>Usuario registrado con exito.</p>',
                            showConfirmButton: true
                        });

                    } else {
                        //mostramos sweet alert
                        Swal.fire({
                            icon: 'error',
                            type: "error",
                            title: 'Usuario',
                            html: '<p>' + dato['msg'] + '</p>',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function() {

                    Swal.fire({
                        icon: 'error',
                        type: "error",
                        title: 'Usuario',
                        html: '<p>Error al registrar usuario</p>',
                        showConfirmButton: true
                    });
                });
        } else {

        }
    });
});
//Alerta visual de contasena incorrecta o usuario
$(document).ready(function() {
    $('#ingreso_usuario').click(function(e) {

        e.preventDefault();
        var val1, val2;
        var usuario = $('#username').val();
        var contraseña = $('#password').val();
        if (contraseña == null || contraseña.length == 0 || contraseña == '') {
            password.setAttribute("style", "border-color:red;");
            password.setAttribute("placeholder", "Ingrese Una Contraseña");

            val1 = false;
        } else {
            val1 = true;
        }
        if (usuario == null || usuario.length == 0 || usuario == '') {
            username.setAttribute("style", "border-color:red;");
            username.setAttribute("placeholder", "Ingrese un Usuario");

            val2 = false;
        } else {
            val2 = true;
        }


        var validarUsuario = function(e) {
            username.setAttribute("placeholder", "Usuario");
            username.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }
        var validarContraseña = function(e) {
            password.setAttribute("placeholder", "Contraseña");
            password.setAttribute("style", "border-color:Write;");
            e.preventDefault();
        }

        password.addEventListener("click", validarContraseña);
        username.addEventListener("click", validarUsuario);

        if (val1 && val2) {
            //Agrega los append para no tener que tocar el controlador y reutilizar codigo
            var formData = new FormData($("#login")[0]);


            $.ajax({

                    url: URL + 'admin/login',
                    type: 'POST',
                    data: formData,
                    cache: false,

                    contentType: false,
                    processData: false
                }).done(function(data) {

                    var dato = JSON.parse(data);

                    if (dato['valid']) {

                        $("#login").modal("hide");

                        window.location.replace("dashboard");


                    } else {
                        //mostramos sweet alert
                        Swal.fire({
                            icon: 'error',
                            type: "error",
                            title: 'Usuario',
                            html: '<p>' + "Usuario o contraseña incorrectos" + '</p>',
                            showConfirmButton: true
                        });
                    }
                })
                .fail(function() {

                    Swal.fire({
                        icon: 'error',
                        type: "error",
                        title: 'Usuario',
                        html: '<p>Error al registrar usuario</p>',
                        showConfirmButton: true
                    });
                });
        } else {

        }
    });

});

//--- Validaciones Seccion 2 (cotizador) ---//
$(document).ready(function() {
    $('#cotizar').click(function(e) {
        var cantidad = $('#cantidadCajas').val();
        var tamaño = $('#comboTamañoCaja').val();
        var origen = $('#comboDesde').val();
        var destino = $('#comboHasta').val();
        var val1, val2, val3, val4
        console.log(cantidad);
        e.preventDefault();

        //validacion de campos
        if (cantidad == null || cantidad.length == 0 || cantidad == '' || cantidad < 1) {
            cantidadCajas.setAttribute("style", "border-color:red; border:1.5px solid red;");
            val1 = false;
        } else {
            val1 = true;
        }
        if (tamaño == 'Tamaño') {
            comboTamañoCaja.setAttribute("style", "border-color:red; border:1.5px solid red;");
            val2 = false;
        } else {

            val2 = true;
        }

        if (origen == 'Origen') {
            comboDesde.setAttribute("style", "border-color:red; border:1.5px solid red;");
            val3 = false;
        } else {

            val3 = true;
        }
        if (destino == 'Destino') {
            comboHasta.setAttribute("style", "border-color:red; border:1.5px solid red;");
            val4 = false;
        } else {

            val4 = true;
        }

        e.preventDefault();
        var validarCantidad = function(e) {
            cantidadCajas.setAttribute("style", "border-color: #ED0556;");
            e.preventDefault();
        }
        var validarTamaño = function(e) {
            comboTamañoCaja.setAttribute("style", "border-color: #ED0556;");
            e.preventDefault();
        }
        var validarOrigen = function(e) {
            comboDesde.setAttribute("style", "border-color: #ED0556;");
            e.preventDefault();
        }
        var validarDestino = function(e) {
            comboHasta.setAttribute("style", "border-color: #ED0556;");
            e.preventDefault();
        }
        cantidadCajas.addEventListener("click", validarCantidad);
        comboTamañoCaja.addEventListener("click", validarTamaño);
        comboDesde.addEventListener("click", validarOrigen);
        comboHasta.addEventListener("click", validarDestino);

        if (val1 && val2 && val3 && val4) {

            var formData = new FormData($("#cotizador")[0]);
            formData.append("cantidadCajas", cantidad);
            formData.append("ComboTamañoCaja", tamaño);
            formData.append("comboDesde", origen);
            formData.append("comboHasta", destino);


            $.ajax({

                url: URL + 'dashboard_publico/cotizar',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(data) {

                var dato = JSON.parse(data);

                if (dato['valid']) {


                    origen = dato['comunaOrigen'][0]['nombre'];
                    destino = dato['comunaDestino'][0]['nombre'];
                    cantidad = dato['cantidad'];


                    precio = dato['precio'];


                    tamaño = document.getElementById("comboTamañoCaja").value;

                    $('#modal3').modal("show");
                    $("#origen_text").html("Origen: " + origen) ;
                  
                    $("#destino_text").html("Destino: " + destino);
                    $("#cantidad_text").html("Cantidad De Cajas: " + cantidad);
                    $("#tamaño_text").html("Tamaño De Cajas: " + tamaño);
                    $("#precio_total").html("Precio total: " + "$" + number_format(precio,2, ",", "."));
                }
            })

        } else {

        }



    });
});

//Validacion de envio de mail -POST
$(document).ready(function() {
    $('#enviar').click(function(e) {
        var val1, val2, val3;
        var nombre = $('#nombre').val();
        var email = $('#email').val();
        var mensaje = $('#mensaje').val();
        
        var formData = new FormData($("#contact")[0]);
        formData.append("nombre", nombre);
        formData.append("email", email);
        formData.append("mensaje", mensaje);

        if (nombre == '' || nombre == null || nombre.length == 0) {
            val1 = false;
        } else {
            val1 = true;
        }

        if (email == '' || email == null || email.length == 0) {
            val2 = false;
        } else {
            val2 = true;
        }

        if (mensaje == '' || mensaje == null || mensaje.length == 0) {
            val3 = false;
        } else {
            val3 = true;
        }


        if (val1 && val2 && val3) {
            $.ajax({
                url: URL + 'contactenos/contact_form',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function(data) {

                var dato = JSON.parse(data);

                if (dato['valid']) {

                    document.getElementById("nombre").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("mensaje").value = "";

                    Swal.fire({
                        icon: 'success',
                        type: "success",
                        title: 'Contacto',
                        html: '<p>' + dato['msg'] + '</p>',
                        showConfirmButton: true
                    });
                }
            }).fail(function() {
                Swal.fire({
                    icon: 'error',
                    type: "error",
                    title: 'Contacto',
                    html: '<p>' + dato['msg'] + '</p>',
                    showConfirmButton: true
                });
            });
        } else {
            Swal.fire({
                icon: 'error',
                type: "error",
                title: 'Contacto',
                html: '<p>Completar todo los datos, faltan datos minimos para la consulta. Vuelva a intentarlo</p>',
                showConfirmButton: true
            });
        }
    });
});
