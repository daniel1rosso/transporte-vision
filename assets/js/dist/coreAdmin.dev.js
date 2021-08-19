"use strict";

function vaciado_agregar_usuario() {
  //cerrar_modal_agregar
  console.log('hola');
  document.getElementById("form-agregar-usuario").reset();
  $("#nombrePersona").val('');
  $("#apellidoPersona").val('');
  $("#telefonoPersona").val('');
  $("#emailUsuarioPersona").val('');
  $("#nombreUsuarioPersona").val('');
  $("#selectComuna").val(0).trigger('change');
  $("#selectNivelUsuarioAgregar").val(0).trigger('change');
  $("#passwordPersona").val('');
  $("#direccionPersona").val('');
}
/*
function vaciado_agregar_pedido() {
    document.getElementById("form-solicitud-envio").reset();
    $("#empresa_formSolicitudEnvio").val('');
    $("#direccion_formSolicitudEnvio").val('');
    $("#direccionDespacho_formSolicitudEnvio").val('');
    $("#telefono_formSolicitudEnvio").val('');
    $("#fechaRetiro_formSolicitudEnvio").val('');
    $("#horaHasta_formSolicitudEnvio").val('');
    $("#horaDesde_formSolicitudEnvio").val('');
    $("#horaHasta1_formSolicitudEnvio").val('');
    $("#horaDesde1_formSolicitudEnvio").val('');
    $("#comuna_formSolicitudEnvio").val(0).trigger('change');
    $("#comunaDespacho_formSolicitudEnvio").val(0).trigger('change');
    $("#fechaDespachoEstimada_formSolicitudEnvio").val('');
    $("#nombreReceptor_formSolicitudEnvio").val('');
    $("#direccionDespacho_formSolicitudEnvio").val('');
}
*/
////////////// USUARIOS DEL SISTEMA ////////////////////////


