<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Cabecera con todos los estilos y scripts -->
        <?php $this->load->view('core/header'); ?>
	</head>
	<body>
		<div class="ui secondary pointing menu">
			<?php $this->load->view('core/menu'); ?>
		</div>

		<!-- Contenedor principal -->
    	<section class="ui container" id="contenedor_principal">
    		<?php $this->load->view($contenido_principal); ?>
    	</section>
	</body>
</html>