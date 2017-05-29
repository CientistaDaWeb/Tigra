<?php
require_once('lojas.php');
if($id) {
    $pesquisa = new lojas();
    $pesquisa->busca($id);
    $id_loja = $pesquisa->id_loja;
    $id_estado = $pesquisa->id_estado;
	$nome = $pesquisa->nome;
    $endereco = $pesquisa->endereco;
    $bairro = $pesquisa->bairro;
    $cidade = $pesquisa->cidade;
    $telefone = $pesquisa->telefone;
    $telefone2 = $pesquisa->telefone2;
    $email = $pesquisa->email;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_loja?>" name="id_loja" id="id_loja" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input id="nome" name="nome" class="inpute gde obrigatorio"  value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Endereço:</td>
        </tr>
        <tr>
            <td><input id="endereco" name="endereco" class="inpute gde obrigatorio"  value="<?=$endereco?>" /></td>
        </tr>
		<tr>
            <td class="tit_campo">Bairro:</td>
        </tr>
        <tr>
            <td><input id="bairro" name="bairro" class="inpute gde obrigatorio"  value="<?=$bairro?>" /></td>
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
            <td><select name="id_estado" id="id_estado" class="inpute">
                    <?php
                    $estados = $con_cliente->query('SELECT * FROM estados ORDER BY estado');
                    if($estados && $estados->num_rows > 0) {
                        while($estadiu = $estados->fetch_assoc()) {
                            if($estadiu['id_estado'] == $id_estado) {
                                echo '<option value="'.$estadiu['id_estado'].'" selected="selected">'.$estadiu['uf'].'</option>';
                            }else {
                                echo '<option value="'.$estadiu['id_estado'].'">'.$estadiu['uf'].'</option>';
                            }
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone: (1) <input id="telefone" name="telefone" class="inpute pqueno obrigatorio"  value="<?=$telefone?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone: (2) <input id="telefone2" name="telefone2" class="inpute pqueno"  value="<?=$telefone2?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail:</td>
        </tr>
        <tr>
            <td><input id="email" name="email" class="inpute gde obrigatorio"  value="<?=$email?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>