<?php 
Class Facturas_model extends CI_Model{
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
     * Elimina registros en base de datos
     * 
     * @param  [string] $tipo [Tipo de elemento a eliminar]
     * @param  [int] $id   [Id de la base de datos]
     * @return [boolean] true, false
     */
    function eliminar($tipo, $id){
        switch ($tipo) {
            case 'factura':
                return $this->db->delete('facturas', $id);
            break;
        }
    }

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

			case 'factura_ica':
				if($this->db->insert_batch('facturas_ica', $datos)) return true;
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

			case "facturas":
				$this->db
                    ->select(array(
                        'f.*',
                        's.Codigo Sector'
                        ))
                    ->from('facturas f')
                    ->join('configuracion.sectores s', 'f.Fk_Id_Sector = s.Pk_Id', 'left')
                    ->order_by("f.Fecha_Factura", "DESC")
                ;
                
                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->result();
            break;
        }
	}
}
/* Fin del archivo Facturas_model.php */
/* Ubicación: ./application/models/Facturas_model.php */