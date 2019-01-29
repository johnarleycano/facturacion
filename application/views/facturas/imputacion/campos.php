<h4 class="ui right floated header">Imputación <?php echo $contador; ?></h4>
<div class="ui clearing divider"></div>

<form class="ui tiny form">
	<div class="field">
		<div class="one field">
			<div class="field">
				<select class="ui search dropdown" id="cuenta_<?php echo $item; ?>_<?php echo $contador; ?>">
					<option value="">Seleccione una cuenta</option>
					<?php foreach ($this->configuracion_model->obtener('cuentas') as $cuenta) echo "<option value='$cuenta->Pk_Id'>$cuenta->Codigo_Cuenta $cuenta->Codigo - $cuenta->Nombre</option>"; ?>
				</select>
			</div>
		</div>
		<div class="two fields">
			<div class="field <?php echo $item; ?>_<?php echo $contador; ?>">
				<div class="ui right labeled input">
					<input type="number" id="porcentaje_imputacion_<?php echo $item; ?>_<?php echo $contador; ?>" data-item="<?php echo $item; ?>" min="0" max="100" class="error" placeholder="Porcentaje">
					<div class="ui basic label">%</div>
				</div>
			</div>

			<div class="disabled field">
				<div class="ui right labeled input">
					<input type="text" id="valor_parcial_<?php echo $item; ?>_<?php echo $contador; ?>" value="0" style="text-align: right;">
					<div class="ui basic label">$</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		// Se toman valores generales
		var item = parseInt("<?php echo $item; ?>")
		var contador = parseInt("<?php echo $contador; ?>")
		var valor_total = parseFloat($(`#valor${item}`).attr("data-valor"))

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
			var valor_parcial = 0

			// $(`.${item}_${contador}`).removeClass("error")

			// Recorre los porcentajes de ese ítem
			$(`input[id^="porcentaje_imputacion_${item}"]`).each(function(){
				// Se toma el porcentaje
				porcentaje_parcial = parseInt($(this).val())

				// Si tiene porcentaje, acumula sobre el total
				if(porcentaje_parcial > 0) porcentaje_total = porcentaje_total + porcentaje_parcial
				
				// Se toma el valor parcial
				if(porcentaje_parcial > 0) valor_parcial = parseFloat((valor_total * porcentaje_parcial) / 100)
			})

			// Se modifica la barra de progreso
			$(`#porcentaje_imputacion${item}`).progress('set progress', porcentaje_total)

			// Se modifica el valor parcial
			$(`#valor_parcial_${item}_${contador}`).val(formatear_numero(valor_parcial))
		})
	})
</script>