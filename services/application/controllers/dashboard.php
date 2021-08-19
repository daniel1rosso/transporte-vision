<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {
    protected $data = array(
        'active' => 'dashboard'
    );

    public function index() {
        $this->force_off_ssl();

        $userdata = $this->session->all_userdata();
        if (!empty($userdata)) {
            if(!empty($userdata['nombreCompleto'])){
                $this->data['saludoDia'] = $this->saludoDia($userdata['nombreCompleto']);

            }
        }



        $this->load_view('dashboard', $this->data);
    }

    public function saludoDia($apellidoUsuario) {
	$date = date ("H");

	if ($date <= 12 AND $date >= 06){
            $saludo = '
                <i id="iconClima" class="wi wi-day-sunny"></i>
                &#161;Buen d&iacute;a, '.$apellidoUsuario.'&#33;
            ';
	}else if ($date < 20 AND $date > 12 ){
            $saludo = '
                <i id="iconClima" class="wi wi-day-sunny"></i>
                &#161;Buenas tardes, '.$apellidoUsuario.'&#33;
            ';
	}else{
            $saludo = '
                <i id="iconClima" class="wi wi-night-alt-cloudy"></i>
                &#161;Buenas noches, '.$apellidoUsuario.'&#33;
            ';
	}

	return $saludo;
    }

    

    public function time_passed($timestamp_bd){
        $timestamp = strtotime($timestamp_bd);
        $diff = time() - (int)$timestamp;

        if($diff < 20)                                     { $return = 'Ahora mismo';                                            }
        else if($diff >= 20 AND $diff < 60)             { $return = sprintf('Hace %s segundos'    , $diff);                    }
        else if($diff >= 60 AND $diff < 120)            { $return = sprintf('Hace %s minuto'    , floor($diff/60));            }
        else if($diff >= 120 AND $diff < 3600)            { $return = sprintf('Hace %s minutos'    , floor($diff/60));            }
        else if($diff >= 3600 AND $diff < 7200)            { $return = sprintf('Hace %s hora'        , floor($diff/3600));        }
        else if($diff >= 7200 AND $diff < 86400)        { $return = sprintf('Hace %s horas'    , floor($diff/3600));        }
        else if($diff >= 86400 AND $diff < 172800)        { $return = sprintf('Hace %s dia'        , floor($diff/86400));        }
        else if($diff >= 172800 AND $diff < 604800)        { $return = sprintf('Hace %s dias'        , floor($diff/86400));        }
        else if($diff >= 604800 AND $diff < 1209600)    { $return = sprintf('Hace %s semana'    , floor($diff/604800));        }
        else if($diff >= 1209600 AND $diff < 2629744)    { $return = sprintf('Hace %s semanas'    , floor($diff/604800));        }
        else if($diff >= 2629744 AND $diff < 5259488)    { $return = sprintf('Hace %s mes'        , floor($diff/2629744));    }
        else if($diff >= 5259488 AND $diff < 31556926)    { $return = sprintf('Hace %s meses'    , floor($diff/2629744));    }
        else if($diff >= 31556926 AND $diff < 63113852)    { $return = sprintf('Hace %s a&ntilde;o'        , floor($diff/31556926));    }
        else if($diff >= 63113852)                        { $return = sprintf('Hace %s a&ntilde;os'        , floor($diff/31556926));    }
        else                                             { $return = date('H:i:s d/m/Y', $timestamp);                        }

        return $return;
    }

    public function force_off_ssl() {
        if($_SERVER['SERVER_PORT'] == '443') {
            $url = "http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            redirect($url);
            exit;
        }
    }
}
