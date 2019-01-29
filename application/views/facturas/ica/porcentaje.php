<div class="sixteen wide column">
	<div class="ui indicating progress" data-value="0" data-total="100" id="porcentaje_ica<?php echo $item; ?>">
		<div class="bar"></div>
		<div class="label">Porcentajes para aplicación RETE ICA pendientes</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(`#porcentaje_ica${"<?php echo $item; ?>"}`).progress({
			text: {
			active  : '{value}% aplicado',
			success : 'El {total}% del porcentaje ha sido aplicado para RETE ICA'
			}
		})
	})
</script>