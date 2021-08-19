<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class App_model_envio extends CI_Model {

    /**
     * New envio
     *
     * @param [type] $nombreCliente
     * @param [type] $nombreReceptor
     * @param [type] $nroRemito
     * @param [type] $cantidad
     * @param [type] $provinciaRetiro
     * @param [type] $localidadRetiro
     * @param [type] $fechaEnvio
     * @param [type] $estado
     * @param [type] $fechaEntrega
     * @param [type] $provinciaDestino
     * @param [type] $localidadDestino
     * @param [type] $observacion
     * @return void
     */
    public function add_envio($idCliente,$nombreReceptor,$nroRemito,$cantidad,$provinciaRetiro,$localidadRetiro,$fechaEnvio,$estado,$fechaEntrega,$provinciaDestino,$localidadDestino,$observacion) {
        $values = array(
          'idCliente' =>$idCliente,
          'nombreReceptor' =>$nombreReceptor,
          'nroRemito' => $nroRemito,
          'cantidad'=>$cantidad,
          'idProvinciaRetiro' =>$provinciaRetiro,
          'idLocalidadRetiro'=> $localidadRetiro,
          'fechaEnvio' =>$fechaEnvio,
          'idEstado' => $estado,
          'fechaEntrega' =>$fechaEntrega,
          'idProvinciaDestino' => $provinciaDestino,
          'idLocalidadDestino' =>$localidadDestino,
          'observaciones' => $observacion,
          'eliminado' => 0
        );
        $result = $this->db->insert('envios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Obtenemos todos los envios
     *
     * @return void
     */
    public function get_envios() {
        $this->db->select('e.idEnvio, e.nroRemito, e.nombreReceptor, usuarios.nombreCompleto as nombreCliente, e.fechaEnvio, e.fechaEntrega, e.idEstado, e.observaciones, e.cantidad, estados.nombre as nombreEstado, lr.nombre as localidadRetiro, pr.nombre as provinciaRetiro, ld.nombre as localidadDestino, pd.nombre as provinciaDestino, e.idCliente, e.remito, e.conforme');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'ASC');
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtenemos el envio segun el idRemitente
     *
     * @param [type] $idRemitente
     * @return void
     */
    public function get_envio_by_idRemitente($idRemitente) {
        $this->db->select('e.idEnvio, e.nroRemito, e.nombreReceptor, usuarios.nombreCompleto as nombreCliente, e.fechaEnvio, e.fechaEntrega, e.idEstado, e.observaciones, e.cantidad, estados.nombre as nombreEstado, lr.nombre as localidadRetiro, pr.nombre as provinciaRetiro, ld.nombre as localidadDestino, pd.nombre as provinciaDestino, e.idCliente');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'ASC');
        $this->db->where('e.idCliente', $idRemitente);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtener el envio correspondiente al idEnvio
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function get_envio_by_idEnvio($idEnvio) {
        $this->db->select('e.idEnvio, e.nroRemito, e.nombreReceptor, usuarios.nombreCompleto as nombreCliente, e.fechaEnvio, e.fechaEntrega, e.observaciones, e.cantidad, estados.nombre as nombreEstado, lr.nombre as localidadRetiro, pr.nombre as provinciaRetiro, ld.nombre as localidadDestino, pd.nombre as provinciaDestino, e.idCliente, e.idProvinciaRetiro, e.idLocalidadRetiro, e.idProvinciaDestino, e.idLocalidadDestino, e.idEstado, e.remito, e.conforme');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'ASC');
        $this->db->where('e.idEnvio', $idEnvio);
        $this->db->where('e.eliminado', 0);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Obtener el ultimo envio
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function get_ultimo_envio() {
        $this->db->select('e.idEnvio, e.nroRemito, e.nombreReceptor, usuarios.nombreCompleto as nombreCliente, e.fechaEnvio, e.fechaEntrega, e.idEstado, e.observaciones, e.cantidad, estados.nombre as nombreEstado, lr.nombre as localidadRetiro, pr.nombre as provinciaRetiro, ld.nombre as localidadDestino, pd.nombre as provinciaDestino, e.idCliente');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'DESC');
        $this->db->where('e.eliminado', 0);
        $this->db->limit(1);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Update envio con el nombre del remito
     *
     * @param [type] $idEnvio
     * @param [type] $remito
     * @return void
     */
    public function update_remito_envio($idEnvio, $remito)
    {
        $values = array(
            'remito' => $remito
        );
        $this->db->where('idEnvio', $idEnvio);
        $this->db->where('eliminado', 0);
        $result = $this->db->update('envios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Update envio con el nombre del conforme
     *
     * @param [type] $idEnvio
     * @param [type] $conforme
     * @return void
     */
    public function update_conforme_envio($idEnvio, $conforme)
    {
        $values = array(
            'conforme' => $conforme
        );
        $this->db->where('idEnvio', $idEnvio);
        $this->db->where('eliminado', 0);
        $result = $this->db->update('envios', $values);
        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Update envio
     *
     * @param [type] $idEnvio
     * @param [type] $idCliente
     * @param [type] $nombreReceptor
     * @param [type] $nroRemito
     * @param [type] $cantidad
     * @param [type] $provinciaRetiro
     * @param [type] $localidadRetiro
     * @param [type] $fechaEnvio
     * @param [type] $estado
     * @param [type] $fechaEntrega
     * @param [type] $provinciaDestino
     * @param [type] $localidadDestino
     * @param [type] $observacion
     * @return void
     */
    public function update_envio($idEnvio,$idCliente,$nombreReceptor,$nroRemito,$cantidad,$provinciaRetiro,$localidadRetiro,$fechaEnvio,$estado,$fechaEntrega,$provinciaDestino,$localidadDestino,$observacion) {
        $values = array(
          'idCliente' =>$idCliente,
          'nombreReceptor' =>$nombreReceptor,
          'nroRemito' => $nroRemito,
          'cantidad'=>$cantidad,
          'idProvinciaRetiro' =>$provinciaRetiro,
          'idLocalidadRetiro'=> $localidadRetiro,
          'fechaEnvio' =>$fechaEnvio,
          'idEstado' => $estado,
          'fechaEntrega' =>$fechaEntrega,
          'idProvinciaDestino' => $provinciaDestino,
          'idLocalidadDestino' =>$localidadDestino,
          'observaciones' => $observacion
        );
        $this->db->where('idEnvio', $idEnvio);
        $result = $this->db->update('envios', $values);

        return (($this->db->affected_rows() > 0) ? true : false);
    }

    /**
     * Eliminamos el envio
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function delete_envio($idEnvio){
        $values = array(
            'eliminado' => 1
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambio de estado del envio a pendiente
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function set_envio_pendiente($idEnvio){
        $values = array(
            'idEstado' => 1
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambio de estado del envio a aceptado
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function set_envio_aceptado($idEnvio){
        $values = array(
            'idEstado' => 2
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambio de estado del envio a rechazado
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function set_envio_rechazado($idEnvio){
        $values = array(
            'idEstado' => 3
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambio de estado del envio a entregado
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function set_envio_entregado($idEnvio){
        $values = array(
            'idEstado' => 4
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }

    /**
     * Cambio de estado del envio a conformado
     *
     * @param [type] $idEnvio
     * @return void
     */
    public function set_envio_conformado($idEnvio){
        $values = array(
            'idEstado' => 5
        );

        $this->db->where('idEnvio', $idEnvio);
        $this->db->update('envios', $values);

        return ($this->db->affected_rows() > 0) ? true : false;
    }
    /**
     * Obtenemos el hash generado en el remito
     *
     * @return void
     */
    public function get_hash_remito($idEnvio) {
        $this->db->select('remito');
        $this->db->from('envios ');

        $this->db->where('eliminado', 0);
        $this->db->where('idEnvio', $idEnvio);

        $result = $this->db->get();

        return ($result->num_rows() > 0) ? $result->result_array() : false;
    }

    /**
     * Exportar envios
     */
    public function exportar_envios()
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Numero Remito';
        $fields[1]['name'] = 'Destinatario';
        $fields[2]['name'] = 'Remitente';
        $fields[3]['name'] = 'Localidad de Retiro';
        $fields[4]['name'] = 'Localidad de Entrega';
        $fields[5]['name'] = 'Fecha de Retiro';
        $fields[6]['name'] = 'Fecha de Entrega';
        $fields[7]['name'] = 'Cantidad de Bultos';
        $fields[8]['name'] = 'Observaciones';
        $fields[9]['name'] = 'Estado';

        $this->db->select('
                            e.nroRemito, 
                            e.nombreReceptor, 
                            usuarios.nombreCompleto as nombreCliente,
                            lr.nombre as localidadRetiro, 
                            ld.nombre as localidadDestino, 
                            e.fechaEnvio, 
                            e.fechaEntrega, 
                            e.cantidad,
                            e.observaciones,
                            estados.nombre as nombreEstado');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'ASC');
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }

    /**
     * Exportar envios para un cliente en particular
     */
    public function exportar_envios_by_idCliente($idCliente)
    {
        //--- cabeceras ---//
        $fields[0]['name'] = 'Numero Remito';
        $fields[1]['name'] = 'Destinatario';
        $fields[2]['name'] = 'Remitente';
        $fields[3]['name'] = 'Localidad de Retiro';
        $fields[4]['name'] = 'Localidad de Entrega';
        $fields[5]['name'] = 'Fecha de Retiro';
        $fields[6]['name'] = 'Fecha de Entrega';
        $fields[6]['name'] = 'Cantidad de Bultos';
        $fields[7]['name'] = 'Observaciones';
        $fields[8]['name'] = 'Estado';

        $this->db->select('
                            e.nroRemito, 
                            e.nombreReceptor, 
                            usuarios.nombreCompleto as nombreCliente,
                            lr.nombre as localidadRetiro, 
                            ld.nombre as localidadDestino, 
                            e.fechaEnvio, 
                            e.fechaEntrega, 
                            e.cantidad,
                            e.observaciones,
                            estados.nombre as nombreEstado');
        $this->db->from('envios as e');
        $this->db->join('usuarios', 'usuarios.idUsuario = e.idCliente');
        $this->db->join('localidades as lr', 'lr.idLocalidad = e.idLocalidadRetiro');
        $this->db->join('provincias as pr', 'pr.idProvincia = e.idProvinciaRetiro');
        $this->db->join('localidades as ld', 'ld.idLocalidad = e.idLocalidadDestino');
        $this->db->join('provincias as pd', 'pd.idProvincia = e.idProvinciaDestino');
        $this->db->join('estados', 'estados.idEstado = e.idEstado');
        $this->db->order_by('e.idEnvio', 'ASC');
        $this->db->where('e.idCliente', $idCliente);
        $this->db->where('e.eliminado', 0);
        $result = $this->db->get();

        return ($result != '') ? array("fields" => $fields, "query" => $result) : false;
    }


}
