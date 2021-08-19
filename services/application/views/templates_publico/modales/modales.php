<!--VENTANA EMERGENTE DEL LOGIN-->
<div class="login" id="ventanaLogin">
      <div class="modal fade" tabindex="-1" id="modal1">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="header">
              <button type="button" class="close btnCerrar" data-dismiss="modal" aria-label="close">&times;</button>
              <h5 class="modal-tittle textoLogin" >Ingresar</h5>
            </div>
            <div class="modal-body">
              <img class="imagenLogin col-sm-12" src="img\2.jpeg">
              <form class="inputLogin col-sm-12" id="login" role="form" method="POST">
                <input class="botonUsuario" type="text" placeholder="Usuario" name="username" id="username"  ><br>
                <input class="botonPassword" type="password" placeholder="Contraseña" name="password" id="password"><br>
                <input class="botonIniciarSesion" type="submit" id="ingreso_usuario"value="Iniciar Sesion">

              </form>

              <!-- <div class="texto2Login col-lg-12"><a>¿Todavia no eres miembro? haz click </a><a data-dismiss="modal" style="color: blue;" onclick="abrirRegistro()">Aqui</a></div>
              <div class="texto3Login col-lg-12"><a style="color: blue;">¿Olvidaste tu contraseña?</a></div> --->
            </div>
          </div>
        </div>
      </div>
  </div>
  <!--ACA TERMINA EL LOGIN-->

  <!--VENTANA EMERGENTE DE REGISTRO-->
  <div class="registro" id="ventanaRegistro">
    <div class="modal fade" tabindex="-1" id="modal2">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="header">
            <button type="button" class="close btnCerrar" data-dismiss="modal" aria-label="close">&times;</button>
            <h5 class="modal-tittle textoRegistro" >Registrarse</h5>
          </div>
          <div class="modal-body">
            <img class="imagenRegistro col-sm-12" src="img\2.jpeg">
            <!--Formulario de inscripcion publico-->
            <form class="inputRegistro col-sm-12" autocomplete="off" id="form-nuevo-usuario" role="form" action="#" method="POST" enctype="multipart/form-data">

              <input class="texto1 col-sm-12" type="text" placeholder="Nombre"  name="nombrePersona" id="nombrePersona" required>

              <input class="texto2 col-sm-12" type="text" placeholder="Apellido"  name="apellidoPersona" id="apellidoPersona" required>

              <input class="texto3 col-sm-12" type="tel" placeholder="Telefono" name="telefonoPersona" id="telefonoPersona" required>

              <input class="texto4 col-sm-12" type="email" placeholder="Email" name="emailUsuario" id="emailUsuario" required>

              <input class="texto5 col-sm-12" type="text" placeholder="Direccion" name="direccion" id="direccionPersona" >
              <select name="selectComuna" id="selectComuna" class="comboComuna col-sm-12">
                  <option hidden selected>Comuna</option>
                  <?php
                    if (isset($comunas)) :
                      for ($i = 0; $i < count($comunas); $i++) :
                        echo '<option class="option" value="' . $comunas[$i]['idComuna'] . '">' . $comunas[$i]['nombre'] . '</option>';
                      endfor;
                    endif;
                  ?>
                </select>
              <input class="texto3 col-sm-12" type="text" placeholder="Nombre Usuario" id="nombreUsuarioPersona" name="nombreUsuarioPersona" required>
              <input class="password1 col-sm-12" type="password" placeholder="Contraseña" name="passwordPersona" id="passwordPersona" name="passwordPersona" required>
              <input class="password2 col-sm-12"type="password" placeholder="Confirmar Contraseña" name="confContraseña" id="confPasswordPersona" name="confPassword" required>

              <input type="button" id="registrarUsuario" name="registrarUsuario" value="Crear Usuario">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--ACA TERMINA EL REGISTRO-->
  <!--ACA EMPIEZA EL MODAL DE COTIZADOR-->

  <div class="Cotizador" id="ventanaCotizador">
      <div class="modal fade" tabindex="-1" id="modal3">
        <div class="modal-dialog modal-lg">
          <div class="modal-content modalCotizador">
            <div class="header">
              <img src="<?= $url ?>img/icon/logo.jpg" alt="" style="width:15%; float: left;" class="imagenModalCotizador"/>
              <button type="button" class="close btnCerrar" data-dismiss="modal" aria-label="close" style="margin:1% 2%;" onclick="vaciado_cotizador()">&times;</button>
              <h5 class="textoModalCotizador">Su Cotización Es:</h5>
            </div>
            <div class="modal-body align-items-center">
              <div class="divOrigen">
                <h5 class="text-center" id="origen_text"> Origen: </h5>
              </div>
              <div class="divDestino align-items-center">
                <h5 class="text-center" id="destino_text">Destino: </h5>
              </div>
              <div class="divCantidad align-items-center">
                <h5 class="text-center" id="cantidad_text">Cantidad De Cajas: </h5>
              </div>
              <div class="divTamaño align-items-center">
                <h5 class="text-center" id="tamaño_text">Tamaño De Cajas: </h5>
              </div>


              <hr style="background-color:white; margin: 0% 30%;" />
              <h4 id="precio_total" style="color:rgba(243,251,4,1);">Precio Total: ${{precio}}</h4>


              <p class="textoRecordatorio">Recuerde que realizando 5 o m&aacutes pedidos, no se cobraran $1000,00 correspondientes al retiro del pedido</p>

            </div>

          </div>
        </div>
      </div>
  </div>
