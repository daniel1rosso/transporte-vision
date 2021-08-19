<div class="page-wrapper">
<!--Begin Page Content-->
<div class="page-container">
    <div class="container-fluid listaPedidos">
     <!--DataTales Example-->
        <div class="card shadow col-md-12" style="padding-top: 2%;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Listado de conformes</h6>
            </div>
            <div class="card-body">
                <div class="row">
                  <!--
                    <div class="col-sm-12 botonNuevoPedido">
                        <a type="button" href="<?=$url?>documentacion/add_conforme" id="btn_nuevo_conforme" class="btn btn-info">
                            <i class="fas fa-plus"></i> &nbsp; Nuevo conforme
                        </a>
                    </div>
                  -->
                </div>
                <div class="row m-t-30 tablaConforme" id="tabla_lista_conforme">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3"  id="listado_conformes" name="listado_conformes" width="100%" cellspacing="0">
                                <thead>
                                    <tr>

                                        <th class="text-center">Apellido, Nombre</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Nro Remito</th>
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
