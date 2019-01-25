<?php
date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author:     John Arley Cano Salinas
 * Fecha:       23 de enero de 2019
 * Programa:    Facturación | Módulo de gestión de facturas
 * Email:       johnarleycano@hotmail.com
 */
class Facturas extends CI_Controller {
	/**
     * Función constructora de la clase. Se hereda el mismo constructor 
     * de la clase para evitar sobreescribirlo y de esa manera 
     * conservar el funcionamiento de controlador.
     */
    function __construct() {
        parent::__construct();

        // Si no ha iniciado sesión, se redirige a la aplicación de configuración
        if(!$this->session->userdata('Pk_Id_Usuario')){
            redirect("sesion/cerrar");
        }

        // Carga de modelos
        $this->load->model(array('facturas_model'));
    }

	/**
     * Interfaz inicial
     * 
     * @return [void]
     */
	function index()
	{
        $this->data['titulo'] = 'Facturas';
		$this->data['contenido_principal'] = 'facturas/index';
        $this->load->view('core/template', $this->data);
	}

    function prueba(){
        echo "CI";
    }

    /**
     * Actualización de registros en base de datos
     */
    function actualizar(){
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            // Se reciben los datos por POST
            $datos = $this->input->post('datos');
            $tipo = $this->input->post('tipo');

            // Dependiendo del tipo
            switch ($tipo) {
                case 'factura':
                    echo $this->facturas_model->actualizar($tipo, $this->input->post('id'), $datos);
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }

	/**
     * Carga de interfaces vía Ajax
     * 
     * @return [void]
     */
    function cargar_interfaz()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            $tipo = $this->input->post("tipo");

            switch ($tipo) {
                case "facturas_crear":
                    $this->data["ids"] = $this->input->post("ids");
                    $this->load->view("facturas/crear", $this->data);
                break;

                case "facturas_ica":
                    $this->data["contador"] = $this->input->post("contador");
                    $this->load->view("facturas/ica/campos", $this->data);
                break;

                case "facturas_imputacion":
                    $this->data["item"] = $this->input->post("item");
                    $this->data["contador"] = $this->input->post("contador");
                    $this->load->view("facturas/imputacion/campos", $this->data);
                break;

                case "facturas_lista":
                    $this->load->view("facturas/listar");
                break;
            }
        }
    }

    /**
     * Crea registros en base de datos
     * 
     * @return [void]
     */
    function insertar()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            $datos = $this->input->post('datos');
            $tipo = $this->input->post('tipo');

            switch ($tipo) {
                case 'factura':
                    echo $this->facturas_model->insertar($tipo, $datos);
                break;

                case 'factura_imputacion':
                    echo $this->facturas_model->insertar($tipo, $datos);
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }

    /**
     * Obtiene registros de base de datos
     * y los retorna a las vistas
     * 
     * @return [vois]
     */
    function obtener()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            $tipo = $this->input->post("tipo");
            $id = $this->input->post("id");

            switch ($tipo) {
                case "factura":
                    print json_encode($this->facturas_model->obtener($tipo, $id));
                break;
            }
        }
    }

    function subir()
    {
    	$datos = array();
	    $error = false;
	    $files = array();
		$uploaddir = "./archivos/facturas/";

		    $error = false;
		    $files = array();

		    foreach($_FILES as $file)
		    {
		        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		        {
		            $files[] = $uploaddir .$file['name'];
		        }
		        else
		        {
		    	$data = array('success' => 'Form was submitted', 'formData' => $_POST);
		            $error = true;
		        }
		    	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('archivo' => $files);
		    }

		print json_encode($data);
    }
}
/* Fin del archivo Facturas.php */
/* Ubicación: ./application/controllers/Facturas.php */