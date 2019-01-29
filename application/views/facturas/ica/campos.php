<h4 class="ui right floated header">Aplicación RETE ICA <?php echo $contador; ?></h4>
<div class="ui clearing divider"></div>

<form class="ui tiny form">
	<div class="two fields">
		<div class="field">
			<select class="ui search dropdown" id="municipio_<?php echo $item; ?>_<?php echo $contador; ?>">
				<option value="">Seleccione un municipio</option>
				<?php foreach ($this->configuracion_model->obtener("municipios") as $municipio) echo "<option value='$municipio->Pk_Id'>$municipio->Nombre</option>"; ?>
			</select>
		</div>

		<div class="field <?php echo $item; ?>_<?php echo $contador; ?>">
			<div class="ui right labeled input">
				<input type="number" id="porcentaje_imputacion_<?php echo $item; ?>_<?php echo $contador; ?>" data-item="<?php echo $item; ?>" min="0" max="100" class="error" placeholder="Porcentaje">
				<div class="ui basic label">%</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		// Se toman valores generales
		var item = parseInt("<?php echo $item; ?>")
		var contador = parseInt("<?php echo $contador; ?>")

		// Inicialización de las listas desplegables
		$('.ui.dropdown').dropdown({
			message: {
				noResults : 'Sin resultados.',
			},
			fullTextSearch: true,
		})

		// Si se cambia el porcentaje de alguno de los ítems
		$("input[id^=porcentaje]").on("keyup", function(){
			var porcentaje_total = 0

			// $(`.${item}_${contador}`).removeClass("error")

			// Recorre los porcentajes de ese ítem
			$(`input[id^="porcentaje_ica_${item}"]`).each(function(){
				// Se toma el porcentaje
				porcentaje_parcial = parseInt($(this).val())

				// Si tiene porcentaje, acumula sobre el total
				if(porcentaje_parcial > 0) porcentaje_total = porcentaje_total + porcentaje_parcial
			})

			// Se modifica la barra de progreso
			$(`#porcentaje_ica${item}`).progress('set progress', porcentaje_total)
		})
	})
</script>
