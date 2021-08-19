<div class="page-wrapper">
<div class="page-container">
<!--Begin Page Content-->
<div class="container-fluid addPedidos">
    <form id="formSolicitudEnvio" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">
        <!-- DataTales Example -->
        <div class="card shadow col-md-12" style="padding-top: 2%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nuevo envio</h6>
            </div>

            <input type="hidden" id="idEnvio_formSolicitudEnvio" name="idEnvio_formSolicitudEnvio">

            <div class="card-body">
                <div class="row">
                    <div class="card-body card-block" style = "width:100%;">
                        <div class="row form-group">
                            <div class="">
                                <label for="select" class="form-control-label">Remitente<span style="color: blue;">(*)</span></label>
                                <div style="display: flex;">
                                    <div class="col col-md-8" >
                                        <select name="idClienteEnvio_formSolicitudEnvio" id="idClienteEnvio_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                            <option value="0">Seleccionar Cliente</option>
                                            <?php
                                            if (isset($cliente)) :
                                                for ($i = 0; $i < count($cliente); $i++) :
                                                    echo '<option value="' . $cliente[$i]['idUsuario'] . '">' . $cliente[$i]['apellido'] . ', ' . $cliente[$i]['nombreCompleto'] . '</option>';
                                                endfor;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col col-md-4 " style="padding: initial; width: 90%;">
                                        <a type="button" data-toggle="modal" href="#modal-agregar-usuario" id="agregar-usuario" class="botonNuevoUsuarioEnvio btn btn-info" onclick="vaciado_agregar_usuario()" style="width: inherit;">
                                            <i class="fas fa-plus"></i> &nbsp; Nuevo cliente
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                          <div class="col col-md-6">
                              <label for="select" class="form-control-label">Provincia de retiro <span style="color: blue;">(*)</span></label>
                              <select name="provinciaRetiro_formSolicitudEnvio" id="provinciaRetiro_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                  <option value="0">Seleccionar provincia</option>
                                  <?php
                                  if (isset($provincia)) :
                                      for ($i = 0; $i < count($provincia); $i++) :
                                          echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                      endfor;
                                  endif;
                                  ?>
                              </select>
                          </div>
                          <div class="col col-md-6">
                              <label for="select" class="form-control-label">Localidad de retiro <span style="color: blue;">(*)</span></label>
                              <select name="localidadRetiro_formSolicitudEnvio" id="localidadRetiro_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                  <option value="0">Seleccionar Localidad</option>
                                  <?php
                                  if (isset($localidad)) :
                                      for ($i = 0; $i < count($localidad); $i++) :
                                          echo '<option value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                      endfor;
                                  endif;
                                  ?>
                              </select>
                          </div>

                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Fecha de envio<span style="color: blue;">(*)</span></label>
                                <input type="date" min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d").""));?>" id="fechaEnvio_formSolicitudEnvio" name="fechaEnvio_formSolicitudEnvio" placeholder="Fecha que se espera ser retirado" class="form-control">
                            </div>

                        </div>
                        <hr>
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="text-input" class=" form-control-label">Nombre completo del receptor <span style="color: blue;">(*)</span></label>
                                <input type="text" id="nombreReceptor_formSolicitudEnvio" name="nombreReceptor_formSolicitudEnvio" placeholder="Nombre" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">

                          <div class="col col-md-6">
                              <label for="select" class="form-control-label">Provincia de destino <span style="color: blue;">(*)</span></label>
                              <select name="provinciaDestino_formSolicitudEnvio" id="provinciaDestino_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                  <option value="0">Seleccionar provincia</option>
                                  <?php
                                  if (isset($provincia)) :
                                      for ($i = 0; $i < count($provincia); $i++) :
                                          echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                      endfor;
                                  endif;
                                  ?>
                              </select>
                          </div>
                          <div class="col col-md-6">
                              <label for="select" class="form-control-label">Localidad de destino <span style="color: blue;">(*)</span></label>
                              <select name="localidadDestino_formSolicitudEnvio" id="localidadDestino_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                  <option value="0">Seleccionar Localidad</option>
                                  <?php
                                  if (isset($localidad)) :
                                      for ($i = 0; $i < count($localidad); $i++) :
                                          echo '<option value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                      endfor;
                                  endif;
                                  ?>
                              </select>
                          </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">N&uacutemero de remito <span style="color: blue;">(*)</span></label>
                                <input type="text" id="nroRemito_formSolicitudEnvio" name="nroRemito_formSolicitudEnvio" placeholder="Número" class="form-control">
                            </div>
                            <!--Remito-->
                            <div class="col col-md-6">
                                <label class="col-sm-4 control-label">Remito:</label>
                                <div class="col-sm-6">
                                    <input type="file" name="fileRemito" id="fileRemito" class="styled">
                                    <div id="errorRemito" class="btn-danger col-sm-2 erroBoxs" style="display: none">
                                        * Ingrese un archivo con un formato adecuado.
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label">Fecha de Entrega <span style="color: blue;">(*)</span></label>
                                <input type="date" id="fechaEntrega_formSolicitudEnvio"  min = "<?php echo date("Y-m-d",strtotime(date("Y-m-d")."+ 1 days"));?>"name="fechaEntrega_formSolicitudEnvio" placeholder="Fecha que se espera ser retirado" class="form-control">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col col-md-6">
                                <label for="text-input" class=" form-control-label" >Cantidad de bultos <span style="color: blue;">(*)</span></label>
                                <input type="number" id="cantidad_formSolicitudEnvio" name="cantidad_formSolicitudEnvio" placeholder="Cantidad de productos a enviar" class="form-control" >
                            </div>
                        </div>

                        <label for="select" class="form-control-label">Estado <span style="color: blue;">(*)</span></label>
                        <select name="estado_formSolicitudEnvio" id="estado_formSolicitudEnvio" class="form-control" requiblue style="padding-right: 0px;">
                            <option value="0">Seleccionar estado</option>
                            <?php
                            if (isset($estados)) :
                                for ($i = 0; $i < count($estados); $i++) :

                                        echo '<option value="' . $estados[$i]['idEstado'] . '">' . $estados[$i]['nombre'] . '</option>';



                                endfor;
                            endif;
                            ?>
                        </select>

                        <!-- Descripción del producto -->
                        <div class="row form-group">
                            <div class="col col-md-12">
                                <label for="textarea-input" class=" form-control-label">Observaciones</label>
                                <textarea name="observacion_pedido" id="observacion_pedido" rows="2" placeholder="Observación extra sobre el pedido solicitante" class="form-control" style="resize: none"></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-12" style="display: flex;">
                                <div class="col col-md-6">
                                    <span class="btn  btn-danger" onclick="redirect_listar_envios()"><i class="fas fa-long-arrow-alt-left botonAtras"></i>&nbsp;&nbsp;Atras</span>
                                </div>
                                <div class="col col-md-6">
                                    <button class="btn  btn-info float-right" id="add_envio" name="add_envio"><i class="fas fa-plus botonGuardarEnvio"></i>&nbsp;&nbsp;Guardar envio</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
</div>
</div>
