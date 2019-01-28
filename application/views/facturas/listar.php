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
						<a class="ui red label" onClick="javascript:eliminar(<?php echo $factura->Pk_Id; ?>)">
							<i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar
						</a>
					</div>
					
					<!-- Fecha -->
					<div class='ui label' data-tooltip="Fecha de la factura" data-position="bottom center">
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

