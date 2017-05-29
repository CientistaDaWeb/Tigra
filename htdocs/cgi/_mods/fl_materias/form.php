<?php
require_once("_mods/fl_materias_redator/materias.php");
$status = 1;
if($id)	{
	$pesquisa = new materias();
	$pesquisa->busca($id);
	$id_materia = $pesquisa->id_materia;
	$titulo = $pesquisa->titulo;
	$linha_apoio = $pesquisa->linha_apoio;
	$texto = $pesquisa->texto;
	$id_materias_categoria = $pesquisa->id_materias_categoria;
	$id_materias_subcategoria = $pesquisa->id_materias_subcategoria;
	$id_redatore = $pesquisa->id_redatore;
	$status = $pesquisa->status;
	$imagem = $pesquisa->imagem;
	$legenda_foto = $pesquisa->legenda_foto;
	$credito_foto = $pesquisa->credito_foto;
	$video_link = $pesquisa->video_link;
	$video_tipo = $pesquisa->video_tipo;
}
if(($id_redatore == $_SESSION['id_tg_usuario'] && $status != 2) || $id == ""){
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator();">
<input type="hidden" value="<?=$id_materia?>" name="id_materia" id="id_materia" />
<table id="formulario">
	<tr>
    	<td class="tit_campo">Categoria / Subcategoria:</td>
    </tr>
    <tr>
    	<td><select name="categoria" class="inpute">
        	<?php
			$categorias = $con_cliente->executa("SELECT * FROM materias_categorias, materias_subcategorias WHERE materias_categorias.id_materias_categoria = materias_subcategorias.id_materias_categoria ORDER BY categoria");
			if($categorias && mysqli_num_rows($categorias)>0){
				while($categoria = mysqli_fetch_assoc($categorias)){
					if($categoria['id_materias_subcategoria'] == $id_materias_subcategoria){
						$categoria_sel[$categoria['id_materias_subcategoria']] = 'selected ="selected"';
                        $cat = $categoria['cat'];
                        $subcat = $categoria['subcat'];
					}
				?>
                <option value="<?=$categoria['id_materias_categoria']?>,<?=$categoria['id_materias_subcategoria']?>" <?=$categoria_sel[$categoria['id_materias_subcategoria']]?>><?=$categoria['categoria']?> - <?=$categoria['subcategoria']?></option>
                <?php
				}
			}
			?>        
        </select></td>
    </tr>
	<tr>
		<td class="tit_campo">Titulo:</td>
    </tr>
    <tr>
		<td><input type="text" name="titulo" id="titulo" maxlength="255" class="inpute gde obrigatorio" title="T&iacute;tulo" value="<?=$titulo?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Linha de Apoio:</td>
    </tr>
    <tr>
		<td><input type="text" name="linha_apoio" id="linha_apoio" maxlength="70" class="inpute gde" title="Linha de Apoio" value="<?=$linha_apoio?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Texto:</td>
    </tr>
    <tr>
    	<td><textarea class="inpute" title="Texto" name="texto" id="texto" rows="15"><?=$texto?></textarea></td>
    </tr>
    <tr>
    	<td class="tit_campo">Imagem:</td>
    </tr>
    <tr>
    	<td>
    	<?php
		if($imagem){
		?>
        <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_img/materias/thumbs/<?=$imagem?>" /><br />
        <?php
		}
		?>
        <input type="file" name="imagem" id="imagem" class="inpute">
        </td>
    </tr>
    <tr>
		<td class="tit_campo">Legenda:</td>
    </tr>
    <tr>
		<td><input type="text" name="legenda_foto" id="legenda_foto" maxlength="255" class="inpute gde" title="Legenda da foto" value="<?=$legenda_foto?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cr&eacute;ditos:</td>
    </tr>
    <tr>
		<td><input type="text" name="credito_foto" id="credito_foto" maxlength="255" class="inpute gde" title="Cr&eacute;ditos da foto" value="<?=$credito_foto?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">V&iacute;deo:</td>
    </tr>   
    <tr>
		<td>
	<?php
	if($video_link){
		if($video_tipo == 1){
		?>
		<object width="160" height="130"><param name="movie" value="http://www.youtube.com/v/<?=$video_link?>&hl=pt-br&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/<?=$video_link?>&hl=pt-br&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="160" height="130"></embed></object>
		<?php
		}else{
		?>
    	<embed src="http://blip.tv/play/<?=$video_link?>" type="application/x-shockwave-flash" width="160" height="130" allowscriptaccess="always" allowfullscreen="true"></embed>
    <?php
		}
	}
	?>
    <input type="text" name="video_link" id="video_link" maxlength="255" class="inpute gde" title="V&iacute;deo" value="<?=$video_link?>" /></td>
    </tr>
	<tr>
		<td class="tit_campo">Tipo do V&iacute;deo:</td>
	</tr>
	<tr>
		<td><select class="inpute medio" name="video_tipo" id="video_tipo">
			<option value="1" <?php if($video_tipo == 1){?>selected="selected"<?php }?>>Youtube</option>
			<option value="2" <?php if($video_tipo == 2){?>selected="selected"<?php }?>>Blip.TV</option>
		</select>
		</td>
	</tr>
    <tr>
    	<td class="tit_campo">Status de Publica&ccedil;&atilde;o:</td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked', 'unchecked');
	$radio_stat[$status] = 'checked';
	?>
    <tr>
    	<td class="campo_radio"><label for="radio3" class="radio_<?=$radio_stat[3]?>">Aguardando Aprova&ccedil;&atilde;o</label>
        <input type="radio" name="status" id="radio3" value="3" class="crirHidden" <?php if($radio_stat[3] == 'checked'){?> checked="checked" <?php }?> /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Rascunho</label>
        <input type="radio" name="status" id="radio1" value="1" class="crirHidden" <?php if($radio_stat[1] == 'checked'){?> checked="checked" <?php }?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        <?php
		if($id){
		?>
        <td><a href="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/<?=$cat?>/<?=$subcat?>/<?=$id?>/" id="bt_visualizar" target='_blank'>Visualizar Notícia</a></td>
        <?php
        }
        ?>
    </tr>
</table>
</form>
<?php
if($id){
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/micoxUpload.js"> </script>
<script>
$(document).ready(function(){
	$("#div_foto").hide();
	$("#div_audio").hide();
	$("#div_video").hide();
	$("#div_tag").hide();
	$("#tit_foto").click(function(){
		$("#div_foto").toggle();		  
	});
	$("#tit_audio").click(function(){
		$("#div_audio").toggle();		  
	});
	$("#tit_tag").click(function(){
		$("#div_tag").toggle();		  
	});
	$("#tit_video").click(function(){
		$("#div_video").toggle();		  
	});
});
function deleta_foto(id){
	zera_sessao();
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_fotos.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&del_item="+id,
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
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_fotos.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&id_materias_foto="+escape(id)+"&legenda="+escape(legenda),
		success: function(msg){
			$('#fotos').empty();
			$("#fotos").append(msg);
		}
	
	});
}
function deleta_audio(id){
	zera_sessao();
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_audios.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&del_item="+id,
		success: function(msg){
			$('#audios').empty();
			$("#audios").append(msg);
		}
	
	});
}
function atualiza_audio(id){
	zera_sessao();
	var titulo = document.getElementById('titulo['+id+']').value;
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_audios.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&id_materias_audio="+escape(id)+"&titulo="+escape(titulo),
		success: function(msg){
			$('#audios').empty();
			$("#audios").append(msg);
		}
	
	});
}
function deleta_video(id){
	zera_sessao();
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_videos.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&del_item="+id,
		success: function(msg){
			$('#videos').empty();
			$("#videos").append(msg);
		}
	
	});
}
function zera_sessao(){
	document.getElementById('fim_sessao_sec').value = '600';
}
function muda_tag(id_tag){
	var permit = document.getElementById('permit'+id_tag);
	if(permit.checked == true){
		var acao = 'remover';
	}else{
		var acao = 'adicionar';
	}
	
	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_tag.php?noob="+ new Date().getTime(),
		data: "id_materia=<?=$id_materia?>&id_tag="+escape(id_tag)+"&acao="+escape(acao)
	});
}
</script>
<div class="subtitulos" id="tit_tag">Palavras Chave</div>
<div id="div_tag">
    <form id="upload_tag" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?=$id_materia?>" name="id_materia" id="id_materia" />
        <div>
        <table>
        <tr>
            <td class="tit_campo" colspan="2">Palavra:</td>
        </tr>
        <tr>
            <td><input type="text" class="inpute medio" maxlength="255" name="tag" id="tag" /></td>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_tag.php','tags','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Adicionar</button></td>
        </tr>
        </table>        
        </div>
        </form>
        <div id="tags">
    <?php
        $checkbox_stat = array();
        $permissoes = $con_cliente->executa("SELECT * FROM tag_materias WHERE id_materia = $id_materia");
        if($permissoes && mysqli_num_rows($permissoes)>0){
            while($permissao = mysqli_fetch_assoc($permissoes)){
                $checkbox_stat[$permissao['id_tag']] = 'checked="checked"';
            }
        }
        $tags = $con_cliente->executa("SELECT * FROM tags ORDER BY tag");
        if($tags && mysqli_num_rows($tags)>0){
            while($tag = mysqli_fetch_assoc($tags)){
    ?>
            <div class="quatrocolunas">
                <label for="permit<?=$tag['id_tag']?>" onclick="muda_tag(<?=$tag['id_tag']?>)"><?=$tag['tag']?></label>
                <input type="checkbox" name="permits[]" id="permit<?=$tag['id_tag']?>" value="<?=$tag['id_tag']?>" <?=$checkbox_stat[$tag['id_tag']]?> class="crirHiddenJS"/>
            </div>
    <?php
            }
        }
    ?>
    	</div>
