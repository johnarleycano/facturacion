<!-- Inout que controla la cantidad de contenedores -->
<input type="hidden" id="contador_ica" value="0">

<div class="sixteen wide column" id="cont_ica<?php echo $item; ?>"></div>

<!-- Agregar -->
<div class="sixteen wide column">
	<div class="ui divided selection list">
		<a class="item" onClick="javascript:agregar_ica(<?php echo $item; ?>)">
			<div class="ui horizontal label"><i class="fa fa-plus"></i></div>
			Agregar
		</a>
	</div>
</div>

<script type="text/javascript">
	function agregar_ica(id)
	{
		var contador = parseInt($("#contador_ica").val())

		contador++

		$(`#cont_ica${id}`).append(
			`<div id="dato_ica${contador}" data-contador="${contador}"></div>`
		)

		// Carga de la interfaz
		cargar_interfaz(`dato_ica${contador}`, "<?php echo site_url('facturas/cargar_interfaz'); ?>", {"tipo": `facturas_ica`, "contador": contador})
		
		$("#contador_ica").val(contador)
	}
</script>