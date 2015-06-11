<?php defined('BASEPATH') or die('No direct script access allowed');

class Userlookup{

    var $hook;

    public function auth()
    {
        $this->hook =& get_instance();

        $session     = $this->hook->session->userdata('identity');
        $activeClass = $this->hook->router->fetch_class();

        if(empty($session)) {
            if($this->hook->uri->segment(1) == 'idec' && $activeClass == 'home') {

            } else {
                redirect('idec');
            }
        }
    }
} 