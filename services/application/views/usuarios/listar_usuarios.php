<div class="page-wrapper">
<div class="page-container">
<!--Begin Page Content-->
<div class="container-fluid listaUsuarios">
    <!-- DataTales Example -->
    <div class="card shadow col-md-12" style="padding-top: 2%;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listado de usuarios</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 botonNuevoUsuario">
                    <a type="button" data-toggle="modal" href="#modal-agregar-usuario" id="agregar-usuario" class="btn btn-info" onclick="vaciado_agregar_usuario()">
                        <i class="fas fa-plus"></i> &nbsp; Nuevo usuario
                    </a>
                </div>
            </div>
            <div class="row m-t-30">
                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3 tablaUsuarios" id="listado_usuarios" width="100%" cellspacing="0">

                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Apellido, Nombre</th>
                                    <th class="text-center">Usuario</th>
                                    <th class="text-center">Email</th>
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
