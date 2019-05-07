var msg = [];

msg['100'] = "Parámetros insuficientes"; 
msg['101'] = "Datos incorrectos";
msg['102'] = "Código de verificación incorrecto";
msg['200'] = "OK-Respuesta est�ndar para peticiones correctas.";
msg['201'] = "Creado-La petici�n ha sido completada y ha resultado en la creaci�n de un nuevo recurso.";
msg['202'] = "Aceptada";
msg['203'] = "Informaci�n no autorizada";
msg['204'] = "Sin contenido";
msg['205'] = "Recargar contenido";
msg['414'] = "URI demasiado larga";
msg['415'] = "Tipo de medio no soportado";

msg['500'] = "Error interno del Servidor";
msg['501'] = "No implementado";
msg['502'] = "Error en el Gateway";
msg['503'] = "Servicio no disponible";
msg['504'] = "Tiempo del Gateway agotado";


function Cargar(id,url)
{
	$( id ).load( url );
}

function Confirmar(titulo,tipo,mensaje)
{
	mensaje = mensaje || '';
	var resp = false;
	/*
		tipo = 'warning', 'error', 'success', 'info'
	*/
	Swal({
          title: titulo,
          text: mensaje,
          type: tipo,
          showCancelButton: true,
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {        	
          if (result.value) {          	
          	resp = true;
          	return resp;
            
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            
            resp =  true;
            return resp;
          }
        });

   
}

function Enviar_formulario(form,url_destino,callback)
{
	var resp = false;	
	$.ajax({
        url: url_destino,
        type: 'POST',
        async: false,	//	Para obligar al usuario a esperar una respuesta
        data: $(form).serialize(),
        error: function(XMLHttpRequest, errMsg, exception){
            var msg = "Ha fallado la petición al servidor";
            alert(msg);
        },
        success: function(htmlcode){
        	var cod = htmlcode.split("-");
        	switch(cod[0])
            {
                case "0":
                    Notificacion('Autentificado','success');
        			callback();            
                    break;                    
                default:
                    Notificacion(msg[cod[0]],'error');
                    break;
            }
        }
    });	
}

 function guardar(form,e)
{
    e.preventDefault();
    if(valida_formulario(form))
    {
        $.ajax({
            url: '<?=base_url();?>index.php/<?=$controller;?>/guardar',
            type: form.method,
            async: true,
            data: $(form).serialize(),
            error: function(XMLHttpRequest, errMsg, exception){
                var msg = "Ha fallado la petición al servidor";
                alerta(msg,"error");              
            },
            success: function(htmlcode){
                var resp = htmlcode.split("-");
                switch(resp[0])
                {
                    case "0":
                        alerta("Los datos han sido guardados","success");
                        buscar();
                        break;                    
                    default:
                        alerta(htmlcode,'error');
                        break;
                }
            }
        });
    }
}

function Notificacion(mensaje,tipo)
{
	switch(tipo)
	{
		case 'success' :  
			toastr.success(mensaje, 'Operación completa', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			break;
		case 'error' :  
			toastr.error(mensaje, '¡Error!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			break;
		case 'warning' :  
			toastr.warning(mensaje, '¡Advertencia!', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			break;
		case 'info' :  
			toastr.info(mensaje, 'Info', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			break;
		default:
			toastr.info(mensaje, 'Info', { "showMethod": "fadeIn", "hideMethod": "fadeOut", timeOut: 2000 });
			break;
	}
}

var isIE = document.all?true:false;
var isNS = document.layers?true:false;


function SoloDigitos(e,decReq) {
	var key = (isIE) ? event.keyCode : e.which;
	var obj = (isIE) ? event.srcElement : e.target;
	var isNum = (key > 47 && key < 58) ? true : false;
	var dotOK = (key==46 && decReq=='decOK' && (obj.value.indexOf(".")<0 || obj.value.length==0)) ? true:false;
	var isDel = (key==0 || key==8 ) ? true:false;
	var isEnter = (key==13) ? true:false;
	//e.which = (!isNum && !dotOK && isNS) ? 0 : key;
	return (isNum || dotOK || isDel || isEnter);
}

// Removes leading whitespaces
function LTrim( value ) {
	var re = /\s*((\S+\s*)*)/;
	return value.replace(re, "$1");
	
}
// Removes ending whitespaces
function RTrim( value ) {	
	var re = /((\s*\S+)*)\s*/;
	return value.replace(re, "$1");
}

// Removes leading and ending whitespaces
function Trim( value ) {
	return LTrim(RTrim(value));
}