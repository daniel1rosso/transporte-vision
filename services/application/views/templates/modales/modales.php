<div class="modal fade" id="modal-agregar-usuario" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <!-- Form components -->
            <form id="form-agregar-usuario" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">

                <!-- Basic inputs -->
                <div class="panel panel-default">

                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Agregar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="panel-body" style= "width:100%;">
                        <input type="hidden" name="idUsuarioAgregar" id="idUsuarioAgregar" class="form-control">

                        <!-- Nombre Persona  -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="nombrePersona" id="nombrePersona" class="form-control">
                                <div id="errorNombrePersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--apellido-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Apellido:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="apellidoPersona" id="apellidoPersona" class="form-control">
                                <div id="errorApellidoPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un apellido v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Telefono
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Teléfono:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="telefonoPersona" id="telefonoPersona" class="form-control">
                                <div id="errorTelefonoPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un número de teléfono v&aacute;lido
                                </div>
                            </div>
                        </div>
-->
                        <!--Email-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Email:</span> </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" name="emailUsuario" id="emailUsuario" class="form-control">
                                </div>
                                <div id="errorEmailUsuario" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un e-mail v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Provincias-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblcomuna"><span style="color: red;">*</span>Provincia</label>
                            <div class="col-sm-10">
                                <select name="selectProvincia" id="selectProvincia" class="form-control" required style="padding-right: 0px;">
                                    <option value="0">Seleccionar Provincia</option>
                                    <?php
                                    if (isset($provincia)) :
                                        for ($i = 0; $i < count($provincia); $i++) :
                                            echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorSelectProvinciaPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Seleccione una comuna v&aacute;lida
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblcomuna"><span style="color: red;">*</span>Localidad</label>
                            <div class="col-sm-10">
                                <select name="selectProvincia" id="selectLocalidad" class="form-control" required style="padding-right: 0px;">
                                    <option value="0">Seleccionar Localidad</option>
                                    <?php
                                    if (isset($localidades)) :
                                        for ($i = 0; $i < count($localidades); $i++) :
                                            echo '<option value="' . $localidades[$i]['idLocalidad'] . '">' . $localidades[$i]['nombre'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorSelectLocalidadPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Seleccione una localidad v&aacute;lida
                                </div>
                            </div>
                        </div>
                        <!--direccion-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Direcci&oacute;n:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="direccionPersona" id="direccionPersona" class="form-control">
                                <div id="errorDireccionPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una direcci&oacute;n valida
                                </div>
                            </div>
                        </div>

                        <!--Nombre Usuario-->
                        <div class="form-group">
                            <div class="col col-md-12">
                                <label class="col-sm-2 control-label" style="padding-left: 0px;"><span><span style="color: red;"> * </span>Usuario:</span> </label>
                                <div class="col-sm-10" style="padding: initial;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="nombreUsuarioPersona" name="nombreUsuarioPersona" placeholder="Username" class="form-control">
                                    </div>
                                    <div id="errorUsuarioPersona" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese un usuario v&aacute;lido
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Contraseña:</span> </label>
                            <div class="col-sm-10 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-asterisk"></i>
                                </div>
                                <input type="password" id="passwordPersona" name="passwordPersona" placeholder="Password" class="form-control">
                                <div id="errorPassword" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una contraseña v&aacute;lida
                                </div>
                            </div>
                        </div>

                        <!--Nivel-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblNivel"><span style="color: red;"> * </span>Nivel</label>
                            <div class="col-sm-10">
                                <select name="selectNivelUsuarioAgregar" id="selectNivelUsuarioAgregar" class="form-control" required>
                                    <option value="0">Seleccionar Nivel</option>
                                    <?php
                                    if (isset($nivel)) :
                                        for ($i = 0; $i < count($nivel); $i++) :
                                            echo '<option value="' . $nivel[$i]['idNivel'] . '">' . $nivel[$i]['nivel'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorNivelPersona" class="btn-danger erroBoxs" style="display: none">
                                    * Debe seleccionar una opci&oacute;n
                                </div>
                            </div>
                        </div>

                        <div id="errorMenu" class="btn-danger erroBoxs" style="display: none">
                            * Debe seleccionar una opci&oacute;n
                        </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrar_modal_agregar"class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <span id="agregarUsuario" name="agregarUsuario" class="btn btn-primary">Agregar Usuario</span>
                    </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>

<!--Modificar -->
<div class="modal fade" id="modal-editar-usuario" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Form components -->
            <form id="form-modificar-usuario" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">

                <!-- Basic inputs -->
                <div class="panel panel-default">

                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Modificar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="panel-body">
                        <input type="hidden" name="idUsuarioModificar" id="idUsuarioModificar" class="form-control">

                        <!-- Nombre Persona  -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Nombre:</span> </label>
                            <div class="col-sm-10">

                                <input type="text" name="nombrePersonaModifcar" id="nombrePersonaModificar" class="form-control">
                                <div id="errorNombrePersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un nombre v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--apellido-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Apellido:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="apellidoPersonaModificar" id="apellidoPersonaModificar" class="form-control">
                                <div id="errorApellidoPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un apellido v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Telefono
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Teléfono:</span> </label>
                            <div class="col-sm-10">
                                <input type="number" name="telefonoPersonaModificar" id="telefonoPersonaModificar" class="form-control">
                                <div id="errorTelefonoPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese un número de teléfono v&aacute;lido
                                </div>
                            </div>
                        </div>
-->
                        <!--Email-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Email:</span> </label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="email" name="emailUsuarioModificar" id="emailUsuarioModificar" class="form-control" onblur="validateEmailUsuario()">
                                </div>
                                <div id="errorEmailUsuarioModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una dirección de correo v&aacute;lida
                                </div>
                            </div>
                        </div>

                        <!--Provincia-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblcomuna"><span style="color: red;">*</span>Provincia</label>
                            <div class="col-sm-10">
                                <select name="selectProvinciaModificar" id="selectProvinciaModificar" class="form-control" required style="padding-right: 0px;">
                                    <option value="0">Seleccionar Provincia</option>
                                    <?php
                                    if (isset($provincia)) :
                                        for ($i = 0; $i < count($provincia); $i++) :
                                            echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorSelectProvinciaPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Seleccione una comuna v&aacute;lida
                                </div>
                            </div>
                        </div>
                        <!--Localidad-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblcomuna"><span style="color: red;">*</span>Localidad</label>
                            <div class="col-sm-10">
                                <select name="selectLocalidadModificar" id="selectLocalidadModificar" class="form-control" required style="padding-right: 0px;">
                                    <option value="0">Seleccionar Localidad</option>
                                    <?php
                                    if (isset($localidades)) :
                                        for ($i = 0; $i < count($localidades); $i++) :
                                            echo '<option value="' . $localidades[$i]['idLocalidad'] . '">' . $localidades[$i]['nombre'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorSelectLocalidadPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Seleccione una comuna v&aacute;lida
                                </div>
                            </div>
                        </div>

                        <!--direccion-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Direcci&oacute;n:</span> </label>
                            <div class="col-sm-10">
                                <input type="text" name="direccionPersonaModificar" id="direccionPersonaModificar" class="form-control">
                                <div id="errorDireccionPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una direcci&oacute;n valida
                                </div>
                            </div>
                        </div>

                        <!--Nombre Usuario-->
                        <div class="form-group">
                            <div class="col col-md-12">
                                <label class="col-sm-2 control-label" style="padding-left: 0px;"><span><span style="color: red;"> * </span>Usuario:</span> </label>
                                <div class="col-sm-10" style="padding: initial;">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                        </div>
                                        <input type="text" id="nombreUsuarioPersonaModificar" name="nombreUsuarioPersonaModificar" placeholder="Username" class="form-control">
                                    </div>
                                    <div id="errorUsuarioPersona" class="btn-danger erroBoxs" style="display: none">
                                        * Ingrese un usuario v&aacute;lido
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--password-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span><span style="color: red;">*</span>Contraseña:</span> </label>
                            <div class="col-sm-10 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-asterisk"></i>
                                </div>
                                <input type="password" id="passwordPersonaModificar" name="passwordPersonaModificar" placeholder="Password" class="form-control">
                                <div id="errorPass" class="btn-danger erroBoxs" style="display: none">
                                    * Ingrese una contraseña v&aacute;lido
                                </div>
                            </div>
                        </div>

                        <!--Nivel-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="lblNivel"><span style="color: red;"> * </span>Nivel</label>
                            <div class="col-sm-10">
                                <select name="selectNivelUsuarioModificar" id="selectNivelUsuarioModificar" class="form-control" required>
                                    <option value="0">Seleccionar Nivel</option>
                                    <?php
                                    if (isset($nivel)) :
                                        for ($i = 0; $i < count($nivel); $i++) :
                                            echo '<option value="' . $nivel[$i]['idNivel'] . '">' . $nivel[$i]['nivel'] . '</option>';
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <div id="errorNivelPersonaModificar" class="btn-danger erroBoxs" style="display: none">
                                    * Debe seleccionar una opci&oacute;n
                                </div>
                            </div>
                        </div>

                        <div id="errorMenu" class="btn-danger erroBoxs" style="display: none">
                            * Debe seleccionar una opci&oacute;n
                        </div>

                    <div class="modal-footer">
                        <button type="button" id="cerrar_modal_modificar"class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <span id="modificarUsuarioBTN" name="modificarUsuarioBTN" class="btn btn-primary">Modificar Usuario</span>
                    </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>

</div>
<!-- Modal de editar precio -->
<div class="modal fade" id="modal-modificar-precio" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Form components -->
            <form id="form-modificar-precio" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">

                <!-- Basic inputs -->
                <div class="panel panel-default">

                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Modificar Precio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><span><span style="color: red;"> * </span>Precio:</span> </label>
                    <div class="col-sm-10">
                        <input type="number" name="precioModificar" id="precioModificar" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="cerrar_modal_modificar"class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <span type="button" id="modificarPrecio" name="modificarPrecio" class="btn btn-primary">Modificar Precio</span>
                </div>
      </form>
</div>
</div>
</div>