</div>
<div class="subtitulos" id="tit_foto">Galeria de Fotos</div>
<div id="div_foto">
    <form id="upload_flash" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?=$id_materia?>" name="id_materia" id="id_materia" />
        <div>
        <table>
        <tr>
            <td class="tit_campo">Foto:</td>
        </tr>
        <tr>
            <td><input type="file" id="foto" name="foto" class="inpute gde"  value="Procurar"/></td>
        </tr>
        <tr>
            <td class="tit_campo">Legenda - Cr&eacute;ditos:</td>
        </tr>
        <tr>
            <td><input type="text" class="inpute medio" maxlength="255" name="legenda" id="legenda" /></td>
        </tr>
        <tr>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_fotos.php','fotos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Enviar</button></td>
        </tr>
        </table>        
        </div>
        </form>
        <div id="fotos">
    <?php
        $fotos = $con_cliente->executa("SELECT * FROM materias_fotos WHERE id_materia = $id_materia");
        if($fotos && mysqli_num_rows($fotos)>0){
            while($foto = mysqli_fetch_assoc($fotos)){
    ?>
            <div class="miniatura">
                <p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/materias/galeria/thumbs/<?=$foto['foto']?>" /></p>
                <p><input type="text" class="inpute pqno" id="legenda[<?=$foto['id_materias_foto']?>]" name="legenda[<?=$foto['id_materias_foto']?>]" value="<?=$foto['legenda']?>" /></p>
                <p style="text-align:center"><a onclick="deleta_foto(<?=$foto['id_materias_foto']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_foto(<?=$foto['id_materias_foto']?>);" style="cursor:pointer">Editar</a></p>
            </div>
    <?php
            }
        }else{
        echo("<p class='vazio'>N&atilde;o tem fotos cadastradas!</p>");
        }
    ?>
    </div>
