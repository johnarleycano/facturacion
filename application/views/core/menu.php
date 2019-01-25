<!-- Botón de subida -->
<form enctype="multipart/form-data">
	<input type="file" id="btn_subir" multiple hidden/>
</form>

<a class="item active" href="<?php echo site_url(''); ?>">
    <i class="fa fa-home"></i>&nbsp;&nbsp;Inicio
</a>

<a class="item" onClick="javascript:iniciar_subida()">
    <i class="fa fa-file-upload"></i>&nbsp;&nbsp;Agregar facturas
</a>

<div class="right menu">
    <a class="ui item" href="<?php echo site_url('sesion/cerrar'); ?>">
        Cerrar sesión
    </a>
</div>

<script type="text/javascript">
	function iniciar_subida()
	{
		$('#btn_subir').trigger('click')
	}

	$(document).ready(function(){
		$(':file').on('change', subir_xml)
	})
</script>