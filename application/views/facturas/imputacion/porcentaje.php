<div class="sixteen wide column">
	<div class="ui indicating progress" data-value="0" data-total="100" id="porcentaje_imputacion<?php echo $item; ?>">
		<div class="bar"></div>
		<div class="label">Imputación presupuestal no realizada</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(`#porcentaje_imputacion${"<?php echo $item; ?>"}`).progress({
			text: {
			value: 10,
			active  : '{value}% imputado',
			success : 'El {total}% del presupuesto ha sido imputado'
			}
		})
	})
</script>