$(document).ready(function () {
  var temp_password;
  /**
   * Funcion para agregar un usuario en el sistema
   */

  $('#agregarUsuario').click(function (e) {
    e.preventDefault(); //--- Definiciones de variables ---//

    var val1, val2, val3, val4, val5, val6, val7, val8, val9;
    var nombre = $('#nombrePersona').val();
    var apellido = $('#apellidoPersona').val();
    var telefono = $('#telefonoPersona').val();
    var email = $('#emailUsuario').val();
    var nombreUsuario = $('#nombreUsuarioPersona').val();
    var comuna = $('#selectComuna').val();
    var direccion = $('#direccionPersona').val();
    var nivel = $('#selectNivelUsuarioAgregar').val();
    var password = $('#passwordPersona').val();
    password = md5(password); //--- Validaciones de campos obligatorios ---//

    if (nombre == null || nombre.length == 0 || nombre == '') {
      $("#errorNombrePersona").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersona").css("display", "none");
      val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == '') {
      $("#errorApellidoPersona").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersona").css("display", "none");
      val2 = true;
    }

    if (email == null || email.length == 0 || email == '' || !/\S+@\S+\.\S+/.test(email)) {
      $("#errorEmailUsuario").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuario").css("display", "none");
      val3 = true;
    }

    if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
      $("#errorUsuarioPersona").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersona").css("display", "none");
      val4 = true;
    }

    if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
      $("#errorTelefonoPersona").css("display", "block");
      val5 = false;
    } else {
      $("#errorTelefonoPersona").css("display", "none");
      val5 = true;
    }

    if (password == null || password.length == 0 || password == '') {
      $("#errorPassword").css("display", "block");
      val6 = false;
    } else {
      $("#errorPassword").css("display", "none");
      val6 = true;
    }

    if (comuna == 0) {
      $("#errorSelectComunaPersona").css("display", "block");
      val7 = false;
    } else {
      $("#errorSelectComunaPersona").css("display", "none");
      val7 = true;
    }

    if (nivel == 0) {
      $("#errorNivelPersona").css("display", "block");
      val8 = false;
    } else {
      $("#errorNivelPersona").css("display", "none");
      val8 = true;
    }

    if (direccion == null || direccion.length == 0 || direccion == '') {
      $("#errorDireccionPersona").css("display", "block");
      val9 = false;
    } else {
      $("#errorDireccionPersona").css("display", "none");
      val9 = true;
    }

    if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9) {
      var formData = new FormData($("#form-agregar-usuario")[0]);
      formData.append("psw", password);
      $.ajax({
        url: URL + 'usuarios/add_usuario_post/',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          $("#modal-agregar-usuario").modal("hide");
          var table_usuarios = $('#listado_usuarios').DataTable();
          var acciones = '';
          acciones = '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Usuario"><i class="fa fa-edit"></i></a> &nbsp;' + '<a class="tip" role="button" onclick="eliminar_usuario(' + dato['usuario'][0]['idUsuario'] + ')" data-toggle="modal" style="color: #4e73df;" data-original-title="Eliminar"><i class="fas fa-trash"></i></a>';
          var row = table_usuarios.row.add([dato['usuario'][0]['idUsuario'], dato['usuario'][0]['nombreCompleto'] + ', ' + dato['usuario'][0]['apellido'], dato['usuario'][0]['usuario'], dato['usuario'][0]['email'], acciones]).draw(false);
          row.nodes().to$().attr('id', dato['usuario'][0]['idUsuario']);
          table_usuarios.row(row).column(0).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(1).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(2).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(3).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(4).nodes().to$().addClass('text-center');
          Swal.fire({
            icon: 'success',
            type: "success",
            title: 'Usuario',
            html: '<p>Usuario guardado con exito.</p>',
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
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Usuario',
          html: '<p>Error al mandar los datos</p>',
          showConfirmButton: true
        });
      });
    } else {}
  });
  /**Funcion
   * abrir el modal de usuarios y setear los datos en los campos para luego modificarlos
   */

  $("#listado_usuarios").on("click", "a.modificarUsuario", function (e) {
    var idUsuario = $(this).data('id');
    var dataString = 'id=' + idUsuario;
    $.ajax({
      url: URL + 'usuarios/get_usuario_byId/',
      type: 'POST',
      data: dataString
    }).done(function (data) {
      var dato = JSON.parse(data);
      console.log(dato);

      if (dato['valid']) {
        $("#modal-cargando").modal("hide");
        $("#modal-editar-usuario").modal("show");
        document.getElementById("idUsuarioModificar").value = idUsuario;
        document.getElementById("nombrePersonaModificar").value = dato['usuario'][0]['nombreCompleto'];
        document.getElementById("apellidoPersonaModificar").value = dato['usuario'][0]['apellido'];
        document.getElementById("telefonoPersonaModificar").value = dato['usuario'][0]['telefono'];
        document.getElementById("emailUsuarioModificar").value = dato['usuario'][0]['email'];
        document.getElementById("nombreUsuarioPersonaModificar").value = dato['usuario'][0]['usuario'];
        document.getElementById("direccionPersonaModificar").value = dato['usuario'][0]['direccion'];
        document.getElementById("passwordPersonaModificar").value = dato['usuario'][0]['password'];
        $('#selectComunaModificar').val(dato['usuario'][0]['idComuna']).trigger('change');
        $('#selectNivelUsuarioModificar').val(dato['usuario'][0]['idNivel']).trigger('change');
        temp_password = document.getElementById("passwordPersonaModificar").value = dato['usuario'][0]['password'];
      } else {
        //mostramos sweet alert
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Usuario',
          html: '<p>Usuario seleccionado no encontrado.</p>',
          showConfirmButton: true
        });
      }
    }).fail(function () {
      //mostramos sweet alert
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Usuario',
        html: '<p>Ocurrio un error. Por favor contacte con el administrador del sistema.</p>',
        showConfirmButton: true
      });
      ;
    });
  });
  $('#modificarUsuarioBTN').click(function (e) {
    e.preventDefault();
    var val1, val2, val3, val4, val5, val6, val7, val8, val9;
    var nombre = $('#nombrePersonaModificar').val();
    var apellido = $('#apellidoPersonaModificar').val();
    var telefono = $('#telefonoPersonaModificar').val();
    var email = $('#emailUsuarioModificar').val();
    var comuna = $('#selectComunaModificar').val();
    var nombreUsuario = $('#nombreUsuarioPersonaModificar').val();
    var password = $('#passwordPersonaModificar').val();
    var nivel = $('#selectNivelUsuarioModificar').val();
    var direccion = $('#direccionPersonaModificar').val(); //--- Validaciones de campos obligatorios ---//

    if (nombre == null || nombre.length == 0 || nombre == '') {
      $("#errorNombrePersonaModificar").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersonaModificar").css("display", "none");
      val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == '') {
      $("#errorApellidoPersonaModificar").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersonaModificar").css("display", "none");
      val2 = true;
    }

    if (email == null || email.length == 0 || email == '' || !/\S+@\S+\.\S+/.test(email)) {
      $("#errorEmailUsuarioModificar").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuarioModificar").css("display", "none");
      val3 = true;
    }

    if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
      $("#errorUsuarioPersonaModificar").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersonaModificar").css("display", "none");
      val4 = true;
    }

    if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
      $("#errorTelefonoPersonaModificar").css("display", "block");
      val5 = false;
    } else {
      $("#errorTelefonoPersonaModificar").css("display", "none");
      val5 = true;
    }

    if (password == null || password.length == 0 || password == '') {
      $("#errorPasswordModificar").css("display", "block");
      val6 = false;
    } else {
      $("#errorPasswordModificar").css("display", "none");
      val6 = true;
    }

    if (comuna == 0) {
      $("#errorSelectComunaPersonaModificar").css("display", "block");
      val7 = false;
    } else {
      $("#errorSelectComunaPersonaModificar").css("display", "none");
      val7 = true;
    }

    if (nivel == 0) {
      $("#errorNivelPersonaModificar").css("display", "block");
      val8 = false;
    } else {
      $("#errorNivelPersonaModificar").css("display", "none");
      val8 = true;
    }

    if (direccion == null || direccion.length == 0 || direccion == '') {
      $("#errorDireccionPersonaModificar").css("display", "block");
      val8 = false;
    } else {
      $("#errorDireccionPersonaModificar").css("display", "none");
      val8 = true;
    }

    if (document.getElementById("passwordPersonaModificar").value != temp_password) {
      password = md5(password);
    }

    if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8) {
      var formData = new FormData($("#form-modificar-usuario")[0]);
      formData.append("nombrePersonaModificar", nombre);
      formData.append("psw", password);
      $.ajax({
        url: URL + 'usuarios/modificar_usuario_post',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          var table_usuarios = $('#listado_usuarios').DataTable();
          $("#listado_usuarios").dataTable().fnDeleteRow("#" + dato['usuario'][0]['idUsuario']);
          table_usuarios.row(dato['usuario'][0]['idUsuario']).remove().draw();
          var acciones = '';
          acciones = '<a class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Usuario"><i class="fa fa-edit"></i></a> &nbsp;' + '<a onclick="eliminar_usuario(' + "'" + dato['usuario'][0]['idUsuario'] + "'" + ')"' + ' class="tip deleteUsuario" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';
          var row = table_usuarios.row.add([dato['usuario'][0]['idUsuario'], dato['usuario'][0]['apellido'] + ', ' + dato['usuario'][0]['nombreCompleto'], dato['usuario'][0]['usuario'], dato['usuario'][0]['email'], acciones]).draw(false);
          row.nodes().to$().attr('id', dato['usuario'][0]['idUsuario']);
          table_usuarios.row(row).column(0).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(1).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(2).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(3).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(4).nodes().to$().addClass('text-center'); //para ocultar el div

          $("#modal-editar-usuario").modal("hide");
          $('.modal-backdrop').remove();
          Swal.fire({
            icon: 'success',
            type: "success",
            title: 'Usuario',
            html: '<p>Se modificó el usuario con exito</p>',
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
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Usuario',
          html: '<p>Ocurrio un error. Contactar al Administrador del sistema.</p>',
          showConfirmButton: true
        });
      });
    } else {
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Usuario',
        showConfirmButton: true
      });
    }
  });
  $('#aceptar_solicitud_envioBTN').click(function (e) {
    e.preventDefault();
    /**
     *Aca se levanta el modal secundario donde hay que llevarlo a la confrmacion de los datos para que funcione
     */

    $('#modal-agregar-pedido').modal('hide').on('hidden.bs.modal', function (e) {
      $('#modal-agregar-producto').modal('show');
      $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
    });
    var val1, val2, val3, val4, val5, val6, val7, val8;
    var nombre = $('#empresa_formSolicitudEnvio').val();
    var apellido = $('#direccion_formSolicitudEnvio').val();
    var telefono = $('#telefono_formSolicitudEnvio').val();
    var email = $('#fechaRetiro_formSolicitudEnvio').val();
    var comuna = $('#horaDesde_formSolicitudEnvio').val();
    var nombreUsuario = $('#horaHasta_formSolicitudEnvio').val();
    var password = $('#comuna_formSolicitudEnvio').val();
    var password = $('#nombreReceptor_formSolicitudEnvio').val();
    var password = $('#direccionDespacho_formSolicitudEnvio').val();
    var nivel = $('#comunaDespacho_formSolicitudEnvio').val();
    var nivel = $('#fechaDespachoEstimada_formSolicitudEnvio').val();
    var nivel = $('#horaDesde_formSolicitudEnvio').val();
    var nivel = $('#horaHasta_formSolicitudEnvio').val(); //--- Validaciones de campos obligatorios ---//

    if (nombre == null || nombre.length == 0 || nombre == '') {
      $("#errorNombrePersonaModificar").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersonaModificar").css("display", "none");
      val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == '') {
      $("#errorApellidoPersonaModificar").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersonaModificar").css("display", "none");
      val2 = true;
    }

    if (email == null || email.length == 0 || email == '' || !/\S+@\S+\.\S+/.test(email)) {
      $("#errorEmailUsuarioModificar").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuarioModificar").css("display", "none");
      val3 = true;
    }

    if (nombreUsuario == null || nombreUsuario.length == 0 || nombreUsuario == '') {
      $("#errorUsuarioPersonaModificar").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersonaModificar").css("display", "none");
      val4 = true;
    }

    if (telefono == null || telefono.length == 0 || telefono == '' || isNaN(telefono)) {
      $("#errorTelefonoPersonaModificar").css("display", "block");
      val5 = false;
    } else {
      $("#errorTelefonoPersonaModificar").css("display", "none");
      val5 = true;
    }

    if (password == null || password.length == 0 || password == '') {
      $("#errorPasswordModificar").css("display", "block");
      val6 = false;
    } else {
      $("#errorPasswordModificar").css("display", "none");
      val6 = true;
    }

    if (comuna == 0) {
      $("#errorSelectComunaPersonaModificar").css("display", "block");
      val7 = false;
    } else {
      $("#errorSelectComunaPersonaModificar").css("display", "none");
      val7 = true;
    }

    if (nivel == 0) {
      $("#errorNivelPersonaModificar").css("display", "block");
      val8 = false;
    } else {
      $("#errorNivelPersonaModificar").css("display", "none");
      val8 = true;
    }

    if (document.getElementById("passwordPersonaModificar").value != temp_password) {
      password = md5(password);
    }

    if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8) {
      var formData = new FormData($("#form-modificar-usuario")[0]);
      $.ajax({
        url: URL + 'usuarios/modificar_usuario_post',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          var table_usuarios = $('#listado_usuarios').DataTable();
          $("#listado_usuarios").dataTable().fnDeleteRow("#" + dato['usuario'][0]['idUsuario']);
          table_usuarios.row(dato['usuario'][0]['idUsuario']).remove().draw();
          var acciones = '';
          acciones = '<a class="tip modificarUsuario" data-id="' + dato['usuario'][0]['idUsuario'] + '" data-toggle="modal" style="color: #4e73df;" data-original-title="Editar Usuario"><i class="fa fa-edit"></i></a> &nbsp;' + '<a onclick="eliminar_usuario(' + "'" + dato['usuario'][0]['idUsuario'] + "'" + ')"' + ' class="tip deleteUsuario" role="button" style="color: #4e73df;" data-original-title="Eliminar"><i class="fa fa-trash"></i></a>';
          var row = table_usuarios.row.add([dato['usuario'][0]['idUsuario'], dato['usuario'][0]['apellido'] + ', ' + dato['usuario'][0]['nombreCompleto'], dato['usuario'][0]['usuario'], dato['usuario'][0]['email'], acciones]).draw(false);
          row.nodes().to$().attr('id', dato['usuario'][0]['idUsuario']);
          table_usuarios.row(row).column(0).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(1).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(2).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(3).nodes().to$().addClass('text-center');
          table_usuarios.row(row).column(4).nodes().to$().addClass('text-center'); //para ocultar el div

          $("#modal-editar-usuario").modal("hide");
          $('.modal-backdrop').remove();
          Swal.fire({
            icon: 'success',
            type: "success",
            title: 'Usuario',
            html: '<p>Se modificó el usuario con exito</p>',
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
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Usuario',
          html: '<p>Ocurrio un error. Contactar al Administrador del sistema.</p>',
          showConfirmButton: true
        });
      });
    } else {
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Usuario',
        showConfirmButton: true
      });
    }
  });
});
$(); //End add

