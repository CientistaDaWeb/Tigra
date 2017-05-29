<?php
require_once('jogos.php');
if($id)	{
	$pesquisa = new jogos();
	$pesquisa->busca($id);
	$id_jogo = $pesquisa->id_jogo;
    $id_time_casa = $pesquisa->id_time_casa;
    $id_time_fora = $pesquisa->id_time_fora;
    $data = ajustadata($pesquisa->data,'site');
    $hora = $pesquisa->hora;
    $estadio = $pesquisa->estadio;
    $rodada = $pesquisa->rodada;

    if($estadio == ""){
        $estadio = $con_cliente->query("SELECT estadio_nome FROM times WHERE id_time = $id_time_casa");
        $estadio = $estadio->fetch_assoc();
        $estadio = $estadio['estadio_nome'];
    }
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
$(document).ready(function(){
	$("#data").mask("99/99/9999");
});
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_jogo?>" name="id_jogo" id="id_jogo" />
<table id="formulario">
    <tr>
        <a href="<?=$url_base?>/cgi/<?=$mod?>/form/<?=$id_jogo+1?>">Próximo Jogo</a>
    </tr>
    <tr>
		<td class="tit_campo">Time de casa:</td>
    </tr>
    <tr>
		<td><select id="id_time_casa" name="id_time_casa" class="inpute medio">
        <?php
        $times = $con_cliente->query('SELECT id_time, nome_abreviado FROM times');
        if($times && $times->num_rows > 0){
            while($time = $times->fetch_assoc()){
                $selecionado = '';
                if($time['id_time'] == $id_time_casa){
                    $selecionado = 'selected="selected"';
                }
                ?>
                <option value="<?=$time['id_time']?>" <?=$selecionado?>><?=$time['nome_abreviado']?></option>
                <?php
            }
        }
        ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Time de fora:</td>
    </tr>
    <tr>
		<td><select id="id_time_fora" name="id_time_fora" class="inpute medio">
        <?php
        $times = $con_cliente->query('SELECT id_time, nome_abreviado FROM times');
        if($times && $times->num_rows > 0){
            while($time = $times->fetch_assoc()){
                $selecionado = '';
                if($time['id_time'] == $id_time_fora){
                    $selecionado = 'selected="selected"';
                }
                ?>
                <option value="<?=$time['id_time']?>" <?=$selecionado?>><?=$time['nome_abreviado']?></option>
                <?php
            }
        }
        ?>
        </select></td>
    </tr>
    <tr>
        <td class="tit_campo">Rodada:</td>
    </tr>
    <tr>
        <td><input type="text" name="rodada" id="rodada" maxlength="10" class="inpute pqno" title="Rodada" value="<?=$rodada?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Data:</td>
    </tr>
    <tr>
		<td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Hora:</td>
    </tr>
    <tr>
        <td><input type="text" name="hora" id="hora" maxlength="10" class="inpute pqno" title="Hora" value="<?=$hora?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Estadio:</td>
    </tr>
    <tr>
    	<td><input type="text" name="estadio" id="estadio" maxlength="255" class="inpute medio" title="Est&aacute;dio" value="<?=$estadio?>" /></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>