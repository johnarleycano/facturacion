<?php 
Class Configuracion_model extends CI_Model{
	function __construct() {
        parent::__construct();

        /*
         * db_configuracion es la conexion a los datos de configuración de la aplicación, como lo son los sectores, vías,
         * tramos, entre otros.
         * Esta se llama porque en el archivo database.php la variable ['configuracion']['pconnect] esta marcada como false,
         * lo que quiere decir que no se conecta persistentemente sino cuando se le invoca, como en esta ocasión.
         */
        $this->db_configuracion = $this->load->database('configuracion', TRUE);
    }

    /**
     * Obtiene registros de base de datos
     * y los retorna a las vistas
     * 
     * @param  [string] $tipo Tipo de consulta que va a hacer
     * @param  [int]    $id   Id foráneo para filtrar los datos
     * 
     * @return [array]       Arreglo de datos
     */
    function obtener($tipo, $id = null, $adicional = null)
    {
        switch ($tipo) {
            case "aplicacion":
                return $this->db_configuracion->where("Pk_Id", $id)->get("aplicaciones")->row();
            break;

            case "cuentas":
                return $this->db->get("cuentas")->result();
            break;

            case 'formato_fecha':
                $fecha = $id;

                // Si la fecha toda es cero
                if ($fecha == "0000-00-00") return "";

                // Si el día, el mes o el año están en ceros
                if (substr($fecha, 8, 2) == "00" || substr($fecha, 5, 2) == "00" || substr($fecha, 0, 4) == "0000") return "Fecha no válida";
                    
                $dia_num = date("j", strtotime($fecha));
                $dia = date("N", strtotime($fecha));
                $mes = date("m", strtotime($fecha));
                $anio_es = date("Y", strtotime($fecha));

                //Si No hay fecha, devuelva vac&iacute;o en vez de 0000-00-00
                if($fecha == '1969-12-31 19:00:00' || !$fecha) return false;

                //Nombres de los d&iacute;as
                if($dia == "1") $dia_es = "Lunes";
                if($dia == "2") $dia_es = "Martes";
                if($dia == "3") $dia_es = "Miercoles";
                if($dia == "4") $dia_es = "Jueves";
                if($dia == "5") $dia_es = "Viernes";
                if($dia == "6") $dia_es = "Sabado";
                if($dia == "7") $dia_es = "Domingo";

                //Nombres de los meses
                if($mes == "1") $mes_es = "Enero";
                if($mes == "2") $mes_es = "Febrero";
                if($mes == "3") $mes_es = "Marzo";
                if($mes == "4") $mes_es = "Abril";
                if($mes == "5") $mes_es = "Mayo";
                if($mes == "6") $mes_es = "junio";
                if($mes == "7") $mes_es = "Julio";
                if($mes == "8") $mes_es = "Agosto";
                if($mes == "9") $mes_es = "Septiembre";
                if($mes == "10") $mes_es = "Octubre";
                if($mes == "11") $mes_es = "Noviembre";
                if($mes == "12") $mes_es = "Diciembre";

                // Se retorna la fecha formateada
                return ($adicional == "corto") ? "$mes_es $dia_num" : "$mes_es $dia_num, $anio_es" ;
            break;

            case "municipios":
                return $this->db_configuracion->order_by("Nombre")->get("municipios")->result();
            break;

            case "sectores":
                return $this->db_configuracion
                    ->order_by("Codigo")
                    ->get("sectores")->result();
            break;
        }
    }
}
/* Fin del archivo Configuracion_model.php */
/* Ubicación: ./application/models/Configuracion_model.php */