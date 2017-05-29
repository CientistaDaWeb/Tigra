ddaccordion.init({
	headerclass: "categoria", 
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click" or "mouseover
	mouseoverdelay: 100, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: "", //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ 
	}
})
/*############### Formul�rio que deleta os itens #####################*/
function valida_deletar(){
	$("#stats").html("Deseja realmente deletar esses itens?");
	$("#botao_warning").html("<input type='button' id='del_sim' value='Sim' /> <input type='button' id='del_nao' value='N�o' />");
	$("#warning").show();
	$("#del_sim").click(function (){
		if(($(":checkbox:checked").length)==0){
			$("#stats").html("Voc&ecirc; deve selecionar algo para ser exclu&iacute;do!");
			$("#botao_warning").html("<input type='button' id='close_warning' value='OK' />");
			$("#close_warning").click(function(){
				$("#warning").hide();
			});
		}else{
			$("#form_deletar").submit();
			$("#warning").hide();
		}
	});
	$("#del_nao").click(function(){
		close_warning();
	});
	return false;
}
/*############### Fechar Warning ################*/
function close_warning(aonde){
	$("#warning").hide();
	if(aonde){
		window.location = aonde;	
	}
}
$(document).ready(function(){
	/*###### tooltip das categorias #####*/
	$("#modulos label").tooltip({ 
		track: true, 
		delay: 0, 
		showURL: false, 
		showBody: " - ", 
		extraClass: "pretty", 
		fixPNG: true, 
		opacity: 0.95, 
		left: -92
	});
});

function check_all(){
	var select_all = document.getElementById('select_all');
	/*if(select_all.checked){
		var classadd = "checkbox_checked";
		var classremove = "checkbox_unchecked";
	}else{
		var classadd = "checkbox_unchecked";
		var classremove = "checkbox_checked";
	}*/
	var checked_status = select_all.checked;
	$(":checkbox").each(function(){ 
		this.checked = checked_status;
		/*$("#label"+this.value).removeClass(classremove);
		$("#label"+this.value).addClass(classadd);*/
	});
	
}
function alerta(tipo, titulo, mensagem){
	if(tipo == 'sucesso'){
		$.modaldialog.success(mensagem, {title:titulo, width: 300, timeout: 3});
	}
	if(tipo == 'erro'){
		$.modaldialog.error(mensagem, {title:titulo, width: 300});
	}
	if(tipo == 'atencao'){
		$.modaldialog.warning(mensagem, {title:titulo, width: 300});
	}
	if(tipo == 'confirmacao'){
		$.modaldialog.prompt(mensagem, {title:titulo, width: 300});
	}
}
$(document).ready(function(){
    $("#searchtext").keyup(function(){
        var palavra = document.getElementById("searchtext").value;
        busca(palavra);
    });
});