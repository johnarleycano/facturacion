<?php 
Class Facturas_model extends CI_Model{
	/**
     * Permite la inserción de datos en la base de datos 
     * 
     * @return [void]
     */
	function insertar($tipo, $datos){
		switch ($tipo) {
			case 'factura':
				$datos["Fecha"] = date("Y-m-d H:i:s");
        		$datos["Fk_Id_Usuario"] = $this->session->userdata("Pk_Id_Usuario");
				$this->db->insert("facturas", $datos);
				return $this->db->insert_id();
			break;

			case 'factura_imputacion':
				if($this->db->insert_batch('facturas_imputacion', $datos)) return true;
			break;
		}
	}

	/**
	 * Actualización en base de datos base de datos
	 * @param  string $tipo Tipo de dato
	 * @param  int $id   Identificador
	 * @return array       Datos
	 */
	function actualizar($tipo, $id, $datos){
		switch ($tipo) {
			case 'factura':
				return $this->db
					->where("Pk_Id", $id)
					->update("facturas", $datos);
			break;
		}
	}

	/**
	 * Obtiene registros de base de datos
	 * y los retorna a las vistas
	 * 
	 * @param  [string] $tipo Tipo de consulta que va a hacer
	 * @param  [int] 	$id   Id foráneo para filtrar los datos
	 * 
	 * @return [array]       Arreglo de datos
	 */
	function obtener($tipo, $id = null)
	{
		switch ($tipo) {
			case "factura":
                return $this->db->where("Pk_Id", $id)->get("facturas")->row();
            break;
        }
	}
}
/* Fin del archivo Facturas_model.php */
/* Ubicación: ./application/models/Facturas_model.php */