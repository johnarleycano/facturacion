<div id="cont_facturas"></div>
<div id="cont_modal"></div>

<div id="modal_eliminar" class="ui basic modal">
	<div class="ui icon header">
		<i class="fa fa-trash fa-3x"></i><br>
		Advertencia
	</div>
	<div class="content">
		<p>Esta factura se eliminará y también toda su imputación presupeustal y RETE ICA configurados.</p>
		<p>¿Está seguro?</p>
	</div>
	<div class="actions">
		<div class="ui blue basic cancel inverted button">
			<i class="fa fa-times"></i> Cancelar
		</div>
		<div class="ui red ok inverted button" onClick="javascript:eliminar()">
			<i class="fa fa-check"></i> Si, Eliminar
		</div>
	</div>
</div>

<script type="text/javascript">
	function cargar_factura(url, id, item)
	{
		$.ajax({
		    type: "GET" ,
		    url: url,
		    dataType: "xml" ,
		    success: function(xml) {
		    	// Se extraen los valores que se requieren
			    let numero = $(xml).find('cbc\\:ID, ID').first().text()
			    let nombre_tercero = $.trim($(xml).find('cac\\:PartyName, PartyName').first().text())
			    let valor = $(xml).find('cbc\\:PayableAmount, PayableAmount').first().text()
			    let fecha_factura = $(xml).find('cbc\\:IssueDate, IssueDate').first().text()

			    var datos = {
			    	Nombre_Tercero: nombre_tercero,
			    	Numero: numero,
			    	Valor: valor,
			    	Fecha_Factura: fecha_factura,
			    }

			    // Se actualiza la factura en base de datos
			    ajax(`${$("#url").val()}/facturas/actualizar`, {'tipo': 'factura', 'id': id, 'datos': datos}, 'JSON')
			    
			    // Se insertan los valores
			    $(`#numero_factura${item}`).text(`Factura No. ${numero}`)
			    $(`#nombre_tercero${item}`).text(`${item + 1}. ${nombre_tercero}`)
			    $(`#valor${item}`).text(formatear_numero(valor)).attr("data-valor", valor)
		    }       
		})
	}

	/**
	 * Elimina el registro
	 * @param  		{int} 			id 				Id de la factura
	 * @return 		{boolean}    	true, false
	 */
	function eliminar(id = null)
	{
		// Si encuentra id
		if(id) {
			$("#id_factura").val(id)
			$('#modal_eliminar').modal('show')
			return false
		}

		// Se elimina el registro
		ajax("<?php echo site_url('facturas/eliminar'); ?>", {"tipo": "factura", "datos": {"Pk_Id": $("#id_factura").val()}}, 'HTML')

		// Carga de la itnerfaz
		listar()
	}

	function guardar()
	{
		imprimir("Guardando...")

		var datos_imputacion = []
		var datos_ica = []
		
		// Recorrido de cada ítem de las facturas subidas
		for (var item = 0; item < $("#total_items").val(); item++) {

			imprimir(`Item ${item}`)

			// Se actualiza la factura con el sector al que pertenece
		    ajax(`${$("#url").val()}/facturas/actualizar`, {'tipo': 'factura', 'id': $(`#${item}`).val(), 'datos': {Fk_Id_Sector: $(`#sector${item}`).val()}}, 'JSON')
			
			// Recorrido de cada campo creado de la imputación
			for (var contador = 1; contador <= $(`#contador_imputacion${item}`).val(); contador++) {
				imprimir(`-Cuenta ${$(`#cuenta_${item}_${contador}`).val()}`)

				// if(!$(`#porcentaje_${item}_${contador}`).val()){
				// 	$(`#porcentaje_${item}_${contador}`).prevUntil('.fields').addClass("error")
				// }
				
				var dato = {
					"Fk_Id_Cuenta": $(`#cuenta_${item}_${contador}`).val(),
					"Fk_Id_Factura": $(`#${item}`).val(),
					"Porcentaje": $(`#porcentaje_imputacion_${item}_${contador}`).val(),
				}
				datos_imputacion.push(dato)
			}

			// Recorrido de cada campo creado con la retención ICA
			for (var contador = 1; contador <= $(`#contador_ica${item}`).val(); contador++) {
				var dato = {
					"Fk_Id_Municipio": $(`#municipio_${item}_${contador}`).val(),
					"Fk_Id_Factura": $(`#${item}`).val(),
					"Porcentaje": $(`#porcentaje_ica_${item}_${contador}`).val(),
				}
				datos_ica.push(dato)
			}
		}
		// imprimir(datos)

		ajax(`${$("#url").val()}/facturas/insertar`, {tipo: 'factura_imputacion', "datos": datos_imputacion}, 'HTML')
		ajax(`${$("#url").val()}/facturas/insertar`, {tipo: 'factura_ica', "datos": datos_ica}, 'HTML')

		cerrar_modal()
	}

	/**
	 * Interfaz de listado de registros
	 * 
	 * @return {void}              
	 */
	function listar()
	{
        cargar_interfaz(`cont_facturas`, "<?php echo site_url('facturas/cargar_interfaz'); ?>", {"tipo": `facturas_lista`})
	}

	function subir_xml(evento)
	{
		// Se capturan los archivos para configurar
		var archivos = evento.target.files
		var archivos_xml = new FormData()
		var ids = []

		// imprimir("Cargando...")

		// Se recorren los archivos
		$.each(archivos, function(index, archivo) {
			// Si es un archivo XML
			if(archivo.type == "text/xml"){			
				// Datos
				let nombre = archivo.name.split(".")[0]
				let extension = archivo.name.split(".")[1]
				let peso = archivo.size / 1000

				// Se agrega al arreglo de archivos a subir
				archivos_xml.append(index, archivo)

				// insertar_archivo
				let subir_archivo = ajax_archivos(`${$("#url").val()}/facturas/subir`, archivos_xml, "JSON")
				
				// Si se subió el archivo
				if(subir_archivo){
					// Se crea el registro de la factura en la base de datos
					id_factura = ajax(`${$("#url").val()}/facturas/insertar`, {tipo: 'factura', datos: {Nombre: `${nombre}.${extension}`}}, 'HTML')
					ids.push(id_factura)

	    			// imprimir("Cargado.")
				}
			}	
		})

		// Se carga la interfaz con todas las facturas que se subieron
		cargar_interfaz(`cont_modal`, `${$("#url").val()}/facturas/cargar_interfaz`, {tipo: `facturas_crear`, ids: ids})
	}

	$(document).ready(function(){
		listar()
	})
</script>