function eliminar_usuario(idUsuario) {
  Swal.fire({
    title: "Usuario",
    text: "¿Desea eliminar el usuario?",
    icon: "warning",
    confirmButtonText: 'Borrar',
    showCancelButton: true,
    cancelButtonText: 'Cancel'
  }).then(function (result) {
    if (result.value) {
      $.ajax({
        url: URL + 'usuarios/eliminar_usuario/',
        type: 'POST',
        cache: false,
        data: {
          idUsuario: idUsuario
        }
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          Swal.fire('Usuario', 'Usuario eliminado exitosamente', 'success');
          $('#listado_usuarios').dataTable().fnDeleteRow("#" + idUsuario);
        } else {
          Swal.fire('Error!', 'No se pudo eliminar el usuario', 'error');
        }
      }).fail(function (data) {
        Swal.fire('Error!', 'No se pudo eliminar el usuario', 'error');
      });
    }
  });
} //--- Agregado del Detalle del pedido ---//


$(document).ready(function () {
  $('#detalle_pedido_js').click(function (e) {
    e.preventDefault();
    var idCliente = $('#idClienteEnvio_formSolicitudEnvio').val();
    var telefono = $('#telefono_formSolicitudEnvio').val();
    var direccion = $('#direccion_formSolicitudEnvio').val();
    var comuna = $('#comuna_formSolicitudEnvio').val();
    var fechaRetiro = $('#fechaRetiro_formSolicitudEnvio').val();
    var val1, val2, val3, val4, val5; //--- Validaciones de campos obligatorios ---//

    if (idCliente == null || idCliente == '') {
      val1 = false;
    } else {
      val1 = true;
    }

    if (telefono == "" || telefono.length == 0) {
      val2 = false;
    } else {
      val2 = true;
    }

    if (direccion == null || direccion.length == 0 || direccion == '') {
      val3 = false;
    } else {
      val3 = true;
    }

    if (comuna == 0) {
      val4 = false;
    } else {
      val4 = true;
    }

    if (fechaRetiro == null || fechaRetiro.length == 0 || fechaRetiro == '') {
      val5 = false;
    } else {
      val5 = true;
    }

    if (val1 && val2 && val3 && val4 && val5) {
      var formData = new FormData($("#formSolicitudEnvio")[0]);
      $.ajax({
        url: URL + 'pedidos/add_detalle_pedidos/',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          $('#idClienteEnvio_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#telefono_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#direccion_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#comuna_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#fechaRetiro_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#empresa_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#horaDesde_formSolicitudEnvio').attr('disabled', 'disabled');
          $('#horaHasta_formSolicitudEnvio').attr('disabled', 'disabled'); //--- Asignaciones ---//

          document.getElementById("idPedido_formSolicitudEnvio").value = dato['idPedido']; //--- Datos en la tabla ---//

          var table_add_pedido = $('#listado_add_pedidos').DataTable();
          var acciones = '';
          acciones = '<a class="tip" role="button" onclick="eliminar_pedido(' + dato['idDetallePedido'] + ')" style="color: #4e73df;" data-original-title="Eliminar"><i class="fas fa-trash"></i></a>';
          var row = table_add_pedido.row.add([dato['idDetallePedido'], dato['nombreReceptor'], dato['comuna'], dato['cantidad'], "$" + number_format(dato['precio'], 2, ",", "."), dato['tamaño'], acciones]).draw(false);
          row.nodes().to$().attr('id', dato['idDetallePedido']);
          table_add_pedido.row(row).column(0).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(1).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(2).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(3).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(4).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(5).nodes().to$().addClass('text-center');
          table_add_pedido.row(row).column(6).nodes().to$().addClass('text-center'); //--- Vaciado de campos para continuar agregando otros pedidos ---//

          document.getElementById("nombreReceptor_formSolicitudEnvio").value = "";
          document.getElementById("telefonoDespacho_formSolicitudEnvio").value = "";
          document.getElementById("direccionDespacho_formSolicitudEnvio").value = "";
          document.getElementById("fechaDespachoEstimada_formSolicitudEnvio").value = "";
          document.getElementById("horaDesde1_formSolicitudEnvio").value = "";
          document.getElementById("horaHasta1_formSolicitudEnvio").value = "";
          document.getElementById("cantidad_formSolicitudEnvio").value = "";
          document.getElementById("observacion_pedido").value = "";
          $('#comunaDespacho_formSolicitudEnvio').val(0).trigger('change');
          $('#tamaño_producto').val(0).trigger('change');
          var montoTotal = $('#montoTotal_formSolicitudEnvio').val();
          var cantidadPedidos = $('#cantidad_pedidos_formSolicitudEnvio').val();
          document.getElementById("montoTotal_formSolicitudEnvio").value = parseFloat(montoTotal) + parseFloat(dato['precio']);
          document.getElementById("cantidad_pedidos_formSolicitudEnvio").value = parseInt(cantidadPedidos) + 1; //--- Alerta de mensaje ---//

          Swal.fire({
            icon: 'success',
            type: "success",
            title: 'Pedido',
            html: '<p>' + dato['msg'] + '</p>',
            showConfirmButton: true
          });
        } else {
          //mostramos sweet alert
          Swal.fire({
            icon: 'error',
            type: "error",
            title: 'Pedido',
            html: '<p>' + dato['msg'] + '</p>',
            showConfirmButton: true
          });
        }
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Pedido',
          html: '<p>Error al mandar los datos</p>',
          showConfirmButton: true
        });
      });
    } else {
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Pedido',
        html: '<p>Error, completar los datos del emisor antes de agregar pedidos</p>',
        showConfirmButton: true
      });
    }
  });
}); //--- Fin Agregado del Detalle del pedido ---//
//--- Agregado del Detalle del pedido ---//

