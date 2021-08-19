<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    protected $data = array(
        'active' => 'usuarios'
    );

    public function __construct() {
        parent::__construct();

        $this->load->helper('ckeditor');

        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'content',
            'path' => 'js/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "550px", //Setting a custom width
                'height' => '100px', //Setting a custom height
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
    }

    public function listar_usuarios() {

        $userdata = $this->session->all_userdata();
        if ($userdata['idNivel'] == 1 ) {
            $this->data['active'] = 'usuarios';
            $this->data['provincia'] = $this->app_model->get_provincias();
            $this->data['localidades'] = $this->app_model->get_localidades();
            $this->data['nivel'] = $this->app_model->get_niveles();

            $this->load_view('usuarios/listar_usuarios', $this->data);
        } else {
           redirect('dashboard');
        }

    }

    public function listar_usuarios_table() {

        //--- Declaracion del arreglo ---//
        $dato = [];

        //--- datos ---//
        $usuarios = $this->app_model_usuario->get_usuarios();

        if ($usuarios) {
            foreach ($usuarios as $key => $value) {

                $opcion = '<a class="tip modificarUsuario" data-id="' . $value['idUsuario'] . '"  style="color: #4e73df;" data-original-title="Editar"><i class="fas fa-edit" style="color: #4e73df; cursor: pointer;" title="Modificar Usuario"></i></a>' .
                '&nbsp;' .
                '<a class="tip" role="button" onclick="eliminar_usuario(' . $value['idUsuario'] . ')"  style="color: #4e73df;" data-original-title="Eliminar"><i class="fas fa-trash" style="color: #4e73df; cursor: pointer;" title="Eliminar Usuario"></i></a>';

                $dato[] = array(
                    $value['idUsuario'],
                    $value['apellido'] . ', '. $value['nombreCompleto'],
                    $value['usuario'],
                    $value['email'],
                    $opcion,
                    "DT_RowId" => $value['idUsuario']
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

    public function add_usuario_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        //--- Validamos post ---//
        if ($_POST) {

            //--- Obtencion de los datos ---//
            $nombre = $this->input->post('nombrePersona', true); //
            $apellido = $this->input->post('apellidoPersona', true);//
            $nombreUsuario = $this->input->post('nombreUsuarioPersona', true);//
            $password = $this->input->post('psw', true);//
            $email = $this->input->post('emailUsuario', true);//
            $provincia = $this->input->post('selectProvincia', true);//
            $localidad = $this->input->post('selectLocalidad', true);//
            $direccion = $this->input->post('direccionPersona', true);//
            $nivel = $this->input->post('selectNivelUsuarioAgregar', true);//
            $idGenUsuario = $this->generarID();

            //--- Validacion de los datos ---//


                //--- Verificamos que no exista ese usuario registrado previamente ---//
                $existe_usuario = $this->app_model_usuario->get_usuario_byUsuario($nombreUsuario);

                if (!$existe_usuario) {

                    //--- Agregamos el usuario a la BD ---//
                    $result = $this->app_model_usuario->add_usuario($nombre, $apellido, $nombreUsuario, $password, $email, $idGenUsuario, $nivel, $provincia,$localidad, $direccion);

                    //--- Obtencio del usuario registrado mas arriba ---//
                    $usuario_agregado = $this->app_model_usuario->get_usuario_byIdGen($idGenUsuario);

                    //--- Validamos si se tienen los datos y el registro realizado correctamente ---//
                    if ($result && $usuario_agregado) {
                        $msg = "Usuario insertado con exito";
                        $dato = array("valid" => true, "msg" => $msg, "usuario" => $usuario_agregado);
                    } else {
                        $msg = "Error al insertar el usuario, vuelva a intentarlo";
                        $dato = array("valid" => false, "msg" => $msg);
                    }
                } else {
                    $msg = "Usuario existente, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }

        } else {

            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function modificar_usuario_post() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        //--- Validamos si tenemos post ---//
        if ($_POST) {

            //--- Datos obtenidos ---//
            $id = $this->input->post('idUsuarioModificar', true);
            $nombre = $this->input->post('nombrePersonaModificar', true);
            $apellido = $this->input->post('apellidoPersonaModificar', true);
            $nombreUsuario = $this->input->post('nombreUsuarioPersonaModificar', true);
            $password = $this->input->post('psw', true);
            $email = $this->input->post('emailUsuarioModificar', true);
            //$telefono = $this->input->post('telefonoPersonaModificar', true);
            $provincia = $this->input->post('selectProvinciaModificar', true);
            $localidad = $this->input->post('selectLocalidadModificar', true);
            $direccion = $this->input->post('direccionPersonaModificar', true);
            $nivel = $this->input->post('selectNivelUsuarioModificar', true);

            //--- Validamos los datos obtenidos desde la vista ---//
                //--- Actualizamos los datos de los usuarios ---//
                $result = $this->app_model_usuario->update_usuario($id, $nombre, $apellido, $nombreUsuario,$password, $email, $direccion, $nivel,$localidad,$provincia);

                if ($result) {
                    $usuario_editado = $this->app_model_usuario->get_usuario_byId($id);
                    $msg = "Se modificó el usuario con exito";
                    $dato = array("valid" => true, "msg" => $msg, "usuario" => $usuario_editado);
                }else {
                    $msg = "No se pudo modificar el usuario con exito";
                    $dato = array("valid" => false, "msg" => $msg);
                }

        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function eliminar_usuario() {
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');

        //--- Obtenemos los datos ---//
        $idUsuario = $this->input->post('idUsuario', true);
        $msg = "";

        //--- validamos la existencia de los datos ---//
        if (!empty($idUsuario)) {

            //--- Eliminamos el usuario ---//
            $result = $this->app_model_usuario->delete_usuario_by_idUsuario($idUsuario);

            //--- Validamos la eliminacion si fue exitosa ---//
            if ($result) {
                $msg = "Usuario eliminado con exito";
                $dato = array("valid" => true, "msg" => $msg);
            } else {
                $msg = "Error al eliminar el usuario, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

    public function get_usuario_byId() {

        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Credentials: true');
        $msg = "";

        if ($_POST) {

            $id = $this->input->post('id', true);

            if (!empty($id)) {
                $result = $this->app_model_usuario->get_usuario_byId($id);

                if ($result) {
                    $msg = "Datos obtenidos con exito";
                    $dato = array("valid" => true, "msg" => $msg, "usuario" => $result);
                } else {
                    $msg = "Error al obtener los datos del usuario, vuelva a intentarlo";
                    $dato = array("valid" => false, "msg" => $msg);
                }
            } else {
                $msg = "Datos vacios, vuelva a intentarlo";
                $dato = array("valid" => false, "msg" => $msg);
            }
        } else {
            $msg = "Error de sistema. Contacte con el Administrador.";
            $dato = array("valid" => false, "msg" => $msg);
        }

        echo json_encode($dato);
    }

}
