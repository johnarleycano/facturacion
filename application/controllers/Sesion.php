<?php
date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author:     John Arley Cano Salinas
 * Fecha:       23 de enero de 2019
 * Programa:    Facturación | Módulo de sesión
 *              Gestiona todo lo relacionado con el inicio
 *              y cierre de sesión del usuario
 * Email:       johnarleycano@hotmail.com
 */
class Sesion extends CI_Controller {
	/**
     * Inicio de la sesión
     */
    function index()
    {
        // Se obtiene los datos de la aplicación principal
        $aplicacion = $this->configuracion_model->obtener("aplicacion", $this->config->item("id_aplicacion_sesion"));

        // Se lee el archivo con los datos de sesión activa
        $archivo = file_get_contents("{$aplicacion->Url}sesion.json");
        $datos_sesion = json_decode($archivo, true);

        $this->session->set_userdata($datos_sesion);
        redirect("");
    }

	/**
	 * Cierra la sesión y redirecciona
	 * 
	 * @return [void]
	 */
	function cerrar()
	{
		// Sesión destruida
        $this->session->sess_destroy();
	    
	    // Consulta de datos de la aplicación de sesión
        $aplicacion = $this->configuracion_model->obtener("aplicacion", $this->config->item('id_aplicacion_sesion'));
    	
    	// Redirección
        redirect("$aplicacion->Url/sesion/iniciar/{$this->config->item('id_aplicacion')}");
	}
}
/* Fin del archivo Sesion.php */
/* Ubicación: ./application/controllers/Sesion.php */