</div>
<div class="subtitulos" id="tit_video">Galeria de V&iacute;deos</div>
<div id="div_video">
    <form id="upload_flash" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?=$id_materia?>" name="id_materia" id="id_materia" />
        <div>
        <table>
        <tr>
            <td class="tit_campo">V&iacute;deo:</td>
        </tr>
        <tr>
            <td><input type="text" class="inpute medio" maxlength="255" name="video" id="video" /></td>
        </tr>
		<td class="tit_campo">Tipo do V&iacute;deo:</td>
		</tr>
		<tr>
			<td><select class="inpute medio" name="video_server" id="video_server">
				<option value="1">Youtube</option>
				<option value="2">Blip.TV</option>
			</select>
			</td>
		</tr>
        <tr>
            <td class="tit_campo">Imagem:</td>
        </tr>
        <tr>
            <td><input type="file" id="imagem" name="imagem" class="inpute gde"  value="Procurar"/></td>
        </tr>
        <tr>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_videos.php','videos','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Enviar</button></td>
         
        </tr>
        </table>        
        </div>
        </form>
        <div id="videos">
    <?php
        $videos = $con_cliente->executa("SELECT * FROM materias_videos WHERE id_materia = $id_materia");
        if($videos && mysqli_num_rows($videos)>0){
            while($video = mysqli_fetch_assoc($videos)){
    ?>
            <div class="miniatura">
                <p class="foto_miniatura"><img src="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_img/materias/videos/<?=$video['imagem']?>" /></p>
                <p><input type="text" class="inpute pqno" id="titulo_video[<?=$video['id_materias_video']?>]" name="titulo_video[<?=$video['id_materias_video']?>]" value="<?=$video['titulo']?>" /></p>
                <p style="text-align:center"><a onclick="deleta_video(<?=$video['id_materias_video']?>);" style="cursor:pointer">Excluir</a></p>
            </div>
    <?php
            }
        }else{
        echo("<p class='vazio'>N&atilde;o tem v&iacute;deos cadastrados!</p>");
        }
    ?>
    </div>
