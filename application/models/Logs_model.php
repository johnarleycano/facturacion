<?php 
Class Logs_model extends CI_Model{
	/**
     * Permite la inserción de datos en la base de datos 
     * 
     * @return [void]
     */
    function insertar($id_tipo, $detalle = null){
    	//Se prepara el arreglo con los datos a insertar
        $datos = array(
            'Fk_Id_Log_Tipo' => $id_tipo,
            'Fk_Id_Usuario' => $this->session->userdata('Pk_Id_Usuario'),
            'Observacion' => $detalle
        );

        return $this->db->insert('logs', $datos);
    }
}
/* Fin del archivo Logs_model.php */
/* Ubicación: ./application/models/Logs_model.php */