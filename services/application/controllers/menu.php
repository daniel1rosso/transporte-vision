<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Dashboard extends MY_Controller {
      protected $data = array(
          'active' => 'menu'
      );

      public function index() {
          $this->force_off_ssl();

          $userdata = $this->session->all_userdata();
          if (!empty($userdata)) {
              if(!empty($userdata['nombreCompleto'])){

                  $this->data['permiso'] = $this->permiso($userdata['idNivel']);
              }
          }
          $this->load_view('menu', $this->data);
}
}
