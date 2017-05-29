<?php
require_once("_mods/jogos/jogos.php");
if($id)	{
	$pesquisa = new jogos();
	$pesquisa->busca($id);
	$id_jogo = $pesquisa->id_jogo;
    $id_time_casa = $pesquisa->id_time_casa;
    $id_time_fora = $pesquisa->id_time_fora;
    $placar_casa = $pesquisa->placar_casa;
    $placar_fora = $pesquisa->placar_fora;
    $time_casa = $con_cliente->query('SELECT nome_abreviado FROM times WHERE id_time = '.$id_time_casa);
    $time_casa = $time_casa->fetch_assoc();
    $time_fora = $con_cliente->query('SELECT nome_abreviado FROM times WHERE id_time = '.$id_time_fora);
    $time_fora = $time_fora->fetch_assoc();
    $data = ajustadata($pesquisa->data,"site");
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_jogo?>" name="id_jogo" id="id_jogo" />
<table id="formulario">
    <tr>
        <td><?=$data?></td>
		<td><?=$time_casa['nome_abreviado']?></td>
        <td><input type="text" name="placar_casa" id="placar_casa" class="inpute" size="2" value="<?=$placar_casa?>" /></td>
        <td>X</td>
        <td><input type="text" name="placar_fora" id="placar_fora" class="inpute" size="2" value="<?=$placar_fora?>" /></td>
        <td><?=$time_fora['nome_abreviado']?></td>
    </tr>
</table>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
<script type="text/javascript">
function fecha_rodada(id_jogo){
    $.ajax({
        type: "POST",
        url: "<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/fecha_rodada.php?noob="+ new Date().getTime(),
        data: "id_jogo=<?=$id_jogo?>",
        success: function(msg){
            $('#fecha_rodada').empty();
            $("#fecha_rodada").append(msg);
        }
    });
}
</script>
<div id="fecha_rodada">
    <a onclick="fecha_rodada(<?=$id_jogo?>)" style="cursor:pointer;">Fazer apostas Randômicas</a>
</div>
</form>