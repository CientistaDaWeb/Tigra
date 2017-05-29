<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new eventos();
	$pesquisa->busca($id);
	$id_evento = $pesquisa->id_evento;
	$evento = $pesquisa->evento;
	$subtitulo = $pesquisa->subtitulo;
	$local = $pesquisa->local;
	$descricao = $pesquisa->descricao;
	$imagem = $pesquisa->imagem;
	$data = ajustadata($pesquisa->data,"site");
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_evento?>" name="id_evento" id="id_evento" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Evento</td>
    </tr>
    <tr>
		<td><input type="text" name="evento" id="evento" maxlength="255" class="inpute gde obrigatorio" title="Evento" value="<?=$evento?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Subtítulo:</td>
    </tr>
    <tr>
		<td><input type="text" name="subtitulo" id="subtitulo" maxlength="255" class="inpute gde" title="Subtítulo" value="<?=$subtitulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Local:</td>
    </tr>
    <tr>
    	<td><input type="text" name="local" id="local" maxlength="255" class="inpute gde" title="Local" value="<?=$local?>" /></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem de Capa:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/eventos/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Descrição:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" name="descricao" id="descricao"><?=$descricao?></textarea></td>
    </tr>
    <tr>
		<td class="tit_campo">Data:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>
<?php
if($id_evento){
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script>
function deleta_foto(id){
	zera_sessao();
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload.php?noob="+ new Date().getTime(),
		data: "fk_evento=<?=$id_evento?>&del_item="+id,
		success: function(msg){
			$('#fotos').empty();
			$("#fotos").append(msg);
		}
	
	});
}
function atualiza_foto(id){
	zera_sessao();
	var legenda = document.getElementById('legenda['+id+']').value;
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload.php?noob="+ new Date().getTime(),
		data: "fk_evento=<?=$id_evento?>&id_eventos_foto="+escape(id)+"&legenda="+escape(legenda),
		success: function(msg){
			$('#fotos').empty();
			$("#fotos").append(msg);
		}
	
	});
}
function zera_sessao(){
	document.getElementById('fim_sessao_sec').value = '600';
}
</script>
	<div class="subtitulos">Fotos do Evento</div>
    <form id="upload_flash" enctype="multipart/form-data" method="POST">
    <input type="hidden" value="<?=$id_evento?>" name="fk_evento" id="fk_evento" />
    <div id="upload_form">
    <table>
    <tr>
		<td class="tit_campo">Foto:</td>
    </tr>
    <tr>
    	<td><input type="file" id="foto" name="foto" class="inpute gde"  value="Procurar"/></td>
    </tr>
    <tr>
		<td class="tit_campo">Legenda:</td>
    </tr>
    <tr>
		<td><input type="text" class="inpute medio" maxlength="255" name="legenda" id="legenda" /></td>
    </tr>
    <tr>
    	<td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/upload.php','fotos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Enviar</button></td>
     
    </tr>
    </table>        
    </div>
    </form>
	<div id="fotos">
<?php
	$fotos = $con_cliente->executa("SELECT * FROM eventos_fotos WHERE fk_evento = $id_evento");
	if($fotos && mysqli_num_rows($fotos)>0){
		while($foto = mysqli_fetch_assoc($fotos)){
?>
		<div class="miniatura">
        	<p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/eventos/fotos/thumbs/<?=$foto['foto']?>" /></p>
            <p><input type="text" class="inpute pqno" id="legenda[<?=$foto['id_eventos_foto']?>]" name="legenda[<?=$foto['id_eventos_foto']?>]" value="<?=$foto['legenda']?>" /></p>
            <p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_eventos_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_eventos_foto']?>);" style="cursor:pointer">Editar</a></p>
        </div>
<?php
		}
	}else{
	echo("<p class='vazio'>Não existem fotos cadastradas</p>");
	}
	echo("</div>");
}
?>