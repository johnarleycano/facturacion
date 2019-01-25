<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- Cabecera con todos los estilos y scripts -->
        <?php $this->load->view('core/header'); ?>
	</head>
	<body>
		<!-- Input que entrega url base para archivos en JS -->
        <input type="hidden" id="url" value="<?php echo site_url(''); ?>">
        <input type="hidden" id="url_base" value="<?php echo base_url(''); ?>">
        
		<!-- Menú -->
		<div class="ui secondary pointing menu">
			<?php $this->load->view('core/menu'); ?>
		</div>

		<!-- Contenedor principal -->
    	<section class="ui container" id="contenedor_principal">
    		<div class="ui active inverted dimmer" id="cargando">
			    <div class="ui text loader">Cargando</div>
			</div>

    		<?php $this->load->view($contenido_principal); ?>
    	</section>
	</body>
</html>