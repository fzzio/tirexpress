<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

    public function __construct() {
        ob_start();
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('securityuser');
        $this->load->library('grocery_CRUD');
        $this->load->library('Mobile_Detect');
        date_default_timezone_set("America/Guayaquil");
        
    }

    public function index() {
        $debug = false;
        
        if ($this->securityCheck()) {
            $titulo = "Inicio";

            $dataHeader['titlePage'] = $titulo;
            $dataContent['debug'] = $debug;

            $data['header'] = $this->load->view('backend/header', $dataHeader);
            $data['menu'] = $this->load->view('backend/menu-admin', array() );

            $data['content'] = $this->load->view('backend/index', array() );
            $data['footer'] = $this->load->view('backend/footer-template', array() );
        } else {
            redirect("backend/logout");
        }
    }

    public function login() {
        $debug = false;

        $dataHeader['titlePage'] = 'Inicio Admin';
        $dataContent['debug'] = $debug;
        $data['header'] = $this->load->view('backend/header', $dataHeader);
        $data['content'] = $this->load->view('backend/login', $dataContent);
        $data['footer'] = $this->load->view('backend/footer-template', array());
    }

    public function logout() {

        $securityUser = new SecurityUser();
        $securityUser->logout();
        $debug = false;

        $dataHeader['titlePage'] = 'Inicio Admin';
        $dataContent['debug'] = $debug;

        $data['header'] = $this->load->view('backend/header', $dataHeader);
        $data['content'] = $this->load->view('backend/login', $dataContent);
        $data['footer'] = $this->load->view('backend/footer-template', array());
    }

    public function autentificar() {
        $email = $this->input->post("email");
        $password = $this->input->post("password");

        $securityUser = new SecurityUser();
        $securityUser->login($email, $password);

        if ( $this->session->userdata('email') != "") {
            redirect("backend/index");
        }else{
            redirect("backend/logout");
        }
    }
    
    function securityCheck() {
        $email = $this->session->userdata('email');
        if ($email != "") {
            return true;
        } else {
            return false;
        }   
    }

    function _add_default_date_value(){
        $value = !empty($value) ? $value : date("d/m/Y");
        $return = '<input type="text" name="date" value="'.$value.'" class="datepicker-input" /> ';
        $return .= '<a class="datepicker-input-clear" tabindex="-1">Clear</a> (dd/mm/yyyy)';
        return $return;
    }

    function encrypt_pw($post_array) {
        if(!empty($post_array['password'])) {
            $post_array['password'] = md5($_POST['password']);
        }
        return $post_array;
    }

    
    //////////////////////////////////////////////////////////////
    // Mantenimientos
    //////////////////////////////////////////////////////////////
    public function usuario(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Auth";
            
            $crud = new grocery_CRUD();
            $crud->set_table("auth");
            $crud->set_subject( $titulo );

            $crud->display_as( 'email' , 'Email' );
            $crud->display_as( 'user' , 'Nombre de usuario' );
            $crud->display_as( 'password' , 'Contraseña' );
            $crud->display_as( 'fecha_registro' , 'Registro' );
            $crud->display_as( 'id_rol' , 'Rol' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->set_relation('id_rol', 'rol', 'nombre');            
            $crud->field_type('estado', 'dropdown', array(
                '0' => 'Inactivo',
                '1' => 'Activo',
            ));

            $crud->change_field_type('password','password');

            $crud->callback_before_insert(array($this,'encrypt_pw'));
            $crud->callback_before_update(array($this,'encrypt_pw'));

            $crud->columns( 'email', 'user', 'fecha_registro', 'id_rol', 'estado' );
            $crud->fields( 'email', 'user', 'password', 'fecha_registro', 'id_rol', 'estado' );
            $crud->required_fields( 'email', 'user', 'id_rol', 'estado' );

            $crud->unset_export();
            $crud->unset_print();

            $output = $crud->render();

            $dataHeader['titlePage'] = $titulo;
            $dataHeader['css_files'] = $output->css_files;
            $dataFooter['js_files'] = $output->js_files;

            
            $data['header'] = $this->load->view('backend/header', $dataHeader);
            $data['menu'] = $this->load->view('backend/menu-admin', $dataHeader );

            $data['content'] = $this->load->view('backend/blank', $output);
            $data['footer'] = $this->load->view('backend/footer-grocerycrud', $dataFooter);
        } else {
            redirect("backend/logout");
        }
    }

    public function encuesta(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Encuesta";
            
            $crud = new grocery_CRUD();
            $crud->set_table("encuesta");
            $crud->set_subject( $titulo );

            $crud->display_as( 'id_usuario' , 'Email' );
            $crud->display_as( 'id_auth' , 'User' );
            // $crud->display_as( 'num_encuesta' , '# Encuesta' );
            $crud->display_as( 'direccion' , 'Dirección' );
            //$crud->display_as( 'parroquia' , 'Parroquia' );
            $crud->display_as( 'vivienda' , 'Vivienda' );
            $crud->display_as( 'laboral' , 'Situación laboral' );
            $crud->display_as( 'quiere_casa' , '¿Quiere casa propia?' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->field_type('estado', 'dropdown', array(
                '0' => 'Inactivo',
                '1' => 'Activo',
            ));

            $crud->field_type('quiere_casa', 'dropdown', array(
                '0' => 'No',
                '1' => 'Sí',
            ));

            $crud->set_relation('id_auth', 'auth', 'user');
            $crud->set_relation('id_usuario', 'usuarios', 'email');

            $crud->columns( 'id_usuario', 'id_auth'/*, 'num_encuesta'*/, 'direccion', /*'parroquia',*/ 'vivienda', 'laboral', 'quiere_casa', 'estado' );
            $crud->fields( 'id_usuario', 'id_auth'/*, 'num_encuesta'*/, 'direccion', /*'parroquia',*/ 'vivienda', 'laboral', 'quiere_casa', 'estado' );
            $crud->required_fields( 'id_usuario', 'id_auth'/*, 'num_encuesta'*/, 'direccion', /*'parroquia',*/ 'vivienda', 'laboral', 'quiere_casa', 'estado' );

            $state = $crud->getState();
            if($state == 'edit'){
                $crud->field_type('id_usuario', 'readonly');
                $crud->field_type('id_auth', 'readonly');
            }

            //$crud->unset_export();
            $crud->unset_print();
            $crud->unset_clone();
            $crud->unset_read();

            $output = $crud->render();

            $dataHeader['titlePage'] = $titulo;
            $dataHeader['css_files'] = $output->css_files;
            $dataFooter['js_files'] = $output->js_files;

            
            $data['header'] = $this->load->view('backend/header', $dataHeader);
            $data['menu'] = $this->load->view('backend/menu-admin', $dataHeader );

            $data['content'] = $this->load->view('backend/blank', $output);
            $data['footer'] = $this->load->view('backend/footer-grocerycrud', $dataFooter);
        } else {
            redirect("backend/logout");
        }
    }
    public function listado_encuestados(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Encuestados";
            
            $crud = new grocery_CRUD();
            $crud->set_table("usuarios");
            $crud->set_subject( $titulo );

            $crud->display_as( 'id_usuario' , 'Usuario' );
           

            $crud->display_as( 'primer_nombre' , 'Primer nombre' );
            $crud->display_as( 'segundo_nombre' , 'Segundo nombre' );
            $crud->display_as( 'primer_apellido' , 'Primer apellido' );
            $crud->display_as( 'segundo_apellido' , 'Segundo apellido' );
            $crud->display_as( 'cedula' , 'C.I' );
            $crud->display_as( 'sector' , 'Sector' );
            $crud->display_as( 'sector_vota' , 'Padron electoral' );
            $crud->display_as( 'email' , 'e-mail' );
            // $crud->display_as( 'telefono' , 'Telefono' );
            $crud->display_as( 'celular' , 'Movil' );
            $crud->display_as( 'fecha_nacimiento' , 'Rango edad' );
            $crud->display_as( 'sexo' , 'Sexo' );
            $crud->display_as( 'direccion' , 'Direccion' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->field_type('estado', 'dropdown', array(
                '0' => 'Inactivo',
                '1' => 'Activo',
            ));

            $crud->field_type('sector', 'dropdown', array(
                '1' => 'Norte',
                '2' => 'Centro',
                '3' => 'Sur',
            ));

            $crud->set_relation('id_usuario', 'auth', 'user');

            $crud->columns('id_usuario', 'cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'sector_vota', 'email'/*, 'telefono'*/, 'celular', 'fecha_nacimiento', 'sexo', 'direccion' , 'estado' );
            $crud->fields( 'id_usuario', 'cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'sector_vota', 'email'/*, 'telefono'*/, 'celular', 'fecha_nacimiento', 'sexo', 'direccion' , 'estado' );
            
            // $crud->required_fields( 'id_usuario',  'estado' );
            $crud->required_fields( 'id_usuario', 'cedula', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'sector_vota', 'email'/*, 'telefono'*/, 'celular', 'fecha_nacimiento', 'sexo', 'direccion' , 'estado' );

            $state = $crud->getState();
            if($state == 'edit'){
                $crud->field_type('id_usuario', 'readonly');
            }

            //$crud->unset_export();
            $crud->unset_print();
            $crud->unset_clone();
            $crud->unset_read();

            $output = $crud->render();

            $dataHeader['titlePage'] = $titulo;
            $dataHeader['css_files'] = $output->css_files;
            $dataFooter['js_files'] = $output->js_files;

            
            $data['header'] = $this->load->view('backend/header', $dataHeader);
            $data['menu'] = $this->load->view('backend/menu-admin', $dataHeader );

            $data['content'] = $this->load->view('backend/blank', $output);
            $data['footer'] = $this->load->view('backend/footer-grocerycrud', $dataFooter);
        } else {
            redirect("backend/logout");
        }
    }

    public function total_encuestas(){
        if ($this->securityCheck()) {
            $titulo = "Encuestados";
            
            $crud = new grocery_CRUD();
            $crud->set_table("encuesta_view");
            $crud->set_primary_key('id');
            $crud->set_subject( $titulo );

            $crud->display_as( 'id' , 'ID' );
            $crud->display_as( 'cedula' , 'C.I' );
            $crud->display_as( 'user' , 'Usuario' );
            $crud->display_as( 'primer_nombre' , 'Primer nombre' );
            $crud->display_as( 'segundo_nombre' , 'Segundo nombre' );
            $crud->display_as( 'primer_apellido' , 'Primer apellido' );
            $crud->display_as( 'segundo_apellido' , 'Segundo apellido' );
            $crud->display_as( 'sector_vota' , 'Parroquia' );
            $crud->display_as( 'email' , 'E-mail' );
            $crud->display_as( 'celular' , 'Movil' );
            $crud->display_as( 'rango_edad' , 'Rango de edad' );
            $crud->display_as( 'sexo' , 'Sexo' );
            //$crud->display_as( 'ocupacion' , 'Ocupación' );
            $crud->display_as( 'direccion' , 'Dirección' );
            $crud->display_as( 'num_encuesta' , '# Encuesta' );
            $crud->display_as( 'tipo_vivienda' , 'Tipo de Vivienda' );
            $crud->display_as( 'estado_laboral' , 'Situación laboral' );
            $crud->display_as( 'quiere_casa' , '¿Quiere casa propia?' );
            $crud->display_as( 'origen' , 'Origen' );
           

            //$crud->unset_export();
            //$crud->unset_print();
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();

            $output = $crud->render();

            $dataHeader['titlePage'] = $titulo;
            $dataHeader['css_files'] = $output->css_files;
            $dataFooter['js_files'] = $output->js_files;

            
            $data['header'] = $this->load->view('backend/header', $dataHeader);
            $data['menu'] = $this->load->view('backend/menu-admin', $dataHeader );

            $data['content'] = $this->load->view('backend/blank', $output);
            $data['footer'] = $this->load->view('backend/footer-grocerycrud', $dataFooter);
        } else {
            redirect("backend/logout");
        }
    }




/////:::::SLUGIFEANDO - url amigable:::::::::::////////
    public function slugify($text)
        { 
      // replace non letter or digits by -
          $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
          $text = trim($text, '-');

      // transliterate
          $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
          $text = strtolower($text);

      // remove unwanted characters
          $text = preg_replace('~[^-\w]+~', '', $text);

          if (empty($text))
          {
            return 'n-a';
        }

        return $text;
    }
    function insert_slug_callback($post_array)
    {
        $slug=$post_array['slug'];
        //$titulo=$post_array['nombre'];
     //$id=$post_array['id_categoria'];
     $titulo="a";
     $slug="".$titulo;
     $post_array['slug'] = $this->slugify($slug);
     $post_array['slug'] = $this->slugify($post_array['slug']);
        // $this->db->insert('slug',$slug);

        return true;
    }
    function create_slug_callback($post_array) {
      // $this->load->library('encrypt');
      // $key = 'super-secret-key';
     $titulo=$post_array['nombre'];
     $id=$post_array['id_categoria'];
     $slug=$id."/".$titulo;
     // $slug=$titulo.strval($id);
     $post_array['slug'] = $this->slugify($slug);
     $post_array['slug'] = $this->slugify($post_array['slug']);

     return $post_array;
    } 
    function update_slug_callback($post_array) {
      // $this->load->library('encrypt');
      // $key = 'super-secret-key';
     $titulo=$post_array['nombre'];
     $id=$post_array['id_categoria'];
     $slug=$id."/".$titulo;
     $post_array['slug'] = $this->slugify($slug);
     $post_array['slug'] = $this->slugify($post_array['slug']);

     return $post_array;
    } 


    ///////////////////////
    // Slug dinámico
    ///////////////////////
    
    function create_slug_dinamico_callback($post_array) {
        $id=$post_array['id_dinamico'];
        $titulo=$post_array['titulo'];
        $slug=strval($id)."-".$titulo;
        $post_array['slug'] = $this->slugify($slug);
        $post_array['slug'] = $this->slugify($post_array['slug']);

        return $post_array;
    }
    function insert_slug_dinamico_callback($post_array)
    {
        $idInsertado = $this->db->insert_id();
        $titulo=$post_array['titulo'];
        $slug=strval($idInsertado)."-".$titulo;

        $post_array['id_dinamico'] = $idInsertado;
        $post_array['slug'] = $this->slugify($slug);
        $post_array['slug'] = $this->slugify($post_array['slug']);

        $data = array(
           'slug' => $post_array['slug']
        );

        $this->db->update('dinamico', $data, array('id_dinamico' => $idInsertado) ); 

        return true;
    }
    function update_slug_dinamico_callback($post_array) {
        $id=$post_array['id_dinamico'];
        $titulo=$post_array['titulo'];
        $slug=strval($id)."-".$titulo;
        $post_array['slug'] = $this->slugify($slug);
        $post_array['slug'] = $this->slugify($post_array['slug']);

        return $post_array;
    } 


/////:::::SLUGIFEANDO - url amigable:::::::::::////////






    //////////////////////////////////////////////////////////////
    // Controladores
    //////////////////////////////////////////////////////////////

    


}

/* End of file Backend.php */
/* Location: ./application/controllers/Backend.php */
