<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model_usuario extends CI_Model {
    /**
     * Comparacion de contraseña
     *
     * @param [type] $user
     * @param [type] $password
     * @return void
     */
    public function compare_user_password($user, $password) {
        $values = array(
            'usuario' => $user,
            'password' => $password
        );
        $this->db->where($values);
        $result = $this->db->get('usuarios');
        return ($result != '') ? $result->result_array() : false;
    }

    /**
     * New usuario
     *
     * @param [type] $nombre
     * @param [type] $apellido
     * @param [type] $nombreUsuario
     * @param [type] $password
     * @param [type] $email
     * @param [type] $idGenUsuario
     * @param [type] $nivel
     * @param [type] $provincia
     * @param [type] $localidad
     * @param [type] $direccion
     * @return void
     */
    public function add_usuario($nombre, $apellido, $nombreUsuario, $password, $email, $idGenUsuario, $nivel, $provincia,$localidad, $direccion) {
        $values = array(
            'email' => $email,
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'idGenUsuario' => $idGenUsuario,
            'idNivel' => $nivel,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'direccion' => $direccion,
            'eliminado' => 0
        );
        $result = $this->db->insert('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenemos los estados
     *
     * @return void
     */
    public function get_estados() {
      $this->db->select('*');
      $this->db->from('estados');
      $result = $this->db->get();
      return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Agregarmos el historial de session
     *
     * @param [type] $idUser
     * @param [type] $nombreUser
     * @param [type] $idNivel
     * @return void
     */
    public function set_log_usuario($idUser, $nombreUser, $idNivel) {
        $values = array(
            'idUsuarioLog' => $idUser,
            'usuarioLog' => $nombreUser,
            'idNivel' => $idNivel
        );
        $result = $this->db->insert('session_logs', $values);
    }

    /**
     * Obtenemos los usuarios
     *
     * @param [type] $idUsuario
     * @return void
     */
    public function get_usuario_info($idUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->get();
        return $result->result_array();
    }

    /**
     * Obtenemos los datos del usuario segun su idUsuario
     *
     * @param [type] $idUsuario
     * @return void
     */
    public function get_usuario_byId($idUsuario) {
        $this->db->select('
            idUsuario,
            nombreCompleto,
            apellido,
            usuario,
            password,
            email,
            idProvincia,
            idLocalidad,
            direccion,
            idNivel
        ');
        $this->db->from('usuarios');
        $this->db->where('usuarios.eliminado', 0);
        $this->db->where('usuarios.idUsuario', $idUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los datos del usuario segun su idGenUsuario
     *
     * @param [type] $idGenUsuario
     * @return void
     */
    public function get_usuario_byIdGen($idGenUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('eliminado', 0);
        $this->db->where('idGenUsuario', $idGenUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos los datos del usuario segun su nombre
     *
     * @param [type] $nombreUsuario
     * @return void
     */
    public function get_usuario_byUsuario($nombreUsuario) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('eliminado', 0);
        $this->db->where('usuario', $nombreUsuario);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? true : false;
    }

    /**
     * Eliminamos el usuario
     *
     * @param [type] $idUsuario
     * @return void
     */
    public function delete_usuario_by_idUsuario($idUsuario) {

        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idUsuario', $idUsuario);
        $result = $this->db->update('usuarios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Actualizamos el usuarios
     *
     * @param [type] $id
     * @param [type] $nombre
     * @param [type] $apellido
     * @param [type] $nombreUsuario
     * @param [type] $password
     * @param [type] $email
     * @param [type] $direccion
     * @param [type] $nivel
     * @param [type] $localidad
     * @param [type] $provincia
     * @return void
     */
    public function update_usuario($id, $nombre, $apellido, $nombreUsuario,$password, $email, $direccion, $nivel,$localidad,$provincia) {
        $values = array(
            'nombreCompleto' => $nombre,
            'apellido' => $apellido,
            'usuario' => $nombreUsuario,
            'password' => $password,
            'email' => $email,

            'eliminado' => 0,
            'idProvincia' => $provincia,
            'idLocalidad' => $localidad,
            'direccion' => $direccion,
            'idNivel' => $nivel
        );
        $this->db->where('idUsuario', $id);
        $this->db->update('usuarios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenemos los usuarios
     *
     * @return void
     */
    public function get_usuarios() {
        $this->db->select('
            idUsuario,
            nombreCompleto,
            apellido,
            usuario,
            password,
            usuarios.eliminado,
            email
        ');
        $this->db->from('usuarios');
        $this->db->where('usuarios.eliminado', 0);
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}