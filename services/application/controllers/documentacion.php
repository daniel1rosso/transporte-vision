<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documentacion extends MY_Controller {

    protected $data = array(
        'active' => 'documentacion'
    );

    public function listar_documentacion() {
        $this->load_view('documentacion/listar_documentacion', $this->data);
    }


}

?>
