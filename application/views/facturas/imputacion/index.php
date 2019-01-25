<!-- Inout que controla la cantidad de contenedores -->
<input type="hidden" id="contador_imputacion<?php echo $item; ?>" value="0">

<!-- Sector -->
<div class="sixteen wide column">
	<select class="ui search dropdown" id="sector<?php echo $item; ?>">
		<option value="">Seleccione el sector</option>
		<?php foreach ($this->configuracion_model->obtener('sectores') as $sector) echo "<option value='$sector->Pk_Id'>$sector->Codigo</option>"; ?>
	</select>
</div>

<!-- Contenedor de imputaciones -->
<div class="sixteen wide column" id="cont_imputacion<?php echo $item; ?>"></div>

<!-- Agregar -->
<div class="sixteen wide column">
	<div class="ui divided selection list">
		<a class="item" onClick="javascript:agregar_imputacion(<?php echo $item; ?>)">
			<div class="ui horizontal label"><i class="fa fa-plus"></i></div>
		</a>
	</div>
</div>

<script type="text/javascript">
	function agregar_imputacion(item)
	{
		var contador = parseInt($(`#contador_imputacion${item}`).val())
		contador++

		$(`#cont_imputacion${item}`).append(`<div id="dato_imputacion_${item}_${contador}" data-contador="${contador}"></div>`)

		// Carga de la interfaz
		cargar_interfaz(`dato_imputacion_${item}_${contador}`, "<?php echo site_url('facturas/cargar_interfaz'); ?>", {"tipo": `facturas_imputacion`, "contador": contador, "item": item})
		
		$(`#contador_imputacion${item}`).val(contador)
	}
</script>