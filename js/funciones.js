function ajax(url, datos, tipo_respuesta)
{
    var respuesta

    $.ajax({
        url: url,
        data: datos,
        type: 'POST',
        dataType: tipo_respuesta,
        async: false,
        success: function(resultado) {
            respuesta = resultado
        },
        error: function() {
            respuesta = false
        }
    })

    return respuesta
}

function ajax_archivos(url, datos, tipo_respuesta)
{
    var respuesta

	$.ajax({
	    url: url,
	    type: 'POST',
        async: false,
	    data: datos,
	    cache: false,
	    dataType: tipo_respuesta,
	    processData: false, // No procesar los archivos
	    contentType: false, // Establecer el tipo de contenido en falso ya que jQuery le dirá al servidor que es una petición de string
	    success: function(resultado, textStatus, jqXHR)
	    {
	    	// imprimir(resultado)
            respuesta = resultado

	        if(typeof resultado.error === 'undefined')
	        {
	            // Success so call function to process the form
	            // submitForm(event, data);
	        }
	        else
	        {
	            // Handle errors here
	            // console.log('ERRORS: ' + data.error);
	        }
	    },
	    error: function(jqXHR, textStatus, errorThrown)
	    {
	    	respuesta = false
	        
	        // Handle errors here
	        console.log('ERRORS: ' + textStatus);
	        
	        // STOP LOADING SPINNER
	        
	    }
	})

    return respuesta
}

/**
 * Carga una interfaz mediante el método Load de jQuery
 * 
 * @param  {string}         contenedor      [description]
 * @param  {string}         url             [description]
 * @param  {array}          datos           [description]
 * 
 */
function cargar_interfaz(contenedor, url, datos)
{
    // Se muestra el mensaje de carga
    $("#cargando").show()

    // Se carga la interfaz
    $(`#${contenedor}`).load(url, datos, function(){
        // imprimir("Cargado")
    })
}

function cerrar_modal()
{
	$('.ui.modal').modal('hide all')
}

/**
 * Imprime mensaje en consola
 * 
 * @param  [string] mensaje Mensaje a imprimir
 * 
 * @return [void]
 */
function imprimir(mensaje, tipo)
{
    switch(tipo) {
        case "tabla":
            console.table(mensaje)
        break;

        case "tiempo_inicio":
            console.time(mensaje)
        break;

        case "tiempo_final":
            console.timeEnd(mensaje)
        break;

        case "grupo":
            console.group(mensaje)
        break;

        default:
            console.log(mensaje)
    }
}

function formatear_numero(valor)
{
    valor += ''
    x = valor.split('.')
    x1 = x[0]
    x2 = x.length > 1 ? ',' + x[1] : ''
    var rgx = /(\d+)(\d{3})/
    while (rgx.test(x1)) x1 = x1.replace(rgx, '$1' + '.' + '$2')
    return x1 + x2
}