<div class="page-wrapper">
<!--Begin Page Content-->
<div class="page-container">
    <div class="container-fluid listaEnvios">
     <!--DataTales Example-->
        <div class="card shadow col-md-12" style="padding-top: 2%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Listado de envios</h6>
            </div>
            <div class="card-body">
            
                <div class="row">
                    <div class="col-sm-12 botonNuevoEnvio">
                    <?PHP if ($userdata['idNivel'] == 1) { ?>
                        <a type="button" href="<?=$url?>envios/add_envio" id="btn_nuevo_envio" class="btn btn-info">
                            <i class="fas fa-plus"></i> &nbsp; Nuevo Envio
                        </a>
                    </div>
                    <?PHP } ?>
                    <!-- <button id="exportInformeEnvios" value="Exportar envios" class="btn btn-primary" onclick="exportar_envios(<?=$userdata['idUsuario']?>, <?=$userdata['idNivel']?>)"><i class="fas fa-file-export"></i>Exportar envíos</button>-->
                </div>
                
                <div class="row m-t-30 tablaEnvios" id="tabla_lista_envios">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3"  id="listado_envios" name="listado_envios" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nro Remito</th>
                                        <th class="text-center">Destinatario</th>
                                        <th class="text-center">Remitente</th>
                                        <th class="text-center">Localidad de retiro</th>
                                        <th class="text-center">Localidad de entrega</th>
                                        <th class="text-center">Fecha Retiro</th>
                                        <th class="text-center">Fecha de entrega</th>
                                        <th class="text-center">Observación</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
