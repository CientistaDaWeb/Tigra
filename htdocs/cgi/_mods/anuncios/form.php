<?php
require_once("$tg_mod.php");
if($id)	{
	$pesquisa = new anuncios();
	$pesquisa->busca($id);
	$id_anuncio = $pesquisa->id_anuncio;
	$id_anunciante = $pesquisa->id_anunciante;
	$altura = $pesquisa->altura;
	$largura = $pesquisa->largura;
	$tamanho = $pesquisa->tamanho;	
	$anuncio = $pesquisa->anuncio;
	$impressoes_contratadas = $pesquisa->impressoes_contratadas;
	$impressoes_efetuadas = $pesquisa->impressoes_efetuadas;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/swf.js"> </script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_anuncio?>" name="id_anuncio" id="id_anuncio" />
<table id="formulario">
	<tr>
    	<td class="tit_campo">Anunciante</td>
    </tr>
    <tr>
    	<td><select name="id_anunciante" id="id_anunciante" class="inpute">
        <?php
		$anunciantes = $con_cliente->executa("SELECT * FROM anunciantes ORDER BY anunciante");
		if($anunciantes && mysqli_num_rows($anunciantes)>0){
			while($anunciante = mysqli_fetch_assoc($anunciantes)){
			?>
            <option value="<?=$anunciante['id_anunciante']?>" <? if($id_anunciante == $anunciante['id_anunciante']){ ?>selected="selected"<? } ?>><?=$anunciante['anunciante']?></option>
            <?
			}			
		}
		?></select>
        </td>
    </tr>
	<tr>
		<td class="tit_campo">Anuncio</td>
    </tr>
    <tr>
		<td>
		<?php
		if($anuncio){
		?>
        <script type="text/javascript">
			var anuncio = new Flash("http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/_swf/anuncios/<?=$anuncio?>", "", "<?=$largura?>", "<?=$altura?>", "false", "transparent");
			anuncio.write();
        </script>
        <br />
        <?php
		}
		?>
        <input type="file" name="anuncio" id="anuncio" class="inpute"></td>
    </tr>
    <tr>
		<td class="tit_campo">Largura</td>
    </tr>
    <tr>
		<td><input type="text" name="largura" id="largura" class="inpute pqno obrigatorio" title="Largura" value="<?=$largura?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Altura:</td>
    </tr>
    <tr>
    	<td><input type="text" name="altura" id="altura" class="inpute pqno obrigatorio" title="Altura" value="<?=$altura?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Impress&otilde;es Contratadas:</td>
    </tr>
    <tr>
		<td><input type="text" name="impressoes_contratadas" id="impressoes_contratadas" class="inpute pqno obrigatorio" title="Impress&otilde;oes Contratadas" value="<?=$impressoes_contratadas?>" /> / <?=$impressoes_efetuadas?></td>
    </tr>
    <tr>
    	<td  class="tit_campo">Tamanho:</td>
    </tr>
    <?php
	$radio_stat = array(1=>'unchecked', 'unchecked', 'unchecked');
	$radio_stat[$tamanho] = 'checked';	
	?>
    <tr>
    	<td class="campo_radio"><label for="radio3" class="radio_<?=$radio_stat[3]?>">Direita</label>
        <input type="radio" name="tamanho" id="radio3" value="3" class="crirHidden" checked="<?=$radio_stat[3]?>"/></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Esquerda</label>
        <input type="radio" name="tamanho" id="radio2" value="2" class="crirHidden" checked="<?=$radio_stat[2]?>" /></td>
    </tr>
    <tr>
    	<td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Meio</label>
        <input type="radio" name="tamanho" id="radio1" value="1" class="crirHidden" checked="<?=$radio_stat[1]?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>