$(document).ready(function () {
  $('#add_pedido_js').click(function (e) {
    e.preventDefault();
    var idPedido = $('#idPedido_formSolicitudEnvio').val();
    var montoTotal = $('#montoTotal_formSolicitudEnvio').val();
    var cantidadPedidos = $('#cantidad_pedidos_formSolicitudEnvio').val();

    if (cantidadPedidos > 0) {
      $.ajax({
        url: URL + 'pedidos/add_pedido_final/',
        type: 'POST',
        data: {
          idPedido: idPedido,
          montoTotal: montoTotal,
          cantidadPedidos: cantidadPedidos
        }
      }).done(function (data) {
        var dato = JSON.parse(data);

        if (dato['valid']) {
          //--- Alerta de mensaje ---//
          Swal.fire({
            icon: 'success',
            type: "success",
            title: 'Pedido',
            html: '<p>' + dato['msg'] + '<br>Monto total: ' + "$" + number_format(dato['montoTotal'], 2, ",", ".") + '</p>',
            showConfirmButton: true,
            allowOutsideClick: false,
            preConfirm: function preConfirm(login) {
              setTimeout(function () {
                location.href = URL + 'pedidos/listar_pedidos';
              }, 100);
            }
          });
        } else {
          //mostramos sweet alert
          Swal.fire({
            icon: 'error',
            type: "error",
            title: 'Pedido',
            html: '<p>' + dato['msg'] + '<br>Monto total: ' + "$" + number_format(dato['montoTotal'], 2, ",", ".") + '</p></p>',
            showConfirmButton: true
          });
        }
      }).fail(function () {
        Swal.fire({
          icon: 'error',
          type: "error",
          title: 'Pedido',
          html: '<p>Error al mandar los datos</p>',
          showConfirmButton: true
        });
      });
    } else {
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Pedido',
        html: '<p>Debe contener al menos un pedido asociado para guardar y finalizar el pedido</p>',
        showConfirmButton: true
      });
    }
  });
}); //--- Fin Agregado del Detalle del pedido ---//
//--- Eliminado del Detalle del pedido ---//

