	var isIE = document.all?true:false;
	var isNS = document.layers?true:false;

	function RemoveBad(strTemp) {
		strTemp = strTemp.replace(/\<|\>|\"|\%|\;|\(|\)|\&|\+/g,"");
		return strTemp;
	}

	function onlyDigits(e,decReq) {
		var key = (isIE) ? event.keyCode : e.which;
		var obj = (isIE) ? event.srcElement : e.target;
		var isNum = (key > 47 && key < 58) ? true : false;
		var dotOK = (key==46 && decReq=='decOK' && (obj.value.indexOf(".")<0 || obj.value.length==0)) ? true:false;
		var isDel = (key==0 || key==8 ) ? true:false;
		var isEnter = (key==13) ? true:false;
		//e.which = (!isNum && !dotOK && isNS) ? 0 : key;
		return (isNum || dotOK || isDel || isEnter);
	}

	function elimina_comas(strTemp){		
		strTemp = strTemp.replace(/\,/g,"");
		return strTemp;	
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
	function trim( value ) {
		return LTrim(RTrim(value));
	}

	function valida_formulario(f,objesp)
	{
		var objesp = objesp || true;
		var expreg = /_$/;
		var resp = false;

		if(objesp)
		{
			for (i=0; i<f.elements.length; i++)
			{
				objeto = f.elements[i];
				if(expreg.test(objeto.id))
				{
					//CKEditor
					var patron = /ckeditor/g;
					if(patron.test(objeto.className))
					{
						$("#"+objeto.id).val(CKEDITOR.instances[objeto.id].getData());
					}
				}
			}
		}

		resp = $("#"+f.id).parsley().validate();

		return resp;
	}

	
	function ValidaForm(f){
		
		for (i=0; i<f.elements.length; i++)
		{
			objeto = f.elements[i];
			// Verificamos si el elemento es obligatorio
			if(objeto.id.search(/\_/) > 0){
				// Si es tipo de texto, entonces no debe estar vacio
				if (objeto.type == "text" || objeto.type == "password" || objeto.type.toLocaleLowerCase() == "textarea") {
					objeto.value = trim(objeto.value);
					if(trim(objeto.value) == ""){ // verificamos que no este vacio
						if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){ 
							//alert("Todos los campos marcados con un asterisco deben tener alg\u00fan valor.");
							alert("Los campos marcados con un asterisco(*) son obligatorios.");
						} else { 
							alert(objeto.alt);
						}
						//objeto.select();
						//objeto.focus();
						return false;
					} else { // Validamos que no tenga codigo javascript
						if(objeto.value.indexOf("<script") >= 0){
							alert("No se permite código javascript");
							//objeto.select();
							//objeto.focus();
							return false;
						}
						if(objeto.name .search(/correo/)>0){ // verificamos si sintaxis de un correo
							if(objeto.value.search(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig)){
								alert("La cuenta de correo electrónico es incorrecta, debes escribirla de forma: nombre@servidor.dominio");
								//objeto.select();
								//objeto.focus();
								return false;
							}
						}
					}
				}
				// campos HIDDEN
				if(objeto.type == "hidden" && objeto.value == ""){
					if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){
						alert("Todos los campos marcados con un asterisco(*) son obligatorios.");
					} else {
						alert(objeto.alt);
					}
					if(typeof(objeto.obj) == "undefined" || objeto.obj == ""){ return false; alert("Olvid� seleccionar el FOCUS del HIDDEN: "+objeto.id); }
					var nObj = document.getElementById(objeto.obj);
					if(nObj){
						if(nObj.type != "select-one"){ nObj.select(); }
						if(nObj.style.display != 'none' && nObj.style.visibility != 'hidden'){ nObj.focus(); }
					}
					return false;
				}
				
				// Verificamos que los <SELECT> tengan seleccionado una opcion
				if(objeto.type == "select-one" && parseInt(objeto.value) < 0){
					if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){
						alert("Tienes que seleccionar una opci&oacute;n");
					} else {
						alert(objeto.alt);
					}
					//objeto.focus();
					return false;
				}
				
				// Verificamos que los <SELECT> tengan seleccionado una opcion
				if(objeto.type == "select-multiple"){
					var alMenosUnoSeleccionado = false;
					for(var ii=0; ii<objeto.options.length; ii++){
						if(objeto.options[ii].selected == true){
							alMenosUnoSeleccionado = true;
							ii = objeto.options.length;
						}
					}
					if(!alMenosUnoSeleccionado){
						if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){
							alert("Tienes que seleccionar al menos una opci&oacute;n de la lista");
						} else {
							alert(objeto.alt);
						}
						objeto.focus();
						return false;
					}
				}
				
				// Verificamos si las contrasenas escritas son iguales
				if(objeto.id == "contrasena_n*"){
					if(objeto.value != document.getElementById("contrasena_r*").value){
						if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){
							alert("Las contraseñas escritas son diferentes.");
						} else {
							alert(objeto.alt);
						}
						objeto.value = "";
						document.getElementById("contrasena_r*").value = "";
						//objeto.select();
						//objeto.focus();
						return false;
					}
				}
				if(objeto.type == "checkbox" && objeto.checked == false){
					if(typeof(objeto.alt) == "undefined" || objeto.alt == "") {
						alert("Tienes que activar esta opción.");
					} else {
						alert(objeto.alt);
					}
					//objeto.focus();
					return false;
				}
				
				if(objeto.type == "radio"){
					var inputs = document.getElementsByName(objeto.name);
					var unRadioActivado = false;
					for(var j=0; j<inputs.length; j++){
						if(inputs[j].checked == true){
							unRadioActivado = true;
						}
					}
					
					if(unRadioActivado == false){
						if(inputs[0].alt == "undefined" || inputs[0].alt == ""){
							alert("Tienes que seleccionar al menos una opción.");
						} else {
							alert(inputs[0].alt);
						}
						//objeto.select();
						//objeto.focus();
						return false;
					}
				}
				if(objeto.type == "file"){
					if(trim(objeto.value) == ""){
						if(typeof(objeto.alt) == "undefined" || objeto.alt == ""){
							alert("Falta proporcionar un archivo.");
						} else {
							alert(objeto.alt);
						}
						//objeto.select();
						//objeto.focus();
						return false;
					} else {
						if(typeof(objeto.validos) != "undefined" && objeto.validos != ""){
							var expreg = new RegExp(".("+objeto.validos+")/i");
							if(objeto.value.search(objeto.validos)<2){
								var t = objeto.validos;
								alert("Solo se aceptan archivos: "+ t.replace(/\|/g, ", "));
								//objeto.select();
								//objeto.focus();
								return false;
							}
						}
						if(typeof(objeto.novalidos) != "undefined" && objeto.novalidos != ""){
							var expreg = new RegExp (".("+objeto.novalidos+")/i");
							if(objeto.value.search(objeto.novalidos) > 0){
								var t = objeto.novalidos;
								alert("NO se aceptan archivos: "+ t.replace(/\|/g, ", "));
								//objeto.select();
								//objeto.focus();
								return false;
							}
						}
					}
				}
			}
		}
		return true;
	}
	
	function isEMail(strEMail){
		return strEMail.search(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig);
	}

	function utf8_encode(argString) 
  	{ 
	  	if (argString === null || typeof argString === "undefined") {
		    return "";
		  }
		  var string = (argString + ""); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
		  var utftext = "",
		    start, end, stringl = 0;

		  start = end = 0;
		  stringl = string.length;
		  for (var n = 0; n < stringl; n++) {
		    var c1 = string.charCodeAt(n);
		    var enc = null;

		    if (c1 < 128) {
		      end++;
		    } else if (c1 > 127 && c1 < 2048) {
		      enc = String.fromCharCode(
		        (c1 >> 6) | 192, (c1 & 63) | 128
		      );
		    } else if ((c1 & 0xF800) != 0xD800) {
		      enc = String.fromCharCode(
		        (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
		      );
		    } else { // surrogate pairs
		      if ((c1 & 0xFC00) != 0xD800) {
		        throw new RangeError("Unmatched trail surrogate at " + n);
		      }
		      var c2 = string.charCodeAt(++n);
		      if ((c2 & 0xFC00) != 0xDC00) {
		        throw new RangeError("Unmatched lead surrogate at " + (n - 1));
		      }
		      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
		      enc = String.fromCharCode(
		        (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
		      );
		    }
		    if (enc !== null) {
		      if (end > start) {
		        utftext += string.slice(start, end);
		      }
		      utftext += enc;
		      start = end = n + 1;
		    }
		  }

		  if (end > start) {
		    utftext += string.slice(start, stringl);
		}
		return utftext;
    }