</div>
<div class="subtitulos" id="tit_audio">Galeria de Audios</div>
<div id="div_audio">
    <form id="upload_flash" enctype="multipart/form-data" method="POST">
        <input type="hidden" value="<?=$id_materia?>" name="id_materia" id="id_materia" />
        <div>
        <table>
        <tr>
            <td class="tit_campo">Audio:</td>
        </tr>
        <tr>
            <td><input type="file" id="audio" name="audio" class="inpute gde"  value="Procurar"/></td>
        </tr>
        <tr>
            <td class="tit_campo">Titulo:</td>
        </tr>
        <tr>
            <td><input type="text" class="inpute medio" maxlength="255" name="titulo" id="titulo" /></td>
        </tr>
        <tr>
            <td><button onClick="micoxUpload(this.form,'<?=$url_base?>/cgi/_mods/fl_materias_redator/upload_audios.php','audios','<div class=carregando></div>Enviando...','Erro ao Enviar'); zera_sessao(); return false;" type="button">Enviar</button></td>
         
        </tr>
        </table>        
        </div>
        </form>
        <div id="audios">
    <?php
        $audios = $con_cliente->executa("SELECT * FROM materias_audios WHERE id_materia = $id_materia");
        if($audios && mysqli_num_rows($audios)>0){
            while($audio = mysqli_fetch_assoc($audios)){
    ?>
            <div class="miniatura">
                <p><a href="http://www.<?=decripfy($_SESSION['dominio'],"h0s7")?>/_audios/<?=$audio['audio']?>" />Ouvir</a></p>
                <p><input type="text" class="inpute pqno" id="titulo[<?=$audio['id_materias_audio']?>]" name="titulo[<?=$audio['id_materias_audio']?>]" value="<?=$audio['titulo']?>" /></p>
                <p style="text-align:center"><a onclick="deleta_audio(<?=$audio['id_materias_audio']?>);" style="cursor:pointer">Excluir</a> | <a onclick="atualiza_audio(<?=$audio['id_materias_audio']?>);" style="cursor:pointer">Editar</a></p>
            </div>
    <?php
            }
        }else{
        echo("<p class='vazio'>N&atilde;o tem audios cadastrados!</p>");
        }
    ?>
    </div>
</div>
<?php
}
}else{
	require_once('666.php');	
}
?>