function eliminar_pedido(idDetallePedido) {
  $.ajax({
    url: URL + 'pedidos/delete_detalle_pedido/',
    type: 'POST',
    data: {
      idDetallePedido: idDetallePedido
    }
  }).done(function (data) {
    var dato = JSON.parse(data);

    if (dato['valid']) {
      //--- Eliminamos el registro del datatable ---//
      tableListadoAddPedidos = $('#listado_add_pedidos').DataTable();
      tableListadoAddPedidos.row('#' + idDetallePedido).remove().draw(); //--- Restamos uno en el pedido y el precio ---//

      var montoTotal = $('#montoTotal_formSolicitudEnvio').val();
      var cantidadPedidos = $('#cantidad_pedidos_formSolicitudEnvio').val();
      document.getElementById("montoTotal_formSolicitudEnvio").value = parseFloat(parseFloat(montoTotal) - parseFloat(dato['montoTotal']));
      document.getElementById("cantidad_pedidos_formSolicitudEnvio").value = parseInt(cantidadPedidos) - 1; //--- Alerta de mensaje ---//

      Swal.fire({
        icon: 'success',
        type: "success",
        title: 'Pedido',
        html: '<p>' + dato['msg'] + '</p>',
        showConfirmButton: true
      });
    } else {
      //mostramos sweet alert
      Swal.fire({
        icon: 'error',
        type: "error",
        title: 'Pedido',
        html: '<p>' + dato['msg'] + '</p></p>',
        showConfirmButton: true
      });
    }
  }).fail(function () {
    Swal.fire({
      icon: 'error',
      type: "error",
      title: 'Pedido',
      html: '<p>Error al mandar los datos</p>',
      showConfirmButton: true
    });
  });
} //--- Fin Eliminado del Detalle del pedido ---//
/////////////////////////////////// FUNCIONES GENERALES ////////////////////////////////////////
//--- Validacion de email ---//


