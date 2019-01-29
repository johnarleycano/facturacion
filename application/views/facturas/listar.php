<!-- Input oculto con el id de factura -->
<input type="hidden" id="id_factura">

<div class="ui divided items">
	<?php foreach ($this->facturas_model->obtener("facturas") as $factura){ ?>
		<div class="item">
			<div class="content">
				<!-- Nombre -->
				<a class="header"><?php echo $factura->Nombre_Tercero; ?></a>
				
				<div class="meta">
					<span class="cinema"><?php echo "$ ".number_format($factura->Valor, 0, "", "."); ?></span>
				</div>

				<div class="description">
					<!-- <p><?php // echo "No. $factura->Numero"; ?></p> -->
				</div>
				
				<div class="extra">
					<!-- ELiminar -->
					<div class="ui right floated">
						<div class="ui compact menu">
							<a class="item">
								<div class="floating left ui orange label" style="width: 52px;">
									<?php echo number_format($this->facturas_model->obtener("porcentaje_imputacion", $factura->Pk_Id), 0)." %"; ?>
								</div>
								<!-- <i class="icon mail"></i>  -->Imputación presupuestal
							</a>
							<a class="item">
								<div class="floating ui teal label" style="width: 52px;">
									<?php echo number_format($this->facturas_model->obtener("porcentaje_ica", $factura->Pk_Id), 0)." %"; ?>
								</div>
								<!-- <i class="icon users"></i>  -->Aplicación RETE ICA
							</a>
							<a class="ui item" data-tooltip="Eliminar factura" data-position="bottom center" style="background-color: #D01919; color: white;"  onClick="javascript:eliminar(<?php echo $factura->Pk_Id; ?>)">
								<i class="fa fa-trash"></i>
							</a>
						</div>
					</div>
					
					<!-- Fecha -->
					<div class='ui label' data-tooltip="Fecha de la factura" data-position="bottom center" style=" width: 150px;">
						<i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo $this->configuracion_model->obtener("formato_fecha", $factura->Fecha_Factura) ?>
					</div>
					
					<!-- Sector -->
					<?php if($factura->Sector) echo "<div class='ui label'><i class='fa fa-globe'></i>&nbsp;&nbsp;$factura->Sector</div>"; ?>
					
					<!-- Número de factura -->
					<div class="ui label" data-tooltip="Número de factura" data-position="bottom center">
						<i class="fa fa-receipt"></i>&nbsp;&nbsp;<?php echo $factura->Numero; ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<script type="text/javascript">
	$("#cargando").hide()
</script>

