<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function index() {
        $data['user'] = false;
        $data['password'] = false;

        redirect('/');
    }

    public function login() {

      $msg = "";

      if ($_POST) {

        $user = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        if (empty($user) || empty($password)) {
            $data['user'] = (empty($user)) ? null : $user;
            $data['password'] = (empty($password)) ? null : $password;
            $dato = array("valid" => false, msg=>"Campos vacios");

        } else {
            $result = $this->app_model_usuario->compare_user_password($user, md5($password));
            if ($result) {
                $user_session = array(
                    'idUsuario' => $result[0]['idUsuario'],
                    'apellido' => $result[0]['apellido'],
                    'nombreCompleto' => $result[0]['nombreCompleto'],
                    'email' => $result[0]['email'],
                    'usuario' => $result[0]['usuario'],
                    'idNivel' => $result[0]['idNivel'],
                    'logged_in' => true

                );

                $this->app_model_usuario->set_log_usuario($user_session['idUsuario'], $user_session['nombreCompleto'] . ' ' . $user_session['apellido'], $user_session['idNivel']);

                $this->session->set_userdata($user_session);
                $this->userdata = $user_session;

                $dato = array("valid" => true);
                //redirect('/dashboard');
                //redirect('/');
            } else {
                $data['user'] = $user;
                //$this->load_view('login', $data);

                $dato = array("valid" => false);
            }

        }
    }else{

    }
    echo json_encode($dato);
  }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }



}
