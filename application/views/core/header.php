<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Título que viene desde el controlador de cada interfaz -->
<title><?php echo $titulo; ?> | Control de Facturación | Devimed S.A.</title>

<!-- Entorno de desarrollo -->
<?php if(ENVIRONMENT === 'development') { ?>
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>js/jquery-3.3.1.js"></script>

	<!-- Semantic UI -->
	<script src="<?php echo base_url(); ?>js/semantic.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/semantic.css" />
<?php } ?>

<!-- Entorno de producción -->
<?php if(ENVIRONMENT === 'production') { ?>
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>

	<!-- Semantic UI -->
	<script src="<?php echo base_url(); ?>js/semantic.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/semantic.min.css" />
<?php } ?>