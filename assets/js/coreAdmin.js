//--- FORMAT NUMBER ---//
var remito = 0;
function number_format(amount, decimals) {
  amount += ""; // por si pasan un numero en vez de un string
  amount = parseFloat(amount.replace(/[^0-9\.]/g, "")); // elimino cualquier cosa que no sea numero o punto

  decimals = decimals || 0; // por si la variable no fue fue pasada

  // si no es un numero o es igual a cero retorno el mismo cero
  if (isNaN(amount) || amount === 0) return parseFloat(0).toFixed(decimals);
  // si es mayor o menor que cero retorno el valor formateado como numero
  amount = "" + amount.toFixed(decimals);
  var amount_parts = amount.split("."),
    regexp = /(\d+)(\d{3})/;
  while (regexp.test(amount_parts[0]))
    amount_parts[0] = amount_parts[0].replace(regexp, "$1" + "." + "$2");
  //return amount_parts.join('.');
  return amount_parts.toLocaleString(".");
}

/**
 *function
 *Esta funcion nos permite cargar la visualizacion del remito segun envio por pdf
 */
function ver_remito(idEnvio) {
  $.ajax({
    url: URL + "envios/get_remito_idEnvio/",
    type: "POST",
    data: {
      idEnvio: idEnvio,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);

      if (dato["valid"]) {
        idGenEnvio = dato["remito"][0]["remito"];
        extensiones = idGenEnvio.substring(idGenEnvio.lastIndexOf("."));
        path = idGenEnvio.replace(extensiones, "");

        if (screen.width > 650) {
          var remitoArchivo =
            idGenEnvio.length > 0
              ? '<embed src="' +
                URL +
                "uploads/remitos/" +
                path +
                "/" +
                idGenEnvio +
                '" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">'
              : "No existe Remito asociado al Envío";

          Swal.fire({
            title: "Remito Nº " + dato["remito"][0]["nroRemito"],
            width: "800px",
            html: '<div class="col col-12">' + remitoArchivo + "</div>",
            allowOutsideClick: false,
            showCancelButton: false,
            confirmButtonText: "Cerrar",
          });
        } else {
          url = URL + "uploads/remitos/" + path + "/" + idGenEnvio;
          window.open(url, "_blank");
        }
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "pa tra", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar la visualizacion del conforme segun envio por pdf
 */
function ver_conforme(idEnvio) {
  $.ajax({
    url: URL + "envios/get_remito_idEnvio/",
    type: "POST",
    data: {
      idEnvio: idEnvio,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);

      if (dato["valid"]) {
        idGenEnvio = dato["remito"][0]["conforme"];
        extensiones = idGenEnvio.substring(idGenEnvio.lastIndexOf("."));
        path = idGenEnvio.replace(extensiones, "");

        if (screen.width > 650) {
          var remitoArchivo =
            idGenEnvio.length > 0
              ? '<embed src="' +
                URL +
                "uploads/conformes/" +
                path +
                "/" +
                idGenEnvio +
                '" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">'
              : "No existe Conforme asociado al Envío";

          Swal.fire({
            title: "Conforme Nº " + dato["remito"][0]["nroRemito"],
            width: "800px",
            html: '<div class="col col-12">' + remitoArchivo + "</div>",
            allowOutsideClick: false,
            showCancelButton: false,
            confirmButtonText: "Cerrar",
          });
        } else {
          url = URL + "uploads/conformes/" + path + "/" + idGenEnvio;
          console.log(path);
          window.open(url, "_blank");
        }
      }
    })
    .fail(function (data) {
      Swal.fire(
        "Envío",
        "Ocurrio un error, vuelva a intentarlo más tarde.",
        "error"
      );
    });
}

//End VIsualizacion remito

/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de retiro
 */
function cargar_localidades_retiro(idProvinciaRetiro) {
  $select = $("#localidadRetiro_formSolicitudEnvio");
  $.ajax({
    url: URL + "envios/cargar_localidades_retiro/",
    type: "POST",
    data: {
      idProvinciaRetiro: idProvinciaRetiro,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);
      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadRetiro"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de destino
 */
function cargar_localidades_destino(idProvinciaDestino) {
  $select = $("#localidadDestino_formSolicitudEnvio");
  $.ajax({
    url: URL + "envios/cargar_localidades_destino",
    type: "POST",
    data: {
      idProvinciaDestino: idProvinciaDestino,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);
      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadDestino"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de destino
 */
function cargar_localidades_retiro_modificar(idProvinciaRetiro) {
  $select = $("#localidadRetiro_formUpdateEnvio");
  $.ajax({
    url: URL + "envios/cargar_localidades_retiro",
    type: "POST",
    data: {
      idProvinciaRetiro: idProvinciaRetiro,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);
      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadRetiro"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de destino
 */
function cargar_localidades_destino_modificar(idProvinciaDestino) {
  $select = $("#localidadDestino_formUpdateEnvio");
  $.ajax({
    url: URL + "envios/cargar_localidades_destino",
    type: "POST",
    data: {
      idProvinciaDestino: idProvinciaDestino,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);
      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadDestino"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de destino en el usuario
 */
function cargar_localidades_usuario(idProvinciaCliente) {
  $select = $("#selectLocalidad");
  $.ajax({
    url: URL + "envios/cargar_localidades_cliente",
    type: "POST",
    data: {
      idProvinciaCliente: idProvinciaCliente,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);

      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadCliente"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
/**
 *function
 *Esta funcion nos permite cargar las localidades en el select para poder seleccionar la localidad de destino en el usuario en modificacion
 */
function cargar_localidades_usuario_modificar(idProvinciaClienteModificar) {
  $select = $("#selectLocalidadModificar");
  $.ajax({
    url: URL + "envios/cargar_localidades_cliente",
    type: "POST",
    data: {
      idProvinciaCliente: idProvinciaClienteModificar,
    },
  })
    .done(function (data) {
      var dato = JSON.parse(data);
      if (dato["valid"]) {
        $select.empty();
        $select.append("<option value= 0> Seleccionar Localidad </option>");
        $.each(dato["localidadCliente"], function (i, item) {
          $select.append(
            "<option value=" +
              item.idLocalidad +
              ">" +
              item.nombre +
              "</option>"
          );
        });
      }
    })
    .fail(function (data) {
      Swal.fire("Envío", "No se pudieron cargar las localidades", "error");
    });
}
function vaciado_agregar_usuario() {
  //cerrar_modal_agregar
  document.getElementById("form-agregar-usuario").reset();
  $("#nombrePersona").val("");
  $("#apellidoPersona").val("");
  $("#telefonoPersona").val("");
  $("#emailUsuarioPersona").val("");
  $("#nombreUsuarioPersona").val("");
  $("#selectLocalidad").val(0).trigger("change");
  $("#selectProvincia").val(0).trigger("change");
  $("#selectNivelUsuarioAgregar").val(0).trigger("change");
  $("#passwordPersona").val("");
  $("#direccionPersona").val("");
}

////////////// USUARIOS DEL SISTEMA ////////////////////////
$(document).ready(function () {
  var temp_password;
  /**
   * Funcion para agregar un usuario en el sistema
   */
  $("#agregarUsuario").click(function (e) {
    e.preventDefault();

    //--- Definiciones de variables ---//
    var val1, val2, val3, val4, val5, val6, val7, val8, val9;
    var nombre = $("#nombrePersona").val(); //
    var apellido = $("#apellidoPersona").val(); //
    var email = $("#emailUsuario").val(); //
    var nombreUsuario = $("#nombreUsuarioPersona").val();
    var provincia = $("#selectProvincia").val(); //
    var localidad = $("#selectLocalidad").val(); //
    var direccion = $("#direccionPersona").val(); //
    var nivel = $("#selectNivelUsuarioAgregar").val(); //
    var password = $("#passwordPersona").val();
    password = md5(password);
    //--- Validaciones de campos obligatorios ---//
    if (nombre == null || nombre.length == 0 || nombre == "") {
      $("#errorNombrePersona").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersona").css("display", "none");
      val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == "") {
      $("#errorApellidoPersona").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersona").css("display", "none");
      val2 = true;
    }

    if (
      email == null ||
      email.length == 0 ||
      email == "" ||
      !/\S+@\S+\.\S+/.test(email)
    ) {
      $("#errorEmailUsuario").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuario").css("display", "none");
      val3 = true;
    }

    if (
      nombreUsuario == null ||
      nombreUsuario.length == 0 ||
      nombreUsuario == ""
    ) {
      $("#errorUsuarioPersona").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersona").css("display", "none");
      val4 = true;
    }
    if (password == null || password.length == 0 || password == "") {
      $("#errorPassword").css("display", "block");
      val5 = false;
    } else {
      $("#errorPassword").css("display", "none");
      val5 = true;
    }
    if (provincia == 0) {
      $("#errorSelectProvinciaPersona").css("display", "block");
      val6 = false;
    } else {
      $("#errorSelectProvinciaPersona").css("display", "none");
      val6 = true;
    }
    if (localidad == 0) {
      $("#errorSelectLocalidadPersona").css("display", "block");
      val7 = false;
    } else {
      $("#errorSelectLocalidadPersona").css("display", "none");
      val7 = true;
    }
    if (nivel == 0) {
      $("#errorNivelPersona").css("display", "block");
      val8 = false;
    } else {
      $("#errorNivelPersona").css("display", "none");
      val8 = true;
    }

    if (direccion == null || direccion.length == 0 || direccion == "") {
      $("#errorDireccionPersona").css("display", "block");
      val9 = false;
    } else {
      $("#errorDireccionPersona").css("display", "none");
      val9 = true;
    }
    if (val1 && val2 && val3 && val4 && val6 && val7 && val8 && val9) {
      var formData = new FormData($("#form-agregar-usuario")[0]);
      formData.append("psw", password);
      $.ajax({
        url: URL + "usuarios/add_usuario_post/",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            $("#modal-agregar-usuario").modal("hide");

            console.log(
              window.location.href.substring(window.location.protocol.length)
            );
            console.log(URL);

            if (
              URL + "envios/add_envio" ==
              window.location.href.substring(window.location.protocol.length)
            ) {
              $("#idClienteEnvio_formSolicitudEnvio").append(
                new Option(
                  dato["usuario"][0]["apellido"] +
                    ", " +
                    dato["usuario"][0]["nombreCompleto"],
                  dato["usuario"][0]["idUsuario"]
                )
              );
            } else if (
              URL + "usuarios/listar_usuarios" !=
              window.location.href.substring(window.location.protocol.length)
            ) {
              var table_usuarios = $("#listado_usuarios").DataTable();
              var acciones = "";
              acciones =
                '<a href="#modal-editar-usuario" class="tip modificarUsuario" data-id="' +
                dato["usuario"][0]["idUsuario"] +
                '" data-toggle="modal" style="color: black; cursor:pointer;" title="Editar Usuario" data-original-title="Editar Usuario"><i class="fa fa-edit" style="color: #4e73df; cursor: pointer;" title="Modificar Usuario"></i></a> &nbsp;' +
                '<a class="tip" role="button" onclick="eliminar_usuario(' +
                dato["usuario"][0]["idUsuario"] +
                ')" data-toggle="modal" style="color: black; cursor: pointer;" title="Eliminar Usuario" data-original-title="Eliminar"><i class="fas fa-trash" style="color: #4e73df; cursor: pointer;" title="Eliminar Usuario""></i></a>';
              var row = table_usuarios.row
                .add([
                  dato["usuario"][0]["idUsuario"],
                  dato["usuario"][0]["apellido"] +
                    ", " +
                    dato["usuario"][0]["nombreCompleto"],
                  dato["usuario"][0]["usuario"],
                  dato["usuario"][0]["email"],
                  acciones,
                ])
                .draw(false);
              row.nodes().to$().attr("id", dato["usuario"][0]["idUsuario"]);
              table_usuarios
                .row(row)
                .column(0)
                .nodes()
                .to$()
                .addClass("text-center");
              table_usuarios
                .row(row)
                .column(1)
                .nodes()
                .to$()
                .addClass("text-center");
              table_usuarios
                .row(row)
                .column(2)
                .nodes()
                .to$()
                .addClass("text-center");
              table_usuarios
                .row(row)
                .column(3)
                .nodes()
                .to$()
                .addClass("text-center");
              table_usuarios
                .row(row)
                .column(4)
                .nodes()
                .to$()
                .addClass("text-center");
            }

            Swal.fire({
              icon: "success",
              type: "success",
              title: "Usuario",
              html: "<p>Usuario guardado con exito.</p>",
              showConfirmButton: true,
            });
          } else {
            //mostramos sweet alert
            Swal.fire({
              icon: "error",
              type: "error",
              title: "Usuario",
              html: "<p>" + dato["msg"] + "</p>",
              showConfirmButton: true,
            });
          }
        })
        .fail(function () {
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Usuario",
            html: "<p>Error al mandar los datos</p>",
            showConfirmButton: true,
          });
        });
    }
  });
  /**Funcion
   * abrir el modal de usuarios y setear los datos en los campos para luego modificarlos
   */
  $("#listado_usuarios").on("click", "a.modificarUsuario", function (e) {
    var idUsuario = $(this).data("id");
    var dataString = "id=" + idUsuario;
    $.ajax({
      url: URL + "usuarios/get_usuario_byId/",
      type: "POST",
      data: dataString,
    })
      .done(function (data) {
        var dato = JSON.parse(data);

        if (dato["valid"]) {
          $("#modal-cargando").modal("hide");
          $("#modal-editar-usuario").modal("show");
          document.getElementById("idUsuarioModificar").value = idUsuario;
          document.getElementById("nombrePersonaModificar").value =
            dato["usuario"][0]["nombreCompleto"];
          document.getElementById("apellidoPersonaModificar").value =
            dato["usuario"][0]["apellido"];
          document.getElementById("emailUsuarioModificar").value =
            dato["usuario"][0]["email"];
          document.getElementById("nombreUsuarioPersonaModificar").value =
            dato["usuario"][0]["usuario"];
          document.getElementById("direccionPersonaModificar").value =
            dato["usuario"][0]["direccion"];
          document.getElementById("passwordPersonaModificar").value =
            dato["usuario"][0]["password"];
          $("#selectProvinciaModificar")
            .val(dato["usuario"][0]["idProvincia"])
            .trigger("change");
          $("#selectLocalidadModificar")
            .val(dato["usuario"][0]["idLocalidad"])
            .trigger("change");
          $("#selectNivelUsuarioModificar")
            .val(dato["usuario"][0]["idNivel"])
            .trigger("change");
          temp_password = document.getElementById(
            "passwordPersonaModificar"
          ).value = dato["usuario"][0]["password"];
        } else {
          //mostramos sweet alert
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Usuario",
            html: "<p>Usuario seleccionado no encontrado.</p>",
            showConfirmButton: true,
          });
        }
      })
      .fail(function () {
        //mostramos sweet alert
        Swal.fire({
          icon: "error",
          type: "error",
          title: "Usuario",
          html:
            "<p>Ocurrio un error. Por favor contacte con el administrador del sistema.</p>",
          showConfirmButton: true,
        });
      });
  });
  $("#modificarUsuarioBTN").click(function (e) {
    e.preventDefault();
    var val1, val2, val3, val4, val5, val6, val7, val8, val9;
    var nombre = $("#nombrePersonaModificar").val();
    var apellido = $("#apellidoPersonaModificar").val();
    var email = $("#emailUsuarioModificar").val();
    var provincia = $("#selectProvinciaModificar").val();
    var localidad = $("#selectLocalidadModificar").val();
    var nombreUsuario = $("#nombreUsuarioPersonaModificar").val();
    var password = $("#passwordPersonaModificar").val();
    var nivel = $("#selectNivelUsuarioModificar").val();
    var direccion = $("#direccionPersonaModificar").val();
    //--- Validaciones de campos obligatorios ---//
    if (nombre == null || nombre.length == 0 || nombre == "") {
      $("#errorNombrePersonaModificar").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersonaModificar").css("display", "none");
      val1 = true;
    }

    if (apellido == null || apellido.length == 0 || apellido == "") {
      $("#errorApellidoPersonaModificar").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersonaModificar").css("display", "none");
      val2 = true;
    }

    if (
      email == null ||
      email.length == 0 ||
      email == "" ||
      !/\S+@\S+\.\S+/.test(email)
    ) {
      $("#errorEmailUsuarioModificar").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuarioModificar").css("display", "none");
      val3 = true;
    }
    if (
      nombreUsuario == null ||
      nombreUsuario.length == 0 ||
      nombreUsuario == ""
    ) {
      $("#errorUsuarioPersonaModificar").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersonaModificar").css("display", "none");
      val4 = true;
    }
    if (localidad == null || localidad.length == 0 || localidad == "") {
      $("#errorLocalidadPersonaModificar").css("display", "block");
      val5 = false;
    } else {
      $("#errorLocalidadPersonaModificar").css("display", "none");
      val5 = true;
    }
    if (provincia == null || provincia.length == 0 || provincia == "") {
      $("#errorprovinciaPersonaModificar").css("display", "block");
      val6 = false;
    } else {
      $("#errorprovinciaPersonaModificar").css("display", "none");
      val6 = true;
    }
    if (password == null || password.length == 0 || password == "") {
      $("#errorPasswordModificar").css("display", "block");
      val7 = false;
    } else {
      $("#errorPasswordModificar").css("display", "none");
      val7 = true;
    }
    if (nivel == 0) {
      $("#errorNivelPersonaModificar").css("display", "block");
      val8 = false;
    } else {
      $("#errorNivelPersonaModificar").css("display", "none");
      val8 = true;
    }
    if (direccion == null || direccion.length == 0 || direccion == "") {
      $("#errorDireccionPersonaModificar").css("display", "block");
      val9 = false;
    } else {
      $("#errorDireccionPersonaModificar").css("display", "none");
      val9 = true;
    }
    if (
      document.getElementById("passwordPersonaModificar").value != temp_password
    ) {
      password = md5(password);
    }
    if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8 && val9) {
      var formData = new FormData($("#form-modificar-usuario")[0]);
      formData.append("nombrePersonaModificar", nombre);
      formData.append("psw", password);
      $.ajax({
        url: URL + "usuarios/modificar_usuario_post",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (data) {
          var dato = JSON.parse(data);

          if (dato["valid"]) {
            var table_usuarios = $("#listado_usuarios").DataTable();
            $("#listado_usuarios")
              .dataTable()
              .fnDeleteRow("#" + dato["usuario"][0]["idUsuario"]);
            table_usuarios.row(dato["usuario"][0]["idUsuario"]).remove().draw();
            var acciones = "";
            acciones =
              '<a class="tip modificarUsuario" data-id="' +
              dato["usuario"][0]["idUsuario"] +
              '" data-toggle="modal" style="color: black; cursor: pointer;" data-original-title="Editar Usuario"><i class="fa fa-edit" style="color: #4e73df; cursor: pointer;" title="Modificar Usuario"></i></a> &nbsp;' +
              '<a onclick="eliminar_usuario(' +
              "'" +
              dato["usuario"][0]["idUsuario"] +
              "'" +
              ')"' +
              ' class="tip deleteUsuario" role="button" style="color: black;" data-original-title="Eliminar"><i class="fa fa-trash" style="color: #4e73df; cursor: pointer;" title="Eliminar Usuario"></i></a>';
            var row = table_usuarios.row
              .add([
                dato["usuario"][0]["idUsuario"],
                dato["usuario"][0]["apellido"] +
                  ", " +
                  dato["usuario"][0]["nombreCompleto"],
                dato["usuario"][0]["usuario"],
                dato["usuario"][0]["email"],
                acciones,
              ])
              .draw(false);
            row.nodes().to$().attr("id", dato["usuario"][0]["idUsuario"]);
            table_usuarios
              .row(row)
              .column(0)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(1)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(2)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(3)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(4)
              .nodes()
              .to$()
              .addClass("text-center");
            //para ocultar el div
            $("#modal-editar-usuario").modal("hide");
            $(".modal-backdrop").remove();
            Swal.fire({
              icon: "success",
              type: "success",
              title: "Usuario",
              html: "<p>Se modificó el usuario con exito</p>",
              showConfirmButton: true,
            });
          } else {
            //mostramos sweet alert
            Swal.fire({
              icon: "error",
              type: "error",
              title: "Usuario",
              html: "<p>" + dato["msg"] + "</p>",
              showConfirmButton: true,
            });
          }
        })
        .fail(function () {
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Usuario",
            html:
              "<p>Ocurrio un error. Contactar al Administrador del sistema.</p>",
            showConfirmButton: true,
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        type: "error",
        title: "Usuario",

        showConfirmButton: true,
      });
    }
  });
  $("#aceptar_solicitud_envioBTN").click(function (e) {
    e.preventDefault();
    /**
     *Aca se levanta el modal secundario donde hay que llevarlo a la confrmacion de los datos para que funcione
     */
    $("#modal-agregar-pedido")
      .modal("hide")
      .on("hidden.bs.modal", function (e) {
        $("#modal-agregar-producto").modal("show");

        $(this).off("hidden.bs.modal"); // Remove the 'on' event binding
      });
    var val1, val2, val3, val4, val5, val6, val7, val8;
    var nombre = $("#empresa_formSolicitudEnvio").val();
    var apellido = $("#direccion_formSolicitudEnvio").val();
    var telefono = $("#telefono_formSolicitudEnvio").val();
    var email = $("#fechaRetiro_formSolicitudEnvio").val();
    var comuna = $("#horaDesde_formSolicitudEnvio").val();
    var nombreUsuario = $("#horaHasta_formSolicitudEnvio").val();
    var password = $("#comuna_formSolicitudEnvio").val();
    var password = $("#nombreReceptor_formSolicitudEnvio").val();
    var password = $("#direccionDespacho_formSolicitudEnvio").val();
    var nivel = $("#comunaDespacho_formSolicitudEnvio").val();
    var nivel = $("#fechaDespachoEstimada_formSolicitudEnvio").val();
    var nivel = $("#horaDesde_formSolicitudEnvio").val();
    var nivel = $("#horaHasta_formSolicitudEnvio").val();
    //--- Validaciones de campos obligatorios ---//
    if (nombre == null || nombre.length == 0 || nombre == "") {
      $("#errorNombrePersonaModificar").css("display", "block");
      val1 = false;
    } else {
      $("#errorNombrePersonaModificar").css("display", "none");
      val1 = true;
    }
    if (apellido == null || apellido.length == 0 || apellido == "") {
      $("#errorApellidoPersonaModificar").css("display", "block");
      val2 = false;
    } else {
      $("#errorApellidoPersonaModificar").css("display", "none");
      val2 = true;
    }
    if (
      email == null ||
      email.length == 0 ||
      email == "" ||
      !/\S+@\S+\.\S+/.test(email)
    ) {
      $("#errorEmailUsuarioModificar").css("display", "block");
      val3 = false;
    } else {
      $("#errorEmailUsuarioModificar").css("display", "none");
      val3 = true;
    }
    if (
      nombreUsuario == null ||
      nombreUsuario.length == 0 ||
      nombreUsuario == ""
    ) {
      $("#errorUsuarioPersonaModificar").css("display", "block");
      val4 = false;
    } else {
      $("#errorUsuarioPersonaModificar").css("display", "none");
      val4 = true;
    }
    if (
      telefono == null ||
      telefono.length == 0 ||
      telefono == "" ||
      isNaN(telefono)
    ) {
      $("#errorTelefonoPersonaModificar").css("display", "block");
      val5 = false;
    } else {
      $("#errorTelefonoPersonaModificar").css("display", "none");
      val5 = true;
    }
    if (password == null || password.length == 0 || password == "") {
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
    if (
      document.getElementById("passwordPersonaModificar").value != temp_password
    ) {
      password = md5(password);
    }
    if (val1 && val2 && val3 && val4 && val5 && val6 && val7 && val8) {
      var formData = new FormData($("#form-modificar-usuario")[0]);
      $.ajax({
        url: URL + "usuarios/modificar_usuario_post",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            var table_usuarios = $("#listado_usuarios").DataTable();
            $("#listado_usuarios")
              .dataTable()
              .fnDeleteRow("#" + dato["usuario"][0]["idUsuario"]);
            table_usuarios.row(dato["usuario"][0]["idUsuario"]).remove().draw();
            var acciones = "";
            acciones =
              '<a class="tip modificarUsuario" data-id="' +
              dato["usuario"][0]["idUsuario"] +
              ' " data-toggle="modal" style="color: black;" data-original-title="Editar Usuario"><i class="fa fa-edit" style="color: #4e73df; cursor: pointer;" title="Modificar Usuario"></i></a> &nbsp;' +
              '<a onclick="eliminar_usuario(' +
              "'" +
              dato["usuario"][0]["idUsuario"] +
              "'" +
              ')"' +
              ' class="tip deleteUsuario" role="button" style="color: black;" data-original-title="Eliminar"><i class="fa fa-trash" #4e73df="color: black; cursor: pointer;" title="Eliminar Usuario"></i></a>';
            var row = table_usuarios.row
              .add([
                dato["usuario"][0]["idUsuario"],
                dato["usuario"][0]["apellido"] +
                  ", " +
                  dato["usuario"][0]["nombreCompleto"],
                dato["usuario"][0]["usuario"],
                dato["usuario"][0]["email"],
                acciones,
              ])
              .draw(false);
            row.nodes().to$().attr("id", dato["usuario"][0]["idUsuario"]);
            table_usuarios
              .row(row)
              .column(0)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(1)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(2)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(3)
              .nodes()
              .to$()
              .addClass("text-center");
            table_usuarios
              .row(row)
              .column(4)
              .nodes()
              .to$()
              .addClass("text-center");
            //para ocultar el div
            $("#modal-editar-usuario").modal("hide");
            $(".modal-backdrop").remove();
            Swal.fire({
              icon: "success",
              type: "success",
              title: "Usuario",
              html: "<p>Se modificó el usuario con exito</p>",
              showConfirmButton: true,
            });
          } else {
            //mostramos sweet alert
            Swal.fire({
              icon: "error",
              type: "error",
              title: "Usuario",
              html: "<p>" + dato["msg"] + "</p>",
              showConfirmButton: true,
            });
          }
        })
        .fail(function () {
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Usuario",
            html:
              "<p>Ocurrio un error. Contactar al Administrador del sistema.</p>",
            showConfirmButton: true,
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        type: "error",
        title: "Usuario",

        showConfirmButton: true,
      });
    }
  });
});
//End add
function eliminar_usuario(idUsuario) {
  Swal.fire({
    title: "Usuario",
    text: "¿Desea eliminar el usuario?",
    icon: "warning",
    confirmButtonText: "Borrar",
    showCancelButton: true,
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "usuarios/eliminar_usuario/",
        type: "POST",
        cache: false,
        data: {
          idUsuario: idUsuario,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Usuario", "Usuario eliminado exitosamente", "success");
            $("#listado_usuarios")
              .dataTable()
              .fnDeleteRow("#" + idUsuario);
          } else {
            Swal.fire("Error!", "No se pudo eliminar el usuario", "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Error!", "No se pudo eliminar el usuario", "error");
        });
    }
  });
}
//-- Agregado envio --//
$(document).ready(function () {
  $("#add_envio").click(function (e) {
    e.preventDefault();

    var idCliente = $("#idClienteEnvio_formSolicitudEnvio").val(); //
    var nombreReceptor = $("#nombreReceptor_formSolicitudEnvio").val(); //
    var nroRemito = $("#nroRemito_formSolicitudEnvio").val(); //
    var cantidad = $("#cantidad_formSolicitudEnvio").val(); //
    var provinciaRetiro = $("#provinciaRetiro_formSolicitudEnvio").val(); //
    var localidadRetiro = $("#localidadRetiro_formSolicitudEnvio").val(); //
    var fechaEnvio = $("#fechaEnvio_formSolicitudEnvio").val(); //
    var estado = $("#estado_formSolicitudEnvio").val(); //
    var fechaEntrega = $("#fechaEntrega_formSolicitudEnvio").val(); //
    var provinciaDestino = $("#provinciaDestino_formSolicitudEnvio").val();
    var localidadDestino = $("#localidadDestino_formSolicitudEnvio").val();
    var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11;

    //--- Validaciones de campos obligatorios ---//
    if (idCliente == null || idCliente == 0) {
      val1 = false;

      $("#idClienteEnvio_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
    } else {
      val1 = true;
    }
    if (nombreReceptor == null || nombreReceptor == "") {
      $("#nombreReceptor_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
      val2 = false;
    } else {
      val2 = true;
    }
    if (nroRemito == "" || nroRemito.length == 0) {
      $("#nroRemito_formSolicitudEnvio").attr("style", "border-color:red;");
      val3 = false;
    } else {
      val3 = true;
    }
    if (cantidad == "" || cantidad.length == 0) {
      $("#cantidad_formSolicitudEnvio").attr("style", "border-color:red;");
      val4 = false;
    } else {
      val4 = true;
    }
    if (
      provinciaRetiro == "" ||
      provinciaRetiro.length == 0 ||
      provinciaRetiro == "0"
    ) {
      $("#provinciaRetiro_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
      val5 = false;
    } else {
      val5 = true;
    }
    if (
      localidadRetiro == null ||
      localidadRetiro.length == 0 ||
      localidadRetiro == "" ||
      localidadRetiro == "0"
    ) {
      $("#localidadRetiro_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
      val6 = false;
    } else {
      val6 = true;
    }
    if (
      fechaEnvio == null ||
      fechaEnvio.length == 0 ||
      fechaEnvio == "" //||
      //fechaEnvio > fechaEntrega
    ) {
      $("#fechaEnvio_formSolicitudEnvio").attr("style", "border-color:red;");
      val7 = false;
    } else {
      n = new Date();
      //Año
      y = n.getFullYear();
      //Mes
      m = n.getMonth() + 1;
      //Día
      d = n.getDate();

      //
      //    if (fechaEnvio < ()) {

      //  }
      val7 = true;
    }
    if (estado == null || estado.length == 0 || estado == "" || estado == "0") {
      $("#estado_formSolicitudEnvio").attr("style", "border-color:red;");
      val8 = false;
    } else {
      val8 = true;
    }
    if (
      fechaEntrega == null ||
      fechaEntrega.length == 0 ||
      fechaEntrega == ""
    ) {
      $("#fechaEntrega_formSolicitudEnvio").attr("style", "border-color:red;");
      val9 = false;
    } else {
      val9 = true;
    }
    if (
      provinciaDestino == null ||
      provinciaDestino.length == 0 ||
      provinciaDestino == "" ||
      provinciaDestino == "0"
    ) {
      $("#provinciaDestino_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
      val10 = false;
    } else {
      val10 = true;
    }
    if (
      localidadDestino == null ||
      localidadDestino.length == 0 ||
      localidadDestino == "" ||
      localidadDestino == "0"
    ) {
      $("#localidadDestino_formSolicitudEnvio").attr(
        "style",
        "border-color:red;"
      );
      val11 = false;
    } else {
      val11 = true;
    }

    //Eventos
    $("#localidadDestino_formSolicitudEnvio").click(function () {
      $("#localidadDestino_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#provinciaDestino_formSolicitudEnvio").click(function () {
      $("#provinciaDestino_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#idClienteEnvio_formSolicitudEnvio").click(function () {
      $("#idClienteEnvio_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#nombreReceptor_formSolicitudEnvio").click(function () {
      $("#nombreReceptor_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#nroRemito_formSolicitudEnvio").click(function () {
      $("#nroRemito_formSolicitudEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#cantidad_formSolicitudEnvio").click(function () {
      $("#cantidad_formSolicitudEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#provinciaRetiro_formSolicitudEnvio").click(function () {
      $("#provinciaRetiro_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#localidadRetiro_formSolicitudEnvio").click(function () {
      $("#localidadRetiro_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#fechaEnvio_formSolicitudEnvio").click(function () {
      $("#fechaEnvio_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#estado_formSolicitudEnvio").click(function () {
      $("#estado_formSolicitudEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#fechaEntrega_formSolicitudEnvio").click(function () {
      $("#fechaEntrega_formSolicitudEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });

    if (
      val1 &&
      val2 &&
      val3 &&
      val4 &&
      val5 &&
      val6 &&
      val7 &&
      val8 &&
      val9 &&
      val10 &&
      val11
    ) {
      var formData = new FormData($("#formSolicitudEnvio")[0]);
      $.ajax({
        url: URL + "envios/new_envio/",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (data) {
          var dato = JSON.parse(data);

          var fileRemito = $("#fileRemito").val();
          if (fileRemito != "") {
            if (dato["valid"]) {
              document.getElementById("idEnvio_formSolicitudEnvio").value =
                dato["idEnvio"];

              var formData = new FormData($("#formSolicitudEnvio")[0]);
              $.ajax({
                url: URL + "envios/add_remito_envio",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              })
                .done(function (data) {
                  var datos = JSON.parse(data);

                  if (datos["valid"]) {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "success",
                      type: "success",
                      title: "Envio",
                      html: "<p>" + dato["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                    console.log(datos);
                  } else {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "error",
                      type: "error",
                      title: "Envio",
                      html: "<p>" + dato["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                  }
                })
                .fail(function () {
                  //--- Alerta de mensaje ---//
                  Swal.fire({
                    icon: "error",
                    type: "error",
                    title: "Envio",
                    html: "<p>" + dato["msg"] + "</p>",
                    showConfirmButton: true,
                  });
                });
            } else {
              //--- mostramos sweet alert ---//
              Swal.fire({
                icon: "error",
                type: "error",
                title: "Envio",
                html: "<p>" + dato["msg"] + "</p>",
                showConfirmButton: true,
              });
            }
          } else {
            if (dato["valid"]) {
              Swal.fire({
                icon: "success",
                type: "success",
                title: "Envio",
                html: "<p>" + dato["msg"] + "</p>",
                showConfirmButton: true,
                preConfirm: (login) => {
                  setTimeout(function () {
                    location.href = URL + "envios/listar_envios";
                  }, 100);
                },
              });
            } else {
              Swal.fire({
                icon: "error",
                type: "error",
                title: "Envio",
                html: "<p>" + dato["msg"] + "</p>",
                showConfirmButton: true,
              });
            }
          }
        })
        .fail(function () {
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Envio",
            html: "<p>Error al mandar los datos</p>",
            showConfirmButton: true,
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        type: "error",
        title: "Envio",
        html:
          "<p>Error, existe un dato obligatorio que quedo sin rellenar o hay inconsistencias en alguno de ellos</p>",
        showConfirmButton: true,
      });
    }
  });
});
//--- Redirigir al listado de envios ---//
function redirect_listar_envios() {
  window.location.replace(URL + "envios/listar_envios");
}
//--- Redirigir al modificar envios ---//
function redirect_modificar_envio(idEnvio) {
  window.location.replace(URL + "envios/modificar_envio/" + idEnvio);
}
//--- Eliminar envio ---//
function delete_envio(idEnvio) {
  Swal.fire({
    title: "Envío",
    text: "¿Desea eliminar el envío?",
    icon: "warning",
    confirmButtonText: "Eliminar",
    showCancelButton: true,
    cancelButtonText: "Cancel",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "envios/delete_envio/",
        type: "POST",
        data: {
          idEnvio: idEnvio,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Envío", dato["msg"], "success");
            $("#listado_envios")
              .dataTable()
              .fnDeleteRow("#" + idEnvio);
          } else {
            Swal.fire("Envío", dato["msg"], "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Envío", "No se pudo eliminar el envío", "error");
        });
    }
  });
}
//-- Modificar envio --//
$(document).ready(function () {
  $("#update_envio").click(function (e) {
    e.preventDefault();
    var idEnvio = $("#idEnvio_formUpdateEnvio").val(); //
    var idCliente = $("#idClienteEnvio_formUpdateEnvio").val(); //
    var nombreReceptor = $("#nombreReceptor_formUpdateEnvio").val(); //
    var nroRemito = $("#nroRemito_formUpdateEnvio").val(); //
    var cantidad = $("#cantidad_formUpdateEnvio").val(); //
    var provinciaRetiro = $("#provinciaRetiro_formUpdateEnvio").val(); //
    var localidadRetiro = $("#localidadRetiro_formUpdateEnvio").val(); //
    var fechaEnvio = $("#fechaEnvio_formUpdateEnvio").val(); //
    var estado = $("#estado_formUpdateEnvio").val(); //
    var fechaEntrega = $("#fechaEntrega_formUpdateEnvio").val(); //
    var provinciaDestino = $("#provinciaDestino_formUpdateEnvio").val();
    var localidadDestino = $("#localidadDestino_formUpdateEnvio").val();
    var fileRemito = $("#fileRemitoUpdate").val();
    var val1, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11;
    //--- Validaciones de campos obligatorios ---//
    if (idCliente == null || idCliente == 0) {
      val1 = false;

      $("#idClienteEnvio_formUpdateEnvio").attr("style", "border-color:red;");
    } else {
      val1 = true;
    }
    if (nombreReceptor == null || nombreReceptor == "") {
      $("#nombreReceptor_formUpdateEnvio").attr("style", "border-color:red;");
      val2 = false;
    } else {
      val2 = true;
    }
    if (nroRemito == "" || nroRemito.length == 0) {
      $("#nroRemito_formUpdateEnvio").attr("style", "border-color:red;");
      val3 = false;
    } else {
      val3 = true;
    }
    if (cantidad == "" || cantidad.length == 0) {
      $("#cantidad_formUpdateEnvio").attr("style", "border-color:red;");
      val4 = false;
    } else {
      val4 = true;
    }
    if (
      provinciaRetiro == "" ||
      provinciaRetiro.length == 0 ||
      provinciaRetiro == "0"
    ) {
      $("#provinciaRetiro_formUpdateEnvio").attr("style", "border-color:red;");
      val5 = false;
    } else {
      val5 = true;
    }
    if (
      localidadRetiro == null ||
      localidadRetiro.length == 0 ||
      localidadRetiro == "" ||
      localidadRetiro == "0"
    ) {
      $("#localidadRetiro_formUpdateEnvio").attr("style", "border-color:red;");
      val6 = false;
    } else {
      val6 = true;
    }
    if (
      fechaEnvio == null ||
      fechaEnvio.length == 0 ||
      fechaEnvio == "" //||
      //fechaEnvio > fechaEntrega
    ) {
      $("#fechaEnvio_formUpdateEnvio").attr("style", "border-color:red;");
      val7 = false;
    } else {
      val7 = true;
    }
    if (estado == null || estado.length == 0 || estado == "" || estado == "0") {
      $("#estado_formUpdateEnvio").attr("style", "border-color:red;");
      val8 = false;
    } else {
      val8 = true;
    }
    if (
      fechaEntrega == null ||
      fechaEntrega.length == 0 ||
      fechaEntrega == ""
    ) {
      $("#fechaEntrega_formUpdateEnvio").attr("style", "border-color:red;");
      val9 = false;
    } else {
      val9 = true;
    }
    if (
      provinciaDestino == null ||
      provinciaDestino.length == 0 ||
      provinciaDestino == "" ||
      provinciaDestino == "0"
    ) {
      $("#provinciaDestino_formUpdateEnvio").attr("style", "border-color:red;");
      val10 = false;
    } else {
      val10 = true;
    }
    if (
      localidadDestino == null ||
      localidadDestino.length == 0 ||
      localidadDestino == "" ||
      localidadDestino == "0"
    ) {
      $("#localidadDestino_formUpdateEnvio").attr("style", "border-color:red;");
      val11 = false;
    } else {
      val11 = true;
    }

    //Eventos
    $("#localidadDestino_formUpdateEnvio").click(function () {
      $("#localidadDestino_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#provinciaDestino_formUpdateEnvio").click(function () {
      $("#provinciaDestino_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#idClienteEnvio_formUpdateEnvio").click(function () {
      $("#idClienteEnvio_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#nombreReceptor_formUpdateEnvio").click(function () {
      $("#nombreReceptor_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#nroRemito_formUpdateEnvio").click(function () {
      $("#nroRemito_formUpdateEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#cantidad_formUpdateEnvio").click(function () {
      $("#cantidad_formUpdateEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#provinciaRetiro_formUpdateEnvio").click(function () {
      $("#provinciaRetiro_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#localidadRetiro_formUpdateEnvio").click(function () {
      $("#localidadRetiro_formUpdateEnvio").attr(
        "style",
        "border-color:#ced4da;"
      );
    });
    $("#fechaEnvio_formUpdateEnvio").click(function () {
      $("#fechaEnvio_formUpdateEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#estado_formUpdateEnvio").click(function () {
      $("#estado_formUpdateEnvio").attr("style", "border-color:#ced4da;");
    });
    $("#fechaEntrega_formUpdateEnvio").click(function () {
      $("#fechaEntrega_formUpdateEnvio").attr("style", "border-color:#ced4da;");
    });
    console.log(val1);
    console.log(val2);
    console.log(val3);
    console.log(val4);
    console.log(val5);
    console.log(val6);
    console.log(val7);
    console.log(val8);
    console.log(val9);
    console.log(val10);
    console.log(val11);

    if (
      val1 &&
      val2 &&
      val3 &&
      val4 &&
      val5 &&
      val6 &&
      val7 &&
      val8 &&
      val9 &&
      val10 &&
      val11
    ) {
      var formData = new FormData($("#formUpdateEnvio")[0]);
      $.ajax({
        url: URL + "envios/update_envio/",
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
      })
        .done(function (data) {
          var dato = JSON.parse(data);

          var fileRemito = $("#fileRemitoUpdate").val();
          if (fileRemito != "") {
            if (dato["valid"]) {
              var formData = new FormData($("#formUpdateEnvio")[0]);
              $.ajax({
                url: URL + "envios/update_remito_envio",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              })
                .done(function (data) {
                  var datos = JSON.parse(data);

                  if (datos["valid"]) {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "success",
                      type: "success",
                      title: "Envio",
                      html: "<p>" + dato["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                    console.log(datos);
                  } else {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "error",
                      type: "error",
                      title: "Envio",
                      html: "<p>" + dato["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                  }
                })
                .fail(function () {
                  //--- Alerta de mensaje ---//
                  Swal.fire({
                    icon: "error",
                    type: "error",
                    title: "Envio",
                    html: "<p>" + dato["msg"] + "</p>",
                    showConfirmButton: true,
                  });
                });
            } else {
              var formData = new FormData($("#formUpdateEnvio")[0]);
              $.ajax({
                url: URL + "envios/update_remito_envio",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              })
                .done(function (data) {
                  var datos = JSON.parse(data);

                  if (datos["valid"]) {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "success",
                      type: "success",
                      title: "Envio",
                      html: "<p>" + datos["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                    console.log(datos);
                  } else {
                    //--- Alerta de mensaje ---//
                    Swal.fire({
                      icon: "error",
                      type: "error",
                      title: "Envio",
                      html: "<p>" + datos["msg"] + "</p>",
                      showConfirmButton: true,
                      preConfirm: (login) => {
                        setTimeout(function () {
                          location.href = URL + "envios/listar_envios";
                        }, 100);
                      },
                    });
                  }
                })
                .fail(function () {
                  //--- Alerta de mensaje ---//
                  Swal.fire({
                    icon: "error",
                    type: "error",
                    title: "Envio",
                    html: "<p>" + datos["msg"] + "</p>",
                    showConfirmButton: true,
                  });
                });
            }
          } else {
            if (dato["valid"]) {
              Swal.fire({
                icon: "success",
                type: "success",
                title: "Envio",
                html: "<p>" + dato["msg"] + "</p>",
                showConfirmButton: true,
                preConfirm: (login) => {
                  setTimeout(function () {
                    location.href = URL + "envios/listar_envios";
                  }, 100);
                },
              });
            } else {
              Swal.fire({
                icon: "error",
                type: "error",
                title: "Envio",
                html: "<p>" + dato["msg"] + "</p>",
                showConfirmButton: true,
              });
            }
          }
        })
        .fail(function (data) {
          Swal.fire({
            icon: "error",
            type: "error",
            title: "Envio",
            html: "<p>Error al mandar los datos</p>",
            showConfirmButton: true,
          });
        });
    } else {
      Swal.fire({
        icon: "error",
        type: "error",
        title: "Envio",
        html: "<p>Error, un dato obligatorio quedo sin rellenar</p>",
        showConfirmButton: true,
      });
    }
  });
});
/**
*function
Detectar cambio de provincia y realizar el cambio de localidad segun provincia en cada select
*/
$(document).ready(function () {
  $("#provinciaRetiro_formSolicitudEnvio").change(function () {
    cargar_localidades_retiro($("#provinciaRetiro_formSolicitudEnvio").val());
  });
  $("#provinciaDestino_formSolicitudEnvio").change(function () {
    cargar_localidades_destino($("#provinciaDestino_formSolicitudEnvio").val());
  });
  $("#selectProvincia").change(function () {
    cargar_localidades_usuario($("#selectProvincia").val());
  });
  $("#selectProvinciaModificar").change(function () {
    cargar_localidades_usuario_modificar($("#selectProvinciaModificar").val());
  });
  $("#provinciaDestino_formUpdateEnvio").change(function () {
    cargar_localidades_destino_modificar(
      $("#provinciaDestino_formUpdateEnvio").val()
    );
  });
  $("#provinciaRetiro_formUpdateEnvio").change(function () {
    cargar_localidades_retiro_modificar(
      $("#provinciaRetiro_formUpdateEnvio").val()
    );
  });
});
//--- Cambios de estado en los envíos ---//
function set_envio_pendiente(idEnvio) {
  Swal.fire({
    title: "Envío a Pendiente",
    text: "¿Desea cambiar el estado del envío a pendiente?",
    icon: "question",
    confirmButtonText: "Si",
    showCancelButton: true,
    cancelButtonText: "No",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "envios/set_envio_pendiente/",
        type: "POST",
        data: {
          idEnvio: idEnvio,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Envío a Pendiente", dato["msg"], "success");
            $("#listado_envios").DataTable().ajax.reload();
          } else {
            Swal.fire("Envío a Pendiente", dato["msg"], "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Envío", "No se pudo cambiar el estado del envío", "error");
        });
    }
  });
}
function set_envio_aceptado(idEnvio) {
  Swal.fire({
    title: "Envío a Aceptado",
    text: "¿Desea cambiar el estado del envío a aceptado?",
    icon: "question",
    confirmButtonText: "Si",
    showCancelButton: true,
    cancelButtonText: "No",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "envios/set_envio_aceptado/",
        type: "POST",
        data: {
          idEnvio: idEnvio,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Envío a Aceptado", dato["msg"], "success");
            $("#listado_envios").DataTable().ajax.reload();
          } else {
            Swal.fire("Envío a Aceptado", dato["msg"], "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Envío", "No se pudo cambiar el estado del envío", "error");
        });
    }
  });
}
function set_envio_rechazado(idEnvio) {
  Swal.fire({
    title: "Envío a Rechazado",
    text: "¿Desea cambiar el estado del envío a reachazado?",
    icon: "question",
    confirmButtonText: "Si",
    showCancelButton: true,
    cancelButtonText: "No",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "envios/set_envio_rechazado/",
        type: "POST",
        data: {
          idEnvio: idEnvio,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Envío a Rechazado", dato["msg"], "success");
            $("#listado_envios").DataTable().ajax.reload();
          } else {
            Swal.fire("Envío a Rechazado", dato["msg"], "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Envío", "No se pudo cambiar el estado del envío", "error");
        });
    }
  });
}
function set_envio_entregado(idEnvio) {
  Swal.fire({
    title: "Envío a Entregado",
    text: "¿Desea cambiar el estado del envío a entregado?",
    icon: "question",
    confirmButtonText: "Si",
    showCancelButton: true,
    cancelButtonText: "No",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: URL + "envios/set_envio_entregado/",
        type: "POST",
        data: {
          idEnvio: idEnvio,
        },
      })
        .done(function (data) {
          var dato = JSON.parse(data);
          if (dato["valid"]) {
            Swal.fire("Envío a Entregado", dato["msg"], "success");
            $("#listado_envios").DataTable().ajax.reload();
          } else {
            Swal.fire("Envío a Entregado", dato["msg"], "error");
          }
        })
        .fail(function (data) {
          Swal.fire("Envío", "No se pudo cambiar el estado del envío", "error");
        });
    }
  });
}
function set_envio_conformado(idEnvio) {
  Swal.fire({
    title: "Envío a Conformado",
    icon: "question",
    html:
      "<form id='formEstadoConforme' class='form-horizontal' role='form' action='#' method='POST' enctype='multipart/form-data'><p>¿Desea cambiar el estado del envío a conformado? Para realizar el cambio de estado correspondiente, deberá subir el conforme correspondiente</p><br><input type='file' name='fileConforme' id='fileConforme' class='styled'></form>",
    confirmButtonText: "Si",
    showCancelButton: true,
    cancelButtonText: "No",
  }).then((result) => {
    if (result.value) {
      var fileConforme = $("#fileConforme");
      var formData = new FormData($("#formEstadoConforme")[0]);
      formData.append("fileConforme", fileConforme);
      formData.append("idEnvio", idEnvio);
      var fileConformeValidation = $("#fileConforme").val();
      if (fileConformeValidation != "" && fileConformeValidation.length > 0) {
        $.ajax({
          url: URL + "envios/add_conforme_envio/",
          type: "POST",
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
        })
          .done(function (data) {
            $.ajax({
              url: URL + "envios/set_envio_conformado/",
              type: "POST",
              data: {
                idEnvio: idEnvio,
              },
            })
              .done(function (data) {
                var dato = JSON.parse(data);
                if (dato["valid"]) {
                  Swal.fire("Envío a Conformado", dato["msg"], "success");
                  $("#listado_envios").DataTable().ajax.reload();
                } else {
                  Swal.fire("Envío a Conformado", dato["msg"], "error");
                }
              })
              .fail(function (data) {
                Swal.fire(
                  "Envío",
                  "No se pudo cambiar el estado del envío",
                  "error"
                );
              });
          })
          .fail(function (data) {
            Swal.fire(
              "Envío",
              "No se pudo cambiar el estado del envío",
              "error"
            );
          });
      } else {
        Swal.fire(
          "Envío",
          "Para cambiar el estado del envío a conformado es obligatorio que suba el conforme",
          "error"
        );
      }
    }
  });
}

//Validaciones de fecha minima

$(function () {
  $("#fechaEnvio_formUpdateEnvio").on("change", function () {
    $("#fechaEntrega_formUpdateEnvio").attr(
      "min",
      $("#fechaEnvio_formUpdateEnvio").val()
    );
  });
  $("#fechaEnvio_formSolicitudEnvio").on("change", function () {
    //console.log(fecha2);
    $("#fechaEntrega_formSolicitudEnvio").attr(
      "min",
      $("#fechaEnvio_formSolicitudEnvio").val()
    );
  });
});

//--- Exportar envios a pdf ---//
function exportar_envios(idCliente, idNivel) {
  $.ajax({
    url: URL + "envios/exportar_to_excel_envios/" + idCliente + "/" + idNivel,
  })
    .done(function (data) {
      console.log("Se llevo a cabo la exportacion correspondiente");
    })
    .fail(function () {
      console.log("Tiene que volver a ejecutar el metodo");
    });
}
