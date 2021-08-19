<div class="page-wrapper">
    <div class="page-container">
        <!--Begin Page Content-->
        <div class="container-fluid addPedidos">
            <form id="formUpdateEnvio" class="form-horizontal" role="form" action="#" method="POST" enctype="multipart/form-data">
                <!-- DataTales Example -->
                <div class="card shadow col-md-12" style="padding-top: 2%;">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Modificar envío</h6>
                    </div>

                    <input type="hidden" id="idEnvio_formUpdateEnvio" name="idEnvio_formUpdateEnvio" value="<?= $idEnvio ?>">

                    <div class="card-body">
                        <div class="row">
                            <div class="card-body card-block" style = "width:100%;">
                                <div class="row form-group">
                                    <div class="">
                                        <label for="select" class="form-control-label">Remitente<span style="color: blue;">(*)</span></label>
                                        <div class="col col-md-12" style="display: flex;">
                                            <select name="idClienteEnvio_formUpdateEnvio" id="idClienteEnvio_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                                <option value="0">Seleccionar Cliente</option>
                                                <?php
                                                if (isset($cliente)) :
                                                    for ($i = 0; $i < count($cliente); $i++) :
                                                        if ($cliente[$i]['idUsuario'] == $envio[0]['idCliente']) {
                                                            echo '<option selected value="' . $cliente[$i]['idUsuario'] . '">' . $cliente[$i]['nombreCompleto'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $cliente[$i]['idUsuario'] . '">' . $cliente[$i]['nombreCompleto'] . '</option>';
                                                        }
                                                    endfor;

                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label for="select" class="form-control-label">Provincia de retiro <span style="color: blue;">(*)</span></label>
                                        <select name="provinciaRetiro_formUpdateEnvio" id="provinciaRetiro_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                            <option value="0">Seleccionar provincia</option>
                                            <?php
                                            if (isset($provincia)) :
                                                for ($i = 0; $i < count($provincia); $i++) :
                                                    if ($provincia[$i]['idProvincia'] == $envio[0]['idProvinciaRetiro']) {
                                                        echo '<option selected value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                                    }
                                                endfor;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col col-md-6">
                                        <label for="select" class="form-control-label">Localidad de retiro <span style="color: blue;">(*)</span></label>
                                        <select name="localidadRetiro_formUpdateEnvio" id="localidadRetiro_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                            <option value="0">Seleccionar localidad</option>
                                            <?php
                                            if (isset($localidad)) :
                                                for ($i = 0; $i < count($localidad); $i++) :
                                                    if ($localidad[$i]['idLocalidad'] == $envio[0]['idLocalidadRetiro']) {
                                                        echo '<option selected value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                                    }
                                                endfor;
                                            endif;
                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label for="text-input" class=" form-control-label">Fecha de envio<span style="color: blue;">(*)</span></label>
                                        <input type="date" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>" id="fechaEnvio_formUpdateEnvio" name="fechaEnvio_formUpdateEnvio" placeholder="Fecha que se espera ser retirado" class="form-control" value="<?= $envio[0]['fechaEnvio'] ?>">
                                    </div>

                                </div>
                                <hr>
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="text-input" class=" form-control-label">Nombre completo del receptor <span style="color: blue;">(*)</span></label>
                                        <input type="text" id="nombreReceptor_formUpdateEnvio" name="nombreReceptor_formUpdateEnvio" placeholder="Nombre" class="form-control" value="<?= $envio[0]['nombreReceptor'] ?>">
                                    </div>
                                </div>
                                <div class="row form-group">

                                    <div class="col col-md-6">
                                        <label for="select" class="form-control-label">Provincia de destino <span style="color: blue;">(*)</span></label>
                                        <select name="provinciaDestino_formUpdateEnvio" id="provinciaDestino_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                            <option value="0">Seleccionar provincia</option>
                                            <?php
                                            if (isset($provincia)) :
                                                for ($i = 0; $i < count($provincia); $i++) :
                                                    if ($provincia[$i]['idProvincia'] == $envio[0]['idProvinciaDestino']) {
                                                        echo '<option selected value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $provincia[$i]['idProvincia'] . '">' . $provincia[$i]['nombre'] . '</option>';
                                                    }
                                                endfor;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col col-md-6">
                                        <label for="select" class="form-control-label">Localidad de destino <span style="color: blue;">(*)</span></label>
                                        <select name="localidadDestino_formUpdateEnvio" id="localidadDestino_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                            <option value="0">Seleccionar localidad</option>
                                            <?php
                                            if (isset($localidad)) :
                                                for ($i = 0; $i < count($localidad); $i++) :
                                                    if ($localidad[$i]['idLocalidad'] == $envio[0]['idLocalidadDestino']) {
                                                        echo '<option selected value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $localidad[$i]['idLocalidad'] . '">' . $localidad[$i]['nombre'] . '</option>';
                                                    }
                                                endfor;
                                            endif;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label for="text-input" class=" form-control-label">N&uacutemero de remito <span style="color: blue;">(*)</span></label>
                                        <input type="text" id="nroRemito_formUpdateEnvio" name="nroRemito_formUpdateEnvio" placeholder="Número" class="form-control" value="<?= $envio[0]['nroRemito'] ?>">
                                    </div>
                                    <!--Remito-->
                                    <div class="col col-md-6">
                                        <label class="col-sm-4 control-label">Remito:</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="fileRemitoUpdate" id="fileRemitoUpdate" class="styled">
                                            <div id="errorRemitoUpdate" class="btn-danger col-sm-2 erroBoxs" style="display: none">
                                                * Ingrese un archivo con un formato adecuado.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label for="text-input" class=" form-control-label">Fecha de Entrega <span style="color: blue;">(*)</span></label>
                                        <input type="date" id="fechaEntrega_formUpdateEnvio" min="<?php echo date("Y-m-d", strtotime(date("Y-m-d"))); ?>" name="fechaEntrega_formUpdateEnvio" placeholder="Fecha que se espera ser retirado" class="form-control" value="<?= $envio[0]['fechaEntrega'] ?>">
                                    </div>

                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-6">
                                        <label for="text-input" class=" form-control-label">Cantidad de bultos <span style="color: blue;">(*)</span></label>
                                        <input type="number" id="cantidad_formUpdateEnvio" name="cantidad_formUpdateEnvio" placeholder="Cantidad de productos a enviar" class="form-control" value="<?= $envio[0]['cantidad'] ?>">
                                    </div>

                                </div>

                                <label for="select" class="form-control-label">Estado <span style="color: blue;">(*)</span></label>
                                <select name="estado_formUpdateEnvio" id="estado_formUpdateEnvio" class="form-control" requiblue style="padding-right: 0px;">
                                    <option value="0">Seleccionar estado</option>
                                    <?php
                                    if (isset($estados)) :
                                        for ($i = 0; $i < count($estados); $i++) :
                                            if ($estados[$i]['idEstado'] == $envio[0]['idEstado']) {
                                                echo '<option selected value="' . $estados[$i]['idEstado'] . '">' . $estados[$i]['nombre'] . '</option>';
                                            } else {
                                                echo '<option value="' . $estados[$i]['idEstado'] . '">' . $estados[$i]['nombre'] . '</option>';
                                            }
                                        endfor;
                                    endif;
                                    ?>
                                </select>
                                <!-- Descripción del producto -->
                                <div class="row form-group">
                                    <div class="col col-md-12">
                                        <label for="textarea-input" class=" form-control-label">Observaciones</label>
                                        <textarea name="observacion_formUpdateEnvio" id="observacion_formUpdateEnvio" rows="2" placeholder="Observación extra sobre el pedido solicitante" class="form-control" style="resize: none" value="<?= $envio[0]['observaciones'] ?>"><?= $envio[0]['observaciones'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-12" style="display: flex;">
                                        <div class="col col-md-6">
                                            <span class="btn  btn-danger" onclick="redirect_listar_envios()"><i class="fas fa-long-arrow-alt-left botonAtras"></i>&nbsp;&nbsp;Atras</span>
                                        </div>
                                        <div class="col col-md-6">
                                            <button class="btn  btn-info float-right" id="update_envio" name="update_envio"><i class="far fa-edit botonGuardarEnvio"></i>&nbsp;&nbsp;Modificar envio</button>
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