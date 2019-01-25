<!-- Input oculto con el total de los ítems -->
<input type="hidden" id="total_items" value="<?php echo count($ids); ?>">

<!-- Modal -->
<div class="ui longer modal">
	<!-- Cabecera -->
	<div class="header">
		Generar imputación presupuestal y aplicar porcentajes a municipios
	</div><!-- Cabecera -->
	
	<!-- Contenido -->
	<div class="scrolling content" id="contenido_modal">
		<!-- Se recorren los ids de las facturas subidas -->
		<?php for ($item=0; $item < count($ids); $item++) { ?>
			<!-- Se consulta la factura -->
			<?php $factura = $this->facturas_model->obtener("factura", $ids[$item]); ?>

			<!-- Input oculto id de factura -->
			<input type="hidden" value="<?php echo $ids[$item]; ?>" id="<?php echo $item; ?>">

			<div class="ui segment">
				<!-- Descripción de la factura -->
				<a class="ui teal right ribbon label" id="numero_factura<?php echo $item; ?>"></a>
				
				<div class="ui top attached label">
					<h1>
						<span id="nombre_tercero<?php echo $item; ?>"></span>
						
						<small class="valor_tercero"><?php echo "$ <span id='valor$item' data-valor='0'></span>"; ?></small>
					</h1>
				</div>
				<!-- Descripción de la factura -->

				<!-- Imputación presupuestal -->
				<div class="ui two column divided grid" id="informacion_presupuestal">
					<!-- Imputación -->
					<div class="eight wide column">
						<?php
						$this->data["item"] = $item;
						$this->load->view("facturas/imputacion/index", $this->data);
						?>
					</div>

					<!-- ICA -->
					<div class="eight wide column">
						<?php
						$this->data["item"] = $item;
						$this->load->view("facturas/ica/index", $this->data);
						?>
					</div>
				</div><!-- Imputación presupuestal -->
				
				<!-- Porcentajes -->
				<div class="ui two column divided grid">
					<!-- Imputación -->
					<div class="eight wide column" style="padding-top: 0; padding-bottom: 5px;">
						<?php
						$this->data["item"] = $item;
						$this->load->view("facturas/imputacion/porcentaje", $this->data);
						?>
					</div>
					
					<!-- ICA -->
					<div class="eight wide column" style="padding-top: 0; padding-bottom: 5px;">
						<?php
						$this->data["item"] = $item;
						$this->load->view("facturas/ica/porcentaje", $this->data);
						?>
					</div>
				</div><!-- Porcentajes -->
			</div>
		<?php } ?>
	</div><!-- Contenido -->

	<!-- Pie -->
	<div class="actions">
    	<div class="ui button" onCLick="javascript:cerrar_modal()">Cancelar</div>
    	<div class="ui green button" onClick="javascript:guardar()">Guardar</div>
  	</div><!-- Pie -->
</div><!-- Modal -->

<script type="text/javascript">
	$(document).ready(function(){
		$("#cargando").hide()

		// Inicialización de las listas desplegables
		$('.ui.dropdown').dropdown({
			message: {
				noResults : 'Sin resultados.',
			},
		})

		// Recorrido de las facturas subidas
		for (var item = 0; item < "<?php echo count($ids); ?>"; item++) {
			var id = $(`#${item}`).val()
			var factura = ajax(`${$("#url").val()}/facturas/obtener`, {tipo: 'factura', id: id}, 'JSON')

			cargar_factura(`${$("#url_base").val()}/archivos/facturas/${factura.Nombre}`, id, item)
		}


		// $.get("face_f0890906388000006135C.xml", function (xml) {
		//     $('cbc:Note', xml).each(function() {
		//     	imprimir("algo")
		 
		//        // var name = $(this).attr('name');
		//        // var description = $(this).attr('description');
		//        // var url = $(this).attr('url');
		 
		//        // alert(name + " " + description + " " + url);
		//     });
		// });
		

		$('.ui.longer.modal').modal({
			onHide: function(){
	            $("#cargando").hide()
	            $('.ui.longer.modal').remove()
        	}
        }).modal('show')
	})
</script>