<?php
require_once("tags.php");
if($id)	{
	$pesquisa = new tags();
	$pesquisa->busca($id);
	$id_tag = $pesquisa->id_tag;
	$tag = $pesquisa->tag;
}else{
	?>
    <script type="text/javascript">
	function valida_tag(){
		var tag = document.getElementById("tag");
		$.post("<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/valida_tag.php", { tag: escape(tag.value)} ,function(data){
			if(data){
				$("#warning").show();
				$("#stats").html("<strong>"+data+"</strong>");
				$("#botao_warning").html("<input type='button' id='close_warning' value='OK' onClick=$('#warning').hide(); />");
				$("#tag").addClass("invalid");
			}
			else{
				$("#tag").removeClass("invalid");	
			}
		});

	}
	</script>
    <?
	$validator = "return valida_tag();";
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_tag?>" name="id_tag" id="id_tag" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Palavra Chave:</td>
    </tr>
    <tr>
		<td><input type="text" name="tag" id="tag" maxlength="255" class="inpute gde obrigatorio" title="tag" value="<?=$tag?>" /></td>
    </tr>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>