function validarEmailAddUsuario() {
  var email = $('#emailUsuario').val();
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (!expr.test(email)) {
    $("#errorEmailUsuario").css("display", "block");
  } else {
    $("#errorEmailUsuario").css("display", "none");
  }
}

function validarEmailUpdateUsuario() {
  var email = $('#emailUsuarioModificar').val();
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (!expr.test(email)) {
    $("#errorEmailUsuarioUpdate").css("display", "block");
  } else {
    $("#errorEmailUsuarioUpdate").css("display", "none");
  }
} //--- Fin Validacion de Email ---//
//--- FORMAT NUMBER ---//


function number_format(amount, decimals) {
  amount += ''; // por si pasan un numero en vez de un string

  amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

  decimals = decimals || 0; // por si la variable no fue fue pasada
  // si no es un numero o es igual a cero retorno el mismo cero

  if (isNaN(amount) || amount === 0) return parseFloat(0).toFixed(decimals); // si es mayor o menor que cero retorno el valor formateado como numero

  amount = '' + amount.toFixed(decimals);
  var amount_parts = amount.split('.'),
      regexp = /(\d+)(\d{3})/;

  while (regexp.test(amount_parts[0])) {
    amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');
  } //return amount_parts.join('.');


  return amount_parts.toLocaleString('.');
}