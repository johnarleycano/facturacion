<!-- Inout que controla la cantidad de contenedores -->
<input type="hidden" id="contador_ica<?php echo $item; ?>" value="<?php echo $item; ?>">

<!-- Contenedor ICA -->
<div class="sixteen wide column" id="cont_ica<?php echo $item; ?>"></div>

<!-- Agregar -->
<div class="sixteen wide column">
	<div class="ui divided selection list">
		<a class="item" onClick="javascript:agregar_ica(<?php echo $item; ?>)">
			<div class="ui horizontal label"><i class="fa fa-plus"></i></div>
		</a>
	</div>
</div>

<script type="text/javascript">
	function agregar_ica(item)
	{
		var contador = parseInt($(`#contador_ica${item}`).val())
		contador++

		$(`#cont_ica${item}`).append(`<div id="dato_ica_${item}_${contador}" data-contador="${contador}"></div>`)

		// Carga de la interfaz
		cargar_interfaz(`dato_ica_${item}_${contador}`, "<?php echo site_url('facturas/cargar_interfaz'); ?>", {"tipo": `facturas_ica`, "contador": contador, "item": item})
		
		$(`#contador_ica${item}`).val(contador)
	}
</script>