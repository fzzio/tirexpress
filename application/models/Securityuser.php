<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class SecurityUser extends CI_Model {

        var $usuario = "";
        var $password = "";
        var $password_anterior = "";
        var $nombre = "";
        var $correo = "";
        var $fecha_creacion = "";
        var $fecha_modificacion = "";
        var $estado = "";        
        
        function __construct() {
            parent::__construct();
            $this->load->database();
            $this->load->library('session');
        }       

        function login( $email, $password ){
            $usuario = $this->db->get_where("tb_user", array('email'=> $email , 'password' => md5($password) ))->row();            
            if( $usuario != null ){
                $dataUser = array("email" => $usuario->email, "name" => $usuario->full_name, "id" => $usuario->id_user ); 
                $this->session->set_userdata( $dataUser );
                return true;
            }
        }
        function logout(){
            $this->session->sess_destroy();
        }

    }
?>
