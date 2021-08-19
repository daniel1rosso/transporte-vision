<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model extends CI_Model {
    /**
     * Obtencion de los niveles del sistema
     *
     * @return void
     */
    public function get_niveles() {
        $this->db->from('niveles');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos las provincias
     *
     * @return void
     */
    public function get_provincias() {
      $this->db->select(
        '
        idProvincia,
        nombre
        '
      );
        $this->db->from('provincias');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    /**
     * Obtenemos los estados
     *
     * @return void
     */
    public function get_estados() {
      $this->db->select(
        '
        idEstado,
        nombre
        '
      );
        $this->db->from('estados');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    /**
     * Obtenemos las localidades
     *
     * @return void
     */
    public function get_localidades() {
      $this->db->select(
        '
        idLocalidad,
        nombre
        '
      );
        $this->db->from('localidades');
        $this->db->order_by('nombre', 'ASC');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
    /**
     * Obtenemos las localidades segun el id de provincia
     *
     * @return void
     */
    public function get_localidadesById($idProvincia) {
      $this->db->select(
        '
        idLocalidad,
        nombre
        '
      );
        $this->db->from('localidades');
        $this->db->where('idProvincia', $idProvincia);
        $this->db->order_by('nombre', 'ASC');
        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }
}
