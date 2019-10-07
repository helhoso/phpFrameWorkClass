<script>
	  
	function getRadioValor(name){
		var rads = document.getElementsByName(name);
	   
		for(var i = 0; i < rads.length; i++){
			if(rads[i].checked){
			return rads[i].value;
			}
		}
		return null;
	}

	function DataAtual(retFormato){
		// Obtém a data/hora atual
		var data = new Date();

		// Guarda cada pedaço em uma variável
		var dia     = data.getDate();           // 1-31
		var dia_sem = data.getDay();            // 0-6 (zero=domingo)
		var mes     = data.getMonth();          // 0-11 (zero=janeiro)
		var ano2    = data.getYear();           // 2 dígitos
		var ano4    = data.getFullYear();       // 4 dígitos
		var hora    = data.getHours();          // 0-23
		var min     = data.getMinutes();        // 0-59
		var seg     = data.getSeconds();        // 0-59
		var mseg    = data.getMilliseconds();   // 0-999
		var tz      = data.getTimezoneOffset(); // em minutos

		if(dia<10){
			dia = "0"+dia.toString();
		}
		// mes vai de 0 a 11
		mes = mes+1;
		if(mes<10){
			mes = "0"+mes.toString();
		}
		if(retFormato=='INT'){
			var str_data = ano4+"-"+mes+"-"+dia;
		}
		if((retFormato=='BR') || (retFormato=='')){
			var str_data = dia + '/' + mes + '/' + ano4;
		}

		// Mostra o resultado
		return str_data ;
	}

	function addMes(obj){
		dia     = obj.substring(0,2);      // 1-31
		mes     = obj.substring(3,5);      // 0-11 (zero=janeiro)
		ano4    = obj.substring(6,10);      // 4 dígitos
		mes = parseInt(mes) +1;
		if(mes >= 13){
			mes = 1;
			// alert(ano4);
			ano4 = parseInt(ano4) +1;
		}
		if(mes<10){
			mes = "0"+mes.toString();
		}
		var ret = dia.toString()+"/"+mes.toString()+"/"+ano4.toString();
		// alert(dia);
		// alert(mes);
		// alert(ano4);
		return ret;
	}
	
	function formatoReal(evento,objeto) {
		var keypress=(window.event)?event.keyCode:evento.which;
		campo = eval (objeto);
		caracteres = '0123456789';
		n =  caracteres.indexOf( String.fromCharCode(keypress) ) ;
		if ( (n != -1) && (campo.value.length < (13)) )
		{
			str = campo.value ;
			str = str.replace(".","");
			if(str.length == 1){
				var resp = "." + str.substr(-2) ;
				campo.value = resp ;
			} else if(str.length >= 2){
				var resp = str.substr(0,campo.value.length-2) + "." + str.substr(-1) ;
				campo.value = resp ;
			}
		}
		else
			event.returnValue = false;
	}

	function Limpar(obj){
		document.getElementById(obj).reset();
	}

	function UpCase(obj){
		obj.value = obj.value.toUpperCase() ;
	}

	function text_digitando(obj,ref){
		$id = obj.name;
		document.getElementById($id).style.color = "black" ;
		document.getElementById($id).style.backgroundColor = "white" ;
	}

	function text_saindo(obj,ref){
		$id = obj.name;
		document.getElementById($id).style.color = "white" ;
		document.getElementById($id).style.backgroundColor = "#192EC9" ;
		obj.value = obj.value.toUpperCase() ;
	}
	
	function mascaraData( campo, e )
	{
		var kC = (document.all) ? event.keyCode : e.keyCode;
		var data = campo.value;
		
		if( kC!=8 && kC!=46 )
		{
			if( data.length==2 )
			{
				campo.value = data += '/';
			}
			else if( data.length==5 )
			{
				campo.value = data += '/';
			}
			else
				campo.value = data;
		}
	}

	//valida data	   
	function ValidaData(data){
		if(data.value==''){
			digitando(data,2);
			return true;
		}
		exp = /\d{2}\/\d{2}\/\d{4}/;	
		if(!exp.test(data.value)){		
			data.value = "";		
			alert('Data Invalida!');		
		}
		dDia = data.value;
		dDia = dDia.substring(0,2);
		dMes = data.value;
		dMes = dMes.substring(3,5);
		dAno = data.value;
		dAno = dAno.substring(6,10);
		// alert(dDia);
		if( (dDia>'31') || (dMes>'12') || (dAno>'2099') ){
			alert('Data Invalida!');		
			data.value = "";		
		}
		digitando(data,2);
	}

	function FormataData(evento, objeto){
		var keypress=(window.event)?event.keyCode:evento.which;
		campo = eval (objeto);
		if (campo.value == '00/00/0000')
		{
			campo.value="";
		}
	 
		caracteres = '0123456789';
		separacao1 = '/';
		separacao2 = ' ';
		conjunto1 = 2;
		conjunto2 = 5;
		if ((caracteres.search(String.fromCharCode (keypress))!=-1) && campo.value.length < (10))
		{
			if (campo.value.length == conjunto1 )
			campo.value = campo.value + separacao1;
			else if (campo.value.length == conjunto2)
			campo.value = campo.value + separacao1;
		}
		else
			event.returnValue = false;
	}

	function ExibirDIV(div,quero) {
		var display = document.getElementById(div).style.display;
		if(quero=="S"){
			document.getElementById(div).style.display = 'block';
		}else {
			document.getElementById(div).style.display = 'none';
		}
	}
	function ValidarCampo(obj,validos){
		UpCase(obj);
		var valor = obj.value;
		var n1 = validos.indexOf(valor);
		//alert(valor);
		//alert(validos);
		//alert(validos.indexOf(valor));
		//alert(valor.indexOf(validos));
		digitando(obj,2);
		if( n1 < 0 ){
			obj.focus();
			// return false;
		}
	}

	function digitando(obj,ref){
		//alert(ref);
		UpCase(obj);
		if(ref==1){
			obj.style.color = "black" ;
			obj.style.backgroundColor = "white" ;
		}
		if(ref==2){
			obj.style.color = "white" ;
			obj.style.backgroundColor = '#061ED0' ;
		}
	}

	function nPosition(strText,strFind){
		for(x=0; x<=strText.length; x++){
			if( strText.substring(x,(x+1))==strFind ){
				return x;
			}
		}
		return 0;
	}

	function sPedaco(strText,iInicio,iFinal){
		var strReturn = "";
		for(x=0; x<=strText.length; x++){
			if( strText.substring(x,(x+1))==strFind ){
				return x;
			}
			if( (x>=iInicio) && (x<=iFinal) ){
				strReturn = strText.substring(x,(x+1)) + strReturn ;
			}
		}
		return strReturn;
	}

	
</script>
