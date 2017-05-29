<?php
require_once("_mods/tg_usuarios/tg_usuarios.php");
$falhou = false;
if($id)	{
	$pesquisa = new tg_usuarios();
	$pesquisa->busca($id);
	$id_tg_usuario = $pesquisa->id_tg_usuario;
	$nome = $pesquisa->nome;
	$usuario = $pesquisa->usuario;
	$senha = $pesquisa->senha;
	$email = $pesquisa->email;
	$fk_tg_cliente = $pesquisa->fk_tg_cliente;
	if($fk_tg_cliente != $_SESSION['id_tg_cliente']){
		$falhou = true;
	}
	$validator = "";
}else{
	?>
    <script type="text/javascript">
	function valida_usuario(){
		var usuario = document.getElementById("usuario");
		$.post("<?=$url_base?>/cgi/_mods/<?=$tg_mod?>/valida_usuario.php", { usuario: escape(usuario.value), id_tg_cliente: "<?=$_SESSION['id_tg_cliente']?>" } ,function(data){
			if(data){
				$("#warning").show();
				$("#stats").html("<strong>"+data+"</strong>");
				$("#botao_warning").html("<input type='button' id='close_warning' value='OK' onClick=$('#warning').hide(); />");
				$("#usuario").addClass("invalid");
			}
			else{
				$("#usuario").removeClass("invalid");	
			}
		});

	}
	</script>
    <?
	$validator = "return valida_usuario();";
}
if(!$falhou){
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
<input type="hidden" value="<?=$id_tg_usuario?>" name="id_tg_usuario" id="id_tg_usuario" />
<table id="formulario">
	<tr>
		<td class="tit_campo">Nome:</td>
    </tr>
    <tr>
		<td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Usuário:</td>
    </tr>
    <tr>
		<td><input type="text" name="usuario" id="usuario" maxlength="255" class="inpute medio obrigatorio" title="Usuário" value="<?=$usuario?>" onblur="<?=$validator?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">Senha:</td>
    </tr>
    <tr>
		<td><input type="password" name="senha" id="senha" maxlength="255" class="inpute medio obrigatorio" title="Senha" value="<?=$senha?>" /></td>
    </tr>
    <tr>
		<td class="tit_campo">E-mail:</td>
    </tr>
    <tr>
		<td><input type="text" name="email" id="email" maxlength="255" class="inpute gde obrigatorio" title="E-mail" value="<?=$email?>" /></td>
    </tr>
</table>
<div class="duascolunas"><label for="enviar_senha">Enviar Senha</label><input type="checkbox" name="enviar_senha" id="enviar_senha" value="1" class="crirHiddenJS"/></div>
    <?php
		$categorias = $con_tigra->executa("SELECT * FROM tg_cat_modulos WHERE fk_tg_cliente = $_SESSION[id_tg_cliente] ORDER BY categoria");
		if($categorias && mysqli_num_rows($categorias)>0){
			while($categoria = mysqli_fetch_assoc($categorias)){
				$modulos = $con_tigra->executa("SELECT * FROM tg_catxmodulos WHERE fk_tg_cat_modulo = $categoria[id_tg_cat_modulo]");
				if($modulos && mysqli_num_rows($modulos)>0){
				?>
                <div class="subtitulos"><?=$categoria['categoria']?></div>
                <?
					while($modulo = mysqli_fetch_assoc($modulos)){
						$nome = $con_tigra->executa("SELECT tooltip_msg FROM tg_modulos WHERE id_tg_modulo = $modulo[fk_tg_modulo]");
						$nome = mysqli_fetch_assoc($nome);
						$tem = false;
						$permissao = $con_tigra->executa("SELECT * FROM tg_permissoes WHERE fk_tg_modulo = $modulo[fk_tg_modulo] AND fk_tg_cat_modulo = $categoria[id_tg_cat_modulo] AND fk_tg_usuario = $id_tg_usuario");
						if($permissao && mysqli_num_rows($permissao)>0){
							$tem = true;	
						}
					?>
                    <div class="duascolunas">
                    <label for="permit<?=$modulo['fk_tg_modulo']?>"><?=$nome['tooltip_msg']?></label>
                    <input type="checkbox" name="permits[]" id="permit<?=$modulo['fk_tg_modulo']?>" value="<?=$modulo['fk_tg_modulo']?>/<?=$categoria['id_tg_cat_modulo']?>" <?php if($tem){ ?> checked="checked" <?php } ?> class="crirHiddenJS"/>
                    </div>
                    <?
					}
				}
			}
		}else{
		echo("<div><span class='vazio'>Crie uma categoria de módulos para esse cliente antes.</span></div>");
		}
	?>
<table id="table_botoes_rodape">
	<tr>	
    	<td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
        <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
    </tr>
</table>
</form>
<?php
}else{
	require_once("666.php");
}
?>