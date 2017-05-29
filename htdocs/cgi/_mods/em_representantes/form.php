<?php
require_once('representantes.php');
if($id){
	$pesquisa = new representantes();
	$pesquisa->busca($id);
	$id_representante = $pesquisa->id_representante;
    $nome = $pesquisa->nome;
	$cidade = $pesquisa->cidade;
    $estado = $pesquisa->estado;
    $fone = $pesquisa->fone;
    $email = $pesquisa->email;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
<input type="hidden" value="<?=$id_representante?>" name="id_representante" id="id_representante" />
<table id="formulario">
    <tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
        <td><input id="nome" name="nome" class="inpute gde obrigatorio"  value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Cidade:</td>
    </tr>
    <tr>
        <td><input id="cidade" name="cidade" class="inpute gde obrigatorio"  value="<?=$cidade?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Estado:</td>
    </tr>
    <tr>
        <td><select name="estado" id="estado" class="inpute">
        <?php
        $estados = $con_cliente->query('SELECT * FROM estados ORDER BY estado');
        if($estados && $estados->num_rows > 0){
            while($estadiu = $estados->fetch_assoc()){
            ?>
            <option value="<?=$estadiu['uf']?>" <?php if($estadiu['uf'] == $estado){?>selected="selected"<? }?>><?=utf8_encode($estadiu['estado'])?></option>
            <?php
            }
        }
        ?>
        </select></td>
    </tr>
    <tr>
		<td class="tit_campo">Telefones:</td>
    </tr>
    <tr>
        <td><input id="fone" name="fone" class="inpute gde obrigatorio"  value="<?=$fone?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
        <td><input id="email" name="email" class="inpute medio obrigatorio"  value="<?=$email?>" /></td>
    </tr>
</table>
<?php
if($id){
?>
<script type="text/javascript">
function zera_sessao(){
	document.getElementById('fim_sessao_sec').value = '600';
}
function muda_estado(id_estado){
	var permit = document.getElementById('permit'+id_estado);
	if(permit.checked == true){
		var acao = 'remover';
	}else{
		var acao = 'adicionar';
	}

	$.ajax({
		type: "POST",
		url: "<?=$url_base?>/cgi/_mods/em_representantes/upload_estado.php?noob="+ new Date().getTime(),
		data: "id_representante=<?=$id_representante?>&id_estado="+escape(id_estado)+"&acao="+escape(acao)
	});
}
</script>
<div class="subtitulos" id="tit_estado">Estados de Atuação</div>
<div>
    <?php
        $checkbox_stat = array();
        $permissoes = $con_cliente->executa("SELECT * FROM representantes_estados WHERE id_representante = $id_representante");
        if($permissoes && mysqli_num_rows($permissoes)>0){
            while($permissao = mysqli_fetch_assoc($permissoes)){
                $checkbox_stat[$permissao['id_estado']] = 'checked="checked"';
            }
        }
        $estados = $con_cliente->executa("SELECT * FROM estados ORDER BY estado");
        if($estados && mysqli_num_rows($estados)>0){
            while($estadiu = mysqli_fetch_assoc($estados)){
    ?>
            <div class="quatrocolunas">
                <label for="permit<?=$estadiu['id_estado']?>" onclick="muda_estado(<?=$estadiu['id_estado']?>)"><?=utf8_encode($estadiu['estado'])?></label>
                <input type="checkbox" name="permits[]" id="permit<?=$estadiu['id_estado']?>" value="<?=$estadiu['id_estado']?>" <?=$checkbox_stat[$estadiu['id_estado']]?> class="crirHiddenJS"/>
            </div>
    <?php
            }
        }
    ?>
</div>
<?php
}
?>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input type="submit" value="Salvar" id="bt_salvar"/></td>
        <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>