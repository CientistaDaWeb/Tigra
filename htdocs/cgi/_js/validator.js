/*############### Valida Data com ano bissexto e tudo ##################*/
function valida_data(date) {
   var err = 0
   string = date
   var valid = "0123456789/"
   var ok = "yes";
   var temp;
   for (var i=0; i< string.length; i++) {
     temp = "" + string.substring(i, i+1);
     if (valid.indexOf(temp) == "-1") err = 1;
   }
   if (string.length != 10) err=1
   b = string.substring(3, 5)		// month
   c = string.substring(2, 3)		// '/'
   d = string.substring(0, 2)		// day 
   e = string.substring(5, 6)		// '/'
   f = string.substring(6, 10)	// year
   if (b<1 || b>12) err = 1
   if (c != '/') err = 1
   if (d<1 || d>31) err = 1
   if (e != '/') err = 1
   if (f<1850 || f>2050) err = 1
   if (b==4 || b==6 || b==9 || b==11){
     if (d==31) err=1
   }
   if (b==2){
     var g=parseInt(f/4)
     if (isNaN(g)) {
         err=1 
     }
     if (d>29) err=1
     if (d==29 && ((f/4)!=parseInt(f/4))) err=1
   }
   if (err==1) {
    return false;
   }
   else {
    return true;
   }
}
/*############### Valida CPF ##################*/
function valida_CPF(Objcpf){
    var cpf = Objcpf.value;
    exp = /\.|\-/g
    cpf = cpf.toString().replace( exp, "" );
    var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
    var soma1=0, soma2=0;
    var vlr =11;
    
    for(i=0;i<9;i++){
        soma1+=eval(cpf.charAt(i)*(vlr-1));
        soma2+=eval(cpf.charAt(i)*vlr);
        vlr--;
    }    
    soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
    soma2=(((soma2+(2*soma1))*10)%11);
    
    var digitoGerado=(soma1*10)+soma2;
    if(digitoGerado!=digitoDigitado){   
        return false;
	}else{
		return true;	
	}
}

/*########### Valida URL ###############*/
function valida_URL(url){
	var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
}
/*############### Valida CNPJ ##################*/
function valida_CNPJ(ObjCnpj){
    var cnpj = ObjCnpj.value;
    var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
    var dig1= new Number;
    var dig2= new Number;
    
    exp = /\.|\-|\//g
    cnpj = cnpj.toString().replace( exp, "" );
    var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));
        
    for(i = 0; i<valida.length; i++){
        dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);    
        dig2 += cnpj.charAt(i)*valida[i];    
    }
    dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
    dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));
    
    if(((dig1*10)+dig2) != digito){
        return false;
	}else{
		return true;	
	}
        
}
/*############### Mega Validador de Campos (vazio, data, cpf, cnpj, e-mail) #####################*/
function ween_validator(){
	var formStats;
	var mensagem;
	var campo_focus;
	var aguarde = "Aguarde...";
	$("#stats").html(aguarde);
	$(".obrigatorio").each(function(){
		switch($(this).attr("title")){
			case "E-mail":
				if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(this).val())){
					$(this).removeClass("invalid"); 
				}else{
					//$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um e-mail v&aacute;lido.");
					mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um e-mail v&aacute;lido.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				}
			break;
			case "CNPJ":
				if(valida_CNPJ($(this).val())){
					$(this).removeClass("invalid"); 
				}else{
					//$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um CNPJ v&aacute;lido.");
					mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um CNPJ v&aacute;lido.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				}
			break;
			case "CPF":
				if(valida_CPF($(this).val())){
					$(this).removeClass("invalid"); 
				}else{
					//$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um CPF v&aacute;lido.");
					mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com um CPF v&aacute;lido.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				}
			break;
			case "URL":
				if(valida_URL($(this).val())){
					$(this).removeClass("invalid"); 
				}else{
					//$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com uma URL v&aacute;lida.");
					mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com uma URL v&aacute;lida.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				}
			break;
			case "Data":
				 if (valida_data($(this).val())){
					$(this).removeClass("invalid"); 
				 }else{
					 //$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com uma data v&aacute;lida.");
					 mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> deve ser preenchido com uma data v&aacute;lida.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				 }				
			break;
			default:
				if($(this).val() == ""){
					//$("#stats").html("Campo <strong>"+$(this).attr("title")+"</strong> est&aacute; em branco.");
					mensagem = "Campo <strong>"+$(this).attr("title")+"</strong> est&aacute; em branco.";
					$(this).addClass("invalid"); 
					formStats = false;
					campo_focus = $(this);
					return false;
				}else{
					$(this).removeClass("invalid");
				}
			break;
		}
		
  });
	/*$("#botao_warning").html("<input type='button' id='close_warning' value='OK' />");
	$("#close_warning").click(function(){
		$("#warning").hide();
		campo_focus.focus();
	});
	$("#warning").show();*/
	if(mensagem){
		alerta('erro', 'Erro', mensagem);
	}
	return formStats;
}