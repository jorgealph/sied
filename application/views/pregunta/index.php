<style>
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}

</style>

<input type="file" name="file" id="file" accept=".csv">
<input type="button" value="Capturar" onclick="example()">
<br>
<br>
<input type="button" value="Word" onclick="openInNewTab(1)">
<input type="hidden" value="1" id="id">
<div id="resultado"></div>
<div id="error"></div>
<div class="modal"><!-- Place at bottom of page --></div>
<!--<textarea id="resultado" cols="200" rows="30"></textarea>-->
<script>
var body = $("body");

$(document).on({
    ajaxStart: function() { body.addClass("loading");    },
     ajaxStop: function() { body.removeClass("loading"); }    
});



            function example(){
				//var myFile = $('#file').prop('files')[0];
				//var myFile = $("#file").val().replace(/.*(\/|\\)/, '');
				var formData = new FormData();
				formData.append('file', $('input[type=file]')[0].files[0])
				formData.append('iIdApartado', $("#id").val());
				//alert(myFile);
				$.ajax({
        			url: '<?=base_url()?>C_pregunta/csvtodb',
        			type: 'POST',
        			data: formData,
        			async: false,
        			success: function (data) {
            			//alert(data);
						//$("#resultado").html(data);
						var exito = data.split(".");
						//$("#resultado").html(exito[0]);

						if(exito[0] != null && exito[0] != ""){
							if(exito[0] == "exito"){
								notificacion("Preguntas guardadas", "success");
								console.log(exito[0]);
							}else{
								if(exito[0] == "error"){
									notificacion("Ha ocurrido un error en el documento", "error");
								}
							}
						}
						if(exito[1] != null && exito[1] != ""){
							var error = exito[1].split(",");
							var log = "";
							if(error[0] != null && error[0] != ""){
								error.forEach(function(entry){
									//log += entry + " ";
									console.log(entry);
									if(entry != null && entry != ""){
										log += "Fila: " + entry + "\n";
									}
								});
								swal({
									text: log,
									title: "Error al capturar las siguientes filas",
									icon: "error",
									closeOnClickOutside: false,
									closeOnEsc: false
								});
								$("#error").html(log);
							}
						}
        			},
        			cache: false,
        			contentType: false,
        			processData: false
   				});
			}
</script>


<script>
function openInNewTab(id) {
	var win = window.open('C_Pregunta/word/'+id, '_blank');
	win.focus();
}
</script>