<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Envios extends MY_Controller {

    protected $data = array(
        'active' => 'envios'
    );

    public function listar_envios() {
        //--- datos ---//
        $this->data['userdata']  = $this->session->all_userdata();

        $this->load_view('envios/listar_envios', $this->data);
    }

    public function listar_envios_table() {
        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $userdata = $this->session->all_userdata();

        if($userdata['idNivel'] == 1){
            $envios = $this->app_model_envio->get_envios();
        } else if ($userdata['idNivel'] == 2) {
            $envios = $this->app_model_envio->get_envio_by_idRemitente($userdata['idUsuario']);
        }

        if ($envios) {
            foreach ($envios as $key => $value) {

                $texto = "";
                $class = "";
                $cambios_estados = "";

                if ($value['idEstado'] == 1) :
                    $class = "btn-secondary";
                    $texto = "Pendiente";
                    $cambios_estados = '<li><a style="font-weight: bold;">Cambiar estado de envío a:</a></li>'.
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_aceptado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Aceptado"></i> Envío Aceptado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_rechazado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Rechazado"></i> Envío Rechazado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_entregado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Entregado"></i> Envío Entregado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_conformado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Conformado"></i> Envío Conformado</a></li>';
                elseif ($value['idEstado'] == 2):
                    $class = "btn-info";
                    $texto = "Aceptado";
                    $cambios_estados = '<li><a style="font-weight: bold;">Cambiar estado de envío a:</a></li>'.
                    '<li class="listaAcciones"><a class="textoAcciones" href="#" onclick="set_envio_pendiente('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Pendiente"></i> Envío Pendiente</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_rechazado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Rechazado"></i> Envío Rechazado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_entregado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Entregado"></i> Envío Entregado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_conformado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Conformado"></i> Envío Conformado</a></li>';
                elseif ($value['idEstado'] == 3):
                    $class = "btn-danger";
                    $texto = "Rechazado";
                    $cambios_estados = '<li><a style="font-weight: bold;">Cambiar estado de envío a:</a></li>'.
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_pendiente('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Pendiente"></i> Envío Pendiente</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_aceptado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Aceptado"></i> Envío Aceptado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_entregado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Entregado"></i> Envío Entregado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_conformado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Conformado"></i> Envío Conformado</a></li>';
                elseif ($value['idEstado'] == 4):
                    $class = "btn-success";
                    $texto = "Entregado";
                    $cambios_estados = '<li><a style="font-weight: bold;">Cambiar estado de envío a:</a></li>'.
                     '<li><a class="textoAcciones" href="#" onclick="set_envio_pendiente('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Pendiente"></i> Envío Pendiente</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_aceptado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Aceptado"></i> Envío Aceptado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_rechazado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Rechazado"></i> Envío Rechazado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_conformado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Conformado"></i> Envío Conformado</a></li>';
                elseif ($value['idEstado'] == 5):
                    $class = "btn-warning";
                    $texto = "Conformado";
                    /*$cambios_estados = '<li><a style="font-weight: bold;">Cambiar estado de envío a:</a></li>'.
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_pendiente('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Pendiente"></i> Envío Pendiente</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_aceptado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Aceptado"></i> Envío Aceptado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_rechazado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Rechazado"></i> Envío Rechazado</a></li>' .
                    '<li><a class="textoAcciones" href="#" onclick="set_envio_entregado('.$value['idEnvio'].')"><i class="fas fa-retweet" title = "Envío Entregado"></i> Envío Entregado</a></li>';*/
                endif;

                if($userdata['idNivel'] == 1){
                  if ( $value['idEstado'] == 1):
                    $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="redirect_modificar_envio('.$value['idEnvio'].')"><i class="far fa-edit" title = "Editar Envío" ></i> Editar Envío</a></li>' .
                                     '<li><a class="textoAcciones" href="#" onclick="delete_envio('.$value['idEnvio'].')"><i class="far fa-trash-alt" title = "Eliminar Envío"></i> Eliminar Envío</a></li>' .
                                     '<li><a class="textoAcciones" href="#" onclick="ver_remito('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver Remito</a></li>'.
                                     '<li class="divider" style="margin-top: 5rem; margin-bottom: 0.1rem;"><hr></li>' .
                                     $cambios_estados;
                  elseif ($value['idEstado'] == 2):
                      $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="redirect_modificar_envio('.$value['idEnvio'].')"><i class="far fa-edit" title = "Editar Envío" ></i> Editar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="delete_envio('.$value['idEnvio'].')"><i class="far fa-trash-alt" title = "Eliminar Envío"></i> Eliminar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="ver_remito('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver Remito</a></li>'.
                                       '<li class="divider" style="margin-top: 5rem; margin-bottom: 0.1rem;"><hr></li>' .
                                       $cambios_estados;

                  elseif ($value['idEstado'] == 4):
                      $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="redirect_modificar_envio('.$value['idEnvio'].')"><i class="far fa-edit" title = "Editar Envío" ></i> Editar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="delete_envio('.$value['idEnvio'].')"><i class="far fa-trash-alt" title = "Eliminar Envío"></i> Eliminar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="ver_remito('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver Remito</a></li>'.
                                       '<li class="divider" style="margin-top: 5rem; margin-bottom: 0.1rem;"><hr></li>' .
                                       $cambios_estados;
                  elseif ($value['idEstado'] == 3):
                      $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="redirect_modificar_envio('.$value['idEnvio'].')"><i class="far fa-edit" title = "Editar Envío" ></i> Editar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="delete_envio('.$value['idEnvio'].')"><i class="far fa-trash-alt" title = "Eliminar Envío"></i> Eliminar Envío</a></li>' .

                                       '<li class="divider" style="margin-top: 5rem; margin-bottom: 0.1rem;"><hr></li>' .
                                       $cambios_estados;
                  elseif ($value['idEstado'] == 5):
                      $bloqueInterno =
                                       '<li><a class="textoAcciones" href="#" onclick="delete_envio('.$value['idEnvio'].')"><i class="far fa-trash-alt" title = "Eliminar Envío"></i> Eliminar Envío</a></li>' .
                                       '<li><a class="textoAcciones" href="#" onclick="ver_conforme('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver conforme</a></li>'.
                                       '<li class="divider" style="margin-top: 5rem; margin-bottom: 0.1rem;"><hr></li>' .
                                       $cambios_estados;
                  endif;
                }
                 else if ($userdata['idNivel'] == 2) {
                     if ($value['idEstado'] == 1 && $value['idEstado'] == 2 && $value['idEstado'] == 4) {
                        $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="ver_remito('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver Remito</a></li>';
                     } else if ($value['idEstado'] == 5) {
                        $bloqueInterno = '<li><a class="textoAcciones" href="#" onclick="ver_conforme('.$value['idEnvio'].')"><i class="far fa-eye"></i> Ver conforme</a></li>';
                     } else {
                         $bloqueInterno = '';
                     }
                }

                $opcion = /*' <div class="btn-group">' .
                        '<button class="btn ' . $class . '" style="padding: 3px;font-size: 0.8em;">' . $texto . '</button>' .
                        '<button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" style="padding: 3px;font-size: 0.8em;"><span class="caret caret-split"></span></button>' .
                        '<ul class="dropdown-menu icons-right" style="text-align: center;">' .
                        $bloqueInterno .
                        '</ul>' .
                        '</div>';*/

                        '<div class="botonAccion">'.
                           '<li class="listaBotonAccion">'.
                                '<a class="menu '.$texto.'" href="#" data-toggle="dropdown" data-title="'.$texto.'"><span class="caret caret-split">'.
                                '<span>'.$texto .'</span>'.
                                '</span></a>'.
                                '<ul class="dropdown-menu icons-right" style="text-align: center;">' . $bloqueInterno .'</ul>'.
                            '</li>'.
                        '</div>';


                $observaciones = (strlen($value['observaciones']) > 0) ? (strlen($value['observaciones']) < 25) ? $value['observaciones'] : substr($value['observaciones'], 0, 24) . "..." : "Sin observaciones";

                $dato[] = array(
                    $value['nroRemito'],
                    $value['nombreReceptor'],
                    $value['nombreCliente'],
                    $value['localidadRetiro'] . ", " .$value['provinciaRetiro'],
                    $value['localidadDestino']. ", " .$value['provinciaDestino'],
                    $value['fechaEnvio'],
                    $value['fechaEntrega'],
                    $observaciones,
                    $opcion,
                    "DT_RowId" => $value['idEnvio']
                );
            }
        }

        $aa = array(
            'sEcho' => 1,
            'iTotalRecords' => count($dato),
            'iTotalDisplayRecords' => 10,
            'aaData' => $dato
        );

        echo json_encode($aa);
    }

    public function add_envio() {
        $this->data['provincia'] = $this->app_model->get_provincias();
        $this->data['nivel'] = $this->app_model->get_niveles();
        $this->data['estados'] = $this->app_model->get_estados();
        $this->data['cliente'] = $this->app_model_usuario->get_usuarios();
        $this->load_view('envios/add_envio', $this->data);
    }

    public function new_envio(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {

            //--- Obtencion de los datos ---//
            $idCliente = $this->input->post('idClienteEnvio_formSolicitudEnvio', true);
            $nombreReceptor = $this->input->post('nombreReceptor_formSolicitudEnvio', true);
            $nroRemito = $this->input->post('nroRemito_formSolicitudEnvio', true);
            $cantidad = $this->input->post('cantidad_formSolicitudEnvio', true);
            $provinciaRetiro = $this->input->post('provinciaRetiro_formSolicitudEnvio', true);
            $localidadRetiro = $this->input->post('localidadRetiro_formSolicitudEnvio', true);
            $fechaEnvio = $this->input->post('fechaEnvio_formSolicitudEnvio', true);
            $estado = $this->input->post('estado_formSolicitudEnvio', true);
            $fechaEntrega = $this->input->post('fechaEntrega_formSolicitudEnvio', true);
            $provinciaDestino = $this->input->post('provinciaDestino_formSolicitudEnvio', true);
            $localidadDestino = $this->input->post('localidadDestino_formSolicitudEnvio', true);
            $observacion = $this->input->post('observacion_pedido', true);

            //--- Agregamos el envio ---//
            $add_envio = $this->app_model_envio->add_envio($idCliente,$nombreReceptor,$nroRemito,$cantidad,$provinciaRetiro,$localidadRetiro,$fechaEnvio,$estado,$fechaEntrega,$provinciaDestino,$localidadDestino,$observacion);

            if ($add_envio) {
                $envio = $this->app_model_envio->get_ultimo_envio();
                if ($envio) {
                    $msg = "Se guardo el envío con exito";
                    $dato = array("valid" => true, "msg" => $msg, "idEnvio" => $envio[0]['idEnvio']);
                } else {
                    $msg = "No se obtuvo el envío con exito, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "El envío no pudo registrarse con exito, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_envio($idEnvio) {
        //--- datos ---//
        $this->data['userdata']  = $this->session->all_userdata();
        $this->data['idEnvio']  = $idEnvio;
        $this->data['envio'] = $this->app_model_envio->get_envio_by_idEnvio($idEnvio);
        $this->data['provincia'] = $this->app_model->get_provincias();
        $this->data['localidad'] = $this->app_model->get_localidades();
        $this->data['estados'] = $this->app_model->get_estados();
        $this->data['cliente'] = $this->app_model_usuario->get_usuarios();

        $this->load_view('envios/update_envio', $this->data);
    }

    public function update_envio(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {

            //--- Obtencion de los datos ---//
            $idEnvio = $this->input->post('idEnvio_formUpdateEnvio', true);
            $idCliente = $this->input->post('idClienteEnvio_formUpdateEnvio', true);
            $nombreReceptor = $this->input->post('nombreReceptor_formUpdateEnvio', true);
            $nroRemito = $this->input->post('nroRemito_formUpdateEnvio', true);
            $cantidad = $this->input->post('cantidad_formUpdateEnvio', true);
            $provinciaRetiro = $this->input->post('provinciaRetiro_formUpdateEnvio', true);
            $localidadRetiro = $this->input->post('localidadRetiro_formUpdateEnvio', true);
            $fechaEnvio = $this->input->post('fechaEnvio_formUpdateEnvio', true);
            $estado = $this->input->post('estado_formUpdateEnvio', true);
            $fechaEntrega = $this->input->post('fechaEntrega_formUpdateEnvio', true);
            $provinciaDestino = $this->input->post('provinciaDestino_formUpdateEnvio', true);
            $localidadDestino = $this->input->post('localidadDestino_formUpdateEnvio', true);
            $observacion = $this->input->post('observacion_formUpdateEnvio', true);

            //--- Actualizamos el envio ---//
            $update_envio = $this->app_model_envio->update_envio($idEnvio,$idCliente,$nombreReceptor,$nroRemito,$cantidad,$provinciaRetiro,$localidadRetiro,$fechaEnvio,$estado,$fechaEntrega,$provinciaDestino,$localidadDestino,$observacion);

            if ($update_envio) {
                $msg = "Se actualizo el envio con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "El envio no pudo actualizarse con exito, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function delete_envio(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Eliminamos el envio ---//
                $delete_envio = $this->app_model_envio->delete_envio($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($delete_envio ) {
                    $msg = "Se eliminó el envio con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al eliminar el envio, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function cargar_localidades_retiro(){
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Credentials: true');

      //--- Validamos post ---//
      if ($_POST) {
          $idProvincia = $this->input->post('idProvinciaRetiro', true);

          //--- Validacion de los datos ---//
          if (!empty($idProvincia)) {

              //--- Eliminamos el detalle del pedido ---//
              $cargar_localidades = $this->app_model->get_localidadesById($idProvincia);

              //--- Validamos si el registro realizado correctamente ---//
              if ($cargar_localidades ) {

                  $msg = "Se cargo";
                  $dato = array("valid" => true, "msg" => $msg, 'localidadRetiro' => $cargar_localidades);
              } else {
                  $msg = "Error al cargar localidades, vuelva a intentarlo";
                  $dato = array("valid" => false, "msg" => $msg);
              }
          } else {
              $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
              $dato = array("valid" => false, "msg" => $msg);
          }
      } else {
          $msg = "Error de sistema. Contacte con el Administrador.";
          $dato = array("valid" => false, "msg" => $msg);
      }

      echo json_encode($dato);
    }

    public function cargar_localidades_destino(){
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Credentials: true');

      //--- Validamos post ---//
      if ($_POST) {
          $idProvincia = $this->input->post('idProvinciaDestino', true);

          //--- Validacion de los datos ---//
          if (!empty($idProvincia)) {

              //--- Eliminamos el detalle del pedido ---//
              $cargar_localidades = $this->app_model->get_localidadesById($idProvincia);

              //--- Validamos si el registro realizado correctamente ---//
              if ($cargar_localidades ) {

                  $msg = "Se cargo";
                  $dato = array("valid" => true, "msg" => $msg, 'localidadDestino' => $cargar_localidades);
              } else {
                  $msg = "Error al cargar localidades, vuelva a intentarlo";
                  $dato = array("valid" => false, "msg" => $msg);
              }
          } else {
              $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
              $dato = array("valid" => false, "msg" => $msg);
          }
      } else {
          $msg = "Error de sistema. Contacte con el Administrador.";
          $dato = array("valid" => false, "msg" => $msg);
      }

      echo json_encode($dato);
    }

    public function cargar_localidades_cliente(){
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Credentials: true');

      //--- Validamos post ---//
      if ($_POST) {
          $idProvincia = $this->input->post('idProvinciaCliente', true);

          //--- Validacion de los datos ---//
          if (!empty($idProvincia)) {

              //--- Eliminamos el detalle del pedido ---//
              $cargar_localidades = $this->app_model->get_localidadesById($idProvincia);

              //--- Validamos si el registro realizado correctamente ---//
              if ($cargar_localidades ) {

                  $msg = "Se cargo";
                  $dato = array("valid" => true, "msg" => $msg, 'localidadCliente' => $cargar_localidades);
              } else {
                  $msg = "Error al cargar localidades, vuelva a intentarlo";
                  $dato = array("valid" => false, "msg" => $msg);
              }
          } else {
              $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
              $dato = array("valid" => false, "msg" => $msg);
          }
      } else {
          $msg = "Error de sistema. Contacte con el Administrador.";
          $dato = array("valid" => false, "msg" => $msg);
      }

      echo json_encode($dato);
    }

    public function set_envio_pendiente(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Cambiamos el estado del envio a pendiente ---//
                $set_envio_pendiente = $this->app_model_envio->set_envio_pendiente($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($set_envio_pendiente ) {
                    $msg = "Se cambio el estado del envio a pendiente con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar el estado del envio a pendiente, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_envio_aceptado(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Cambiamos el estado del envio a aceptado ---//
                $set_envio_aceptado = $this->app_model_envio->set_envio_aceptado($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($set_envio_aceptado ) {
                    $msg = "Se cambio el estado del envio a aceptado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar el estado del envio a aceptado, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_envio_rechazado(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Cambiamos el estado del envio a rechazado ---//
                $set_envio_rechazado = $this->app_model_envio->set_envio_rechazado($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($set_envio_rechazado ) {
                    $msg = "Se cambio el estado del envio a rechazado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar el estado del envio a rechazado, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_envio_entregado(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Cambiamos el estado del envio a entregado ---//
                $set_envio_entregado = $this->app_model_envio->set_envio_entregado($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($set_envio_entregado ) {
                    $msg = "Se cambio el estado del envio a entregado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar el estado del envio a entregado, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function set_envio_conformado(){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Validamos post ---//
        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);

            //--- Validacion de los datos ---//
            if (!empty($idEnvio)) {

                //--- Cambiamos el estado del envio a conformado ---//
                $set_envio_conformado = $this->app_model_envio->set_envio_conformado($idEnvio);

                //--- Validamos si el registro realizado correctamente ---//
                if ($set_envio_conformado ) {
                    $msg = "Se cambio el estado del envio a conformado con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "Error al cambiar el estado del envio a conformado, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_remito_idEnvio() {
      header("Access-Control-Allow-Origin: *");
      header('Access-Control-Allow-Credentials: true');
      $msg = "";
      //--- Validamos post ---//
      if ($_POST) {
          $idEnvio = $this->input->post('idEnvio', true);

          //--- Validacion de los datos ---//
          if (!empty($idEnvio)) {

              //--- Obtenemos el envio correspondiente al idEnvio ---//
              $remito = $this->app_model_envio->get_envio_by_idEnvio($idEnvio);

              //--- Validamos si el registro realizado correctamente ---//
              if ($remito ) {
                  $msg = "Envío obtenido con exito";
                  $dato = array("valid" => true, "msg" => $msg, "remito" => $remito);
              } else {
                  $msg = "Error al obtener el envio correspondiente al idEnvio, vuelva a intentarlo";
                  $dato = array("valid" => false, "msg" => $msg);
              }
          } else {
              $msg = "Algun dato obligatorio falta, vuelva a intentarlo";
              $dato = array("valid" => false, "msg" => $msg);
          }
      } else {
          $msg = "Error de sistema. Contacte con el Administrador.";
          $dato = array("valid" => false, "msg" => $msg);
      }

      echo json_encode($dato);
    }

    public function add_remito_envio() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio_formSolicitudEnvio', true);
            $perfil = $this->input->post('fileRemito', true);

            if (!empty($idEnvio)) {

                $remito = "";
                $file = 'fileRemito';

                if (!empty($_FILES[$file]['name'])) {
                    $remito = substr(md5(microtime()), 15, 17);
                    $urlCarpeta = './uploads/remitos/' . $remito;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|xlsx|doc|docx';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;

                    $config['file_name'] = $remito;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $remito = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $remito;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                }

                $remito = $this->app_model_envio->update_remito_envio($idEnvio, $remito);

                if ($remito) {
                    $msg = "Se registro el envío con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "No se pudo registrar el envío con exito, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function update_remito_envio() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio_formUpdateEnvio', true);
            $perfil = $this->input->post('fileRemitoUpdate', true);

            if (!empty($idEnvio)) {

                $remito = "";
                $file = 'fileRemitoUpdate';

                if (!empty($_FILES[$file]['name'])) {
                    $remito = substr(md5(microtime()), 15, 17);
                    $urlCarpeta = './uploads/remitos/' . $remito;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|xlsx|doc|docx';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;

                    $config['file_name'] = $remito;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $remito = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $remito;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                }

                $remito = $this->app_model_envio->update_remito_envio($idEnvio, $remito);

                if ($remito) {
                    $msg = "Se registro el envío con exito";
                    $dato = array("valid" => true, "msg" => $msg);
                } else {
                    $msg = "No se pudo registrar el envío con exito, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function add_conforme_envio() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {
            $idEnvio = $this->input->post('idEnvio', true);
            $conforme = $this->input->post('fileConforme', true);

            if (!empty($idEnvio) && $conforme != "" && strlen($conforme) > 0) {

                $conforme = "";
                $file = 'fileConforme';

                if (!empty($_FILES[$file]['name'])) {
                    $conforme = substr(md5(microtime()), 15, 17);
                    $urlCarpeta = './uploads/conformes/' . $conforme;
                    if (!file_exists($urlCarpeta)) {
                        mkdir($urlCarpeta, 0700);
                    }

                    $config['upload_path'] = $urlCarpeta . '/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|xlsx|doc|docx';
                    $config['max_size'] = '0';
                    $config['overwrite'] = TRUE;

                    $config['file_name'] = $conforme;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($file)) {
                        $error = array('error' => $this->upload->display_errors());
                        $dato = array("valid" => false, "error" => $error);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $conforme = $data['upload_data']['file_name'];
                        $extension = $data['upload_data']['file_ext'];

                        if ($extension != '.pdf') {
                            $imgWidth = $data['upload_data']['image_width'];
                            if ($imgWidth > 1024) {
                                //Creo Risize de la img grande
                                $config2['image_library'] = 'gd2';
                                //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
                                $config2['source_image'] = $urlCarpeta . '/' . $conforme;
                                //$config2['create_thumb'] = TRUE;
                                $config2['maintain_ratio'] = TRUE;
                                $config2['width'] = 1024;
                                $config2['height'] = 1024;

                                $this->load->library('image_lib', $config2);
                                $this->image_lib->initialize($config2);
                                $this->image_lib->resize();
                            }
                        }
                    }
                }

                $conforme_update = $this->app_model_envio->update_conforme_envio($idEnvio, $conforme);

                if ($conforme_update) {
                    $msg = "Se registro el envío con exito";
                    $dato = array("valid" => true, "msg" => $msg, "conforme" => $conforme);
                } else {
                    $msg = "No se pudo registrar el envío con exito, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg, "conforme" => $conforme);
                }
            } else {
                $msg = "Datos vacios";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "No hay POST";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function exportar_to_excel_envios($idCliente, $idNivel){
        header("Access-Control-Allow-Origin: *");  
        header('Access-Control-Allow-Credentials: true');  
        
        $this->load->helper('mysql_to_excel_helper');
                
        //--- tomar datos del post ---//
        //$idCliente = $this->input->post('idCliente', true);
        //$idNivel = $this->input->post('idNivel', true);

        //--- fecha actual ---//
        $hoy = getdate();
        $fechaActual = $hoy['mday'] . $hoy['mon'] . $hoy['year'];

        //--- exportar excel ---//
        if ($idNivel == 1){
            to_excel($this->app_model_envio->exportar_envios(), "informeEnvios" . $fechaActual);
        } else if ($idNivel == 2){
            to_excel($this->app_model_envio->exportar_envios_by_idCliente($idCliente), "informeEnvios" . $fechaActual);
        }
    }

}
