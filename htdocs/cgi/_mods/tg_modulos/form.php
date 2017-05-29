<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new tg_modulos();
	$pesquisa->busca($id);
	$id_tg_modulo = $pesquisa->id_tg_modulo;
	$modulo = $pesquisa->modulo;
	$pasta = decripfy($pesquisa->pasta, 'm0dul0');
	$icone = $pesquisa->icone;
	$titulo = $pesquisa->titulo;
	$descricao = $pesquisa->descricao;
	$tooltip_msg = $pesquisa->tooltip_msg;
	$sql_tabela = $pesquisa->sql_tabela;
	$mensalidade = number_format($pesquisa->mensalidade,2,'.',',');
}else{
?>
	<script type="text/javascript">
	function valida_pasta(){
		var pasta = document.getElementById("pasta");
		$.post("<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/valida_pasta.php", { pasta: escape(pasta.value)} ,function(data){
			if(data){
				$("#warning").show();
				$("#stats").html("<strong>"+data+"</strong>");
				$("#botao_warning").html("<input type='button' id='close_warning' value='OK' onClick=$('#warning').hide(); />");
				$("#pasta").addClass("invalid");
			}
			else{
				$("#pasta").removeClass("invalid");	
			}
		});

	}
	</script>
    <?
	$validator = "return valida_pasta();";
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_tg_modulo?>" name="id_tg_modulo" id="id_tg_modulo" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome do Módulo:</td>
    </tr>
    <tr>
		<td><input type="text" name="modulo" id="modulo" maxlength="255" title="Módulo" class="inpute gde obrigatorio" title="Nome do Módulo" value="<?=$modulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Pasta:</td>
    </tr>
    <tr>
		<td><input type="text" name="pasta" id="pasta" maxlength="255" title="Pasta" class="inpute medio obrigatorio" title="Pasta" value="<?=$pasta?>" onblur="<?=$validator?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Ícone:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($icone){
		?>
        <img src="<?=$url_base?>/_img/modulos/icones/<?=$icone?>" /><br />
        <?php
		}
		?>
        <input type="file" name="icone" id="icone" class="inpute">
        </td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem de Título:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($titulo){
		?>
        <img src="<?=$url_base?>/_img/modulos/titulos/<?=$titulo?>" /><br />
        <?php
		}
		?>
        <input type="file" name="titulo" id="titulo" class="inpute">
	    </td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">Tooltip:</td>
    </tr>
    <tr>
		<td><input type="text" name="tooltip_msg" id="tooltip_msg" maxlength="60" class="inpute gde obrigatorio" title="Tooltip" value="<?=$tooltip_msg?>" /></td>
    </tr>
     <tr>
		<td class="tit_campo">SQL:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="sql_tabela" id="sql_tabela"><?=$sql_tabela?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">Mensalidade:</td>
    </tr>
    <tr>
		<td>R$ <input type="text" name="mensalidade" id="mensalidade" maxlength="7" class="inpute pqno" title="Mensalidade" value="<?=$mensalidade?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="" id="bt_salvar"/></td>
        <td><input type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>