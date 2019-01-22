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
    public function categorias(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Categoría";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_categorias");
            $crud->set_subject( $titulo );

            $crud->display_as( 'descripcion' , 'Descripción' );
            $crud->display_as( 'id_empresa' , 'Empresa' );
            $crud->display_as( 'usr_ingreso' , 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso' , 'Fecha Ingreso' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->set_relation('id_empresa', 'tb_empresas', 'razon_social');
            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->columns( 'descripcion', 'usr_ingreso', 'fec_ingreso', 'id_empresa', 'estado' );
            $crud->fields( 'descripcion', 'usr_ingreso', 'fec_ingreso', 'id_empresa', 'estado' );
            $crud->required_fields( 'descripcion', 'estado' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function ciudades(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Ciudad";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_ciudades");
            $crud->set_subject( $titulo );

            $crud->display_as( 'nombre' , 'nombre' );
            $crud->display_as( 'usr_ingreso' , 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso' , 'Fecha Ingreso' );
            $crud->display_as( 'iniciales' , 'Iniciales' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->columns( 'nombre', 'iniciales', 'usr_ingreso', 'fec_ingreso', 'estado' );
            $crud->fields( 'nombre', 'iniciales', 'usr_ingreso', 'fec_ingreso', 'estado' );
            $crud->required_fields( 'nombre', 'iniciales', 'usr_ingreso', 'fec_ingreso', 'estado' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function clientes(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Cliente";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_clientes");
            $crud->set_subject( $titulo );

            $crud->display_as( 'id_empresa' , 'Empresa' );
            $crud->display_as( 'razon_social' , 'Razón Social' );
            $crud->display_as( 'direccion' , 'Dirección' );
            $crud->display_as( 'telefono' , 'Teléfono' );
            $crud->display_as( 'ruc' , 'RUC' );
            $crud->display_as( 'id_ciudad' , 'Ciudad' );
            $crud->display_as( 'cupo_credito' , 'Cupo $' );
            $crud->display_as( 'id_vendedor' , 'Vendedor' );
            $crud->display_as( 'usr_ingreso' , 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso' , 'Fecha Ingreso' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->set_relation('id_empresa', 'tb_empresas', 'razon_social');
            $crud->set_relation('id_ciudad', 'tb_ciudades', 'nombre');
            $crud->set_relation('id_vendedor', 'tb_vendedores', 'nombres');

            $crud->columns( 'id_empresa', 'razon_social', 'direccion', 'telefono', 'ruc', 'id_ciudad', 'cupo_credito', 'id_vendedor', 'usr_ingreso', 'fec_ingreso', 'estado' );
            $crud->fields( 'id_empresa', 'razon_social', 'direccion', 'telefono', 'ruc', 'id_ciudad', 'cupo_credito', 'id_vendedor', 'usr_ingreso', 'fec_ingreso', 'estado' );
            $crud->required_fields( 'id_empresa', 'razon_social', 'direccion', 'ruc', 'estado' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function empresas(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Empresa";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_empresas");
            $crud->set_subject( $titulo );

            $crud->display_as( 'razon_social' , 'Razón Social' );
            $crud->display_as( 'direccion' , 'Dirección' );
            $crud->display_as( 'ruc' , 'RUC' );
            $crud->display_as( 'telefono' , 'Teléfono' );
            $crud->display_as( 'logo' , 'Logo' );
            $crud->display_as( 'estado' , 'Estado' );

            $crud->set_field_upload('logo', 'assets/uploads/empresas/logos');

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->columns( 'razon_social', 'direccion', 'ruc', 'telefono', 'logo', 'estado' );
            $crud->fields( 'razon_social', 'direccion', 'ruc', 'telefono', 'logo', 'estado' );
            $crud->required_fields( 'razon_social', 'direccion', 'ruc', 'telefono', 'logo', 'estado' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function productos(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Productos";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_productos");
            $crud->set_subject( $titulo );

            $crud->display_as( 'id_empresa', 'Empresa' );
            $crud->display_as( 'descripcion', 'Descripción' );
            $crud->display_as( 'id_categoria', 'Categoria' );
            $crud->display_as( 'precio_vta', 'Precio Venta' );
            $crud->display_as( 'costo', 'Costo' );
            $crud->display_as( 'por_promocion', 'Por Promoción' );
            $crud->display_as( 'estado', 'Estado' );
            $crud->display_as( 'destacado', 'Destacado' );
            $crud->display_as( 'usr_ingreso', 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso', 'Fecha Ingreso' );
            $crud->display_as( 'stock', 'Stock' );

            $crud->field_type('destacado', 'dropdown', array(
                'S' => 'Sí',
                'N' => 'No',
            ));
            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->set_relation('id_empresa', 'tb_empresas', 'razon_social');
            $crud->set_relation('id_categoria', 'tb_categorias', 'descripcion');

            $crud->columns( 'id_empresa', 'descripcion', 'id_categoria', 'precio_vta', 'costo', 'por_promocion', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'stock' );
            $crud->fields( 'id_empresa', 'descripcion', 'id_categoria', 'precio_vta', 'costo', 'por_promocion', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'stock' );
            $crud->required_fields( 'id_empresa', 'descripcion', 'id_categoria', 'precio_vta', 'costo', 'por_promocion', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'stock' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function descuentos(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Producto";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_tabla_descto");
            $crud->set_subject( $titulo );

            $crud->display_as( 'rango_desde', 'Rango desde' );
            $crud->display_as( 'rango_hasta', 'Rango Hasta' );
            $crud->display_as( 'porcentaje', 'Porcentaje' );
            $crud->display_as( 'estado', 'Estado' );
            $crud->display_as( 'usr_ingreso', 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso', 'Fecha Ingreso' );
            $crud->display_as( 'id_empresa', 'Empresa' );

            
            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->set_relation('id_empresa', 'tb_empresas', 'razon_social');

            $crud->columns( 'rango_desde', 'rango_hasta', 'porcentaje', 'estado', 'usr_ingreso', 'fec_ingreso', 'id_empresa' );
            $crud->fields( 'rango_desde', 'rango_hasta', 'porcentaje', 'estado', 'usr_ingreso', 'fec_ingreso', 'id_empresa' );
            $crud->required_fields( 'rango_desde', 'rango_hasta', 'porcentaje', 'estado', 'usr_ingreso', 'fec_ingreso' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    public function zonas(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Zona";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_zonas");
            $crud->set_subject( $titulo );

            $crud->display_as( 'descripcion', 'Descripción' );
            $crud->display_as( 'estado', 'Estado' );
            $crud->display_as( 'usr_ingreso', 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso', 'Fecha Ingreso' );

            
            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->columns( 'descripcion', 'estado', 'usr_ingreso', 'fec_ingreso' );
            $crud->fields( 'descripcion', 'estado', 'usr_ingreso', 'fec_ingreso' );
            $crud->required_fields( 'descripcion', 'estado', 'usr_ingreso', 'fec_ingreso' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

    //////////////////////////////////////////////////////////////
    // Pedidos
    //////////////////////////////////////////////////////////////

    public function pedidos(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Pedido";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_pedidos");
            $crud->set_subject( $titulo );

            $crud->display_as( 'fecha', 'Fecha' );
            $crud->display_as( 'id_vendedor', 'Vendedor' );
            $crud->display_as( 'id_cliente', 'cliente' );
            $crud->display_as( 'subtotal', 'Subtotal' );
            $crud->display_as( 'descuento', 'Descuento' );
            $crud->display_as( 'impuesto', 'Impuesto' );
            $crud->display_as( 'total', 'Total' );
            $crud->display_as( 'porc_descto', 'Porcentaje Descuento' );
            $crud->display_as( 'comentario', 'Comentario' );
            $crud->display_as( 'estado', 'Estado' );
            $crud->display_as( 'fecha_estado', 'Fecha Estado' );

            $crud->set_relation('id_vendedor', 'tb_vendedores', 'nombres');
            $crud->set_relation('id_cliente', 'tb_clientes', 'razon_social');

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Impago',
                'P' => 'Pagado',
            ));

            $crud->columns( 'fecha', 'id_vendedor', 'id_cliente', 'subtotal', 'descuento', 'impuesto', 'total', 'porc_descto', 'comentario', 'estado', 'fecha_estado' );
            $crud->fields( 'fecha', 'id_vendedor', 'id_cliente', 'subtotal', 'descuento', 'impuesto', 'total', 'porc_descto', 'comentario', 'estado', 'fecha_estado' );
            $crud->required_fields( 'fecha', 'id_vendedor', 'id_cliente', 'subtotal', 'descuento', 'impuesto', 'total', 'porc_descto',  'estado', 'fecha_estado' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
            $crud->unset_print();
            //$crud->unset_texteditor('descripcion','full_text');

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

    public function detalle_pedido(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Pedido Detalle";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_pedidos_det");
            $crud->set_subject( $titulo );

            $crud->display_as( 'id_pedido', 'Pedido' );
            $crud->display_as( 'secuencial', 'secuencial' );
            $crud->display_as( 'id_producto', 'Producto' );
            $crud->display_as( 'cantidad', 'Cantidad' );
            $crud->display_as( 'por_promocion', 'Por Promoción' );
            $crud->display_as( 'precio_vta', 'Precio de Venta' );

            $crud->set_relation('id_pedido', 'tb_pedidos', 'id_pedido');
            $crud->set_relation('id_producto', 'tb_productos', 'descripcion');

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Impago',
                'P' => 'Pagado',
            ));

            $crud->columns( 'id_pedido', 'secuencial', 'id_producto', 'cantidad', 'por_promocion', 'precio_vta' );
            $crud->fields( 'id_pedido', 'secuencial', 'id_producto', 'cantidad', 'por_promocion', 'precio_vta' );
            $crud->required_fields( 'id_pedido', 'secuencial', 'id_producto', 'cantidad', 'por_promocion', 'precio_vta' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
            $crud->unset_print();
            //$crud->unset_texteditor('descripcion','full_text');

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



    //////////////////////////////////////////////////////////////
    // Personal
    //////////////////////////////////////////////////////////////
    
    public function vendedores(){
        $debug = false;

        if ($this->securityCheck()) {
            $titulo = "Vendedor";
            
            $crud = new grocery_CRUD();
            $crud->set_table("tb_vendedores");
            $crud->set_subject( $titulo );

            $crud->display_as( 'nombres', 'Nombres' );
            $crud->display_as( 'cedula', 'Cédula' );
            $crud->display_as( 'direccion', 'Dirección' );
            $crud->display_as( 'id_zona', 'Zona' );
            $crud->display_as( 'costo', 'Costo' );
            $crud->display_as( 'estado', 'Estado' );
            $crud->display_as( 'destacado', 'Destacado' );
            $crud->display_as( 'usr_ingreso', 'Usuario Ingreso' );
            $crud->display_as( 'fec_ingreso', 'Fecha Ingreso' );
            $crud->display_as( 'id_empresa', 'Empresa' );
            $crud->display_as( 'iniciales', 'Iniciales' );

            $crud->field_type('estado', 'dropdown', array(
                'I' => 'Inactivo',
                'A' => 'Activo',
            ));

            $crud->set_relation('id_empresa', 'tb_empresas', 'razon_social');
            $crud->set_relation('id_zona', 'tb_zonas', 'descripcion');

            $crud->columns( 'nombres', 'cedula', 'direccion', 'id_zona', 'costo', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'id_empresa', 'iniciales' );
            $crud->fields( 'nombres', 'cedula', 'direccion', 'id_zona', 'costo', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'id_empresa', 'iniciales' );
            $crud->required_fields( 'nombres', 'cedula', 'direccion', 'id_zona', 'costo', 'estado', 'destacado', 'usr_ingreso', 'fec_ingreso', 'id_empresa', 'iniciales' );

            $crud->unset_export();
            $crud->unset_clone();
            $crud->unset_read();
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

}

/* End of file Backend.php */
/* Location: ./application/controllers/Backend.php */
