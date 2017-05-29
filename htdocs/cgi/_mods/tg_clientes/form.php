<?php
require_once("$tg_mod.php");
$avaliacao = 1;
if($id) {
    $pesquisa = new tg_clientes();
    $pesquisa->busca($id);
    $id_tg_cliente = $pesquisa->id_tg_cliente;
    $nome = $pesquisa->nome;
    $db_host = decripfy($pesquisa->db_host,'h0s7');
    $db_user = decripfy($pesquisa->db_user,'h0s7');
    $db_pass = decripfy($pesquisa->db_pass,'h0s7');
    $db_dbname = decripfy($pesquisa->db_dbname,'h0s7');
    $ftp_host = decripfy($pesquisa->ftp_host,'h0s7');
    $ftp_user = decripfy($pesquisa->ftp_user,'h0s7');
    $ftp_pass = decripfy($pesquisa->ftp_pass,'h0s7');
    $dominio = decripfy($pesquisa->dominio,'h0s7');
    $logotipo = $pesquisa->logotipo;
    $telefone = $pesquisa->telefone;
    $email = $pesquisa->email;
    $cidade = $pesquisa->cidade;
    $fk_tg_estado = $pesquisa->fk_tg_estado;
    $endereco = $pesquisa->endereco;
    $contato = $pesquisa->contato;
    $data = ajustadata($pesquisa->data,'site');
    $avaliacao = $pesquisa->avaliacao;
    $cep = $pesquisa->cep;
    $documento = $pesquisa->documento;
    $tipo = $pesquisa->tipo;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script>
    $(document).ready(function(){
        $("#data").mask("99/99/9999");
        $("#telefone").mask("(99) 9999-9999");
        $("#cep").mask("99999-999");
<?php if($tipo == 2) { ?>
        $("#documento").mask("999.999.999-99");
    <?php }else { ?>
        $("#documento").mask("99.999.999/9999-99");
    <?php } ?>
        });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_tg_cliente?>" name="id_tg_cliente" id="id_tg_cliente" />
    <table id="formulario">
        <tr>
            <td><select name="tipo" id="tipo" class="inpute medio">
                    <option value="1">Jurídica</option>
                    <option value="2" <?php if($tipo == 2){ echo 'selected';} ?>>Física</option>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Nome" value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Documento:</td>
        </tr>
        <tr>
            <td><input type="text" name="documento" id="documento" maxlength="255" class="inpute gde obrigatorio" title="Docuemento" value="<?=$documento?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Host do Banco de Dados:</td>
        </tr>
        <tr>
            <td><input type="text" name="db_host" id="db_host" maxlength="255" class="inpute medio obrigatorio" title="Host do Banco de Dados" value="<?=$db_host?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Usuário do Banco de Dados:</td>
        </tr>
        <tr>
            <td><input type="text" name="db_user" id="db_user" maxlength="255" class="inpute medio obrigatorio" title="Usuário do Banco de Dados" value="<?=$db_user?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Senha do Banco de Dados:</td>
        </tr>
        <tr>
            <td><input type="text" name="db_pass" id="db_pass" maxlength="255" class="inpute medio obrigatorio" title="Senha do Banco de Dados" value="<?=$db_pass?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome do Banco de Dados:</td>
        </tr>
        <tr>
            <td><input type="text" name="db_dbname" id="db_dbname" maxlength="255" class="inpute medio obrigatorio" title="Nome do Banco de Dados" value="<?=$db_dbname?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Host do FTP:</td>
        </tr>
        <tr>
            <td><input type="text" name="ftp_host" id="ftp_host" maxlength="255" class="inpute medio obrigatorio" title="Host do FTP" value="<?=$ftp_host?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Usuário do FTP:</td>
        </tr>
        <tr>
            <td><input type="text" name="ftp_user" id="ftp_user" maxlength="255" class="inpute medio obrigatorio" title="Usuário do Banco de Dados" value="<?=$ftp_user?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Senha do FTP:</td>
        </tr>
        <tr>
            <td><input type="text" name="ftp_pass" id="ftp_pass" maxlength="255" class="inpute medio obrigatorio" title="Senha do Banco de Dados" value="<?=$ftp_pass?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Domínio:</td>
        </tr>
        <tr>
            <td><input type="text" name="dominio" id="dominio" maxlength="255" class="inpute medio obrigatorio" title="Domínio" value="<?=$dominio?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Logotipo:</td>
        </tr>
        <tr>
            <td>
                <?php
                if($logotipo) {
                    ?>
                <img src="<?=$url_base?>/_img/clientes/<?=$logotipo?>" /><br />
                    <?php
                }
                ?>
                <input type="file" name="logotipo" id="logotipo" class="inpute">
            </td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone:</td>
        </tr>
        <tr>
            <td><input type="text" name="telefone" id="telefone" maxlength="255" class="inpute medio obrigatorio" title="Telefone" value="<?=$telefone?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Contato:</td>
        </tr>
        <tr>
            <td><input type="text" name="contato" id="contato" maxlength="255" class="inpute gde obrigatorio" title="Contato" value="<?=$contato?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail de cobrança:</td>
        </tr>
        <tr>
            <td><input type="text" name="email" id="email" maxlength="255" class="inpute gde obrigatorio" title="E-mail de Cobrança" value="<?=$email?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Cidade:</td>
        </tr>
        <tr>
            <td><input type="text" name="cidade" id="cidade" maxlength="255" class="inpute gde obrigatorio" title="Cidade" value="<?=$cidade?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Estado:</td>
        </tr>
        <tr>
            <td><select name="fk_tg_estado" id="fk_tg_estado" class="inpute medio">
                    <?php
                    $estados = $con_tigra->executa("SELECT * FROM tg_estados ORDER BY estado");
                    while($estado = mysqli_fetch_assoc($estados)) {
                        ?>
                    <option value="<?=$estado['id_tg_estado']?>" <?php if($fk_tg_estado == $estado['id_tg_estado']) { ?> selected="selected" <?php } ?>><?=utf8_encode($estado['estado'])?></option>
                        <?php
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">CEP:</td>
        </tr>
        <tr>
            <td><input type="text" name="cep" id="cep" maxlength="9" class="inpute pqno obrigatorio" title="CEP" value="<?=$cep?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Endereço:</td>
        </tr>
        <tr>
            <td><input type="text" name="endereco" id="endereco" maxlength="255" class="inpute gde obrigatorio" title="Endere&ccedil;o" value="<?=$endereco?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Data:</td>
        </tr>
        <tr>
            <td><input type="text" name="data" id="data" maxlength="10" class="inpute pqno obrigatorio" title="Data" value="<?=$data?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Avaliação</td>
        </tr>
        <?php
        $radio_stat = array(1=>'unchecked','unchecked');
        $radio_stat[$avaliacao] = 'checked';
        ?>
        <tr>
            <td class="campo_radio"><label for="radio1" class="radio_<?=$radio_stat[1]?>">Avaliação</label>
                <input type="radio" name="avaliacao" id="radio1" value="1" class="crirHidden" <?php if($radio_stat[1] == 'checked') {?> checked="checked" <?php }?>/></td>
        </tr>
        <tr>
            <td class="campo_radio"><label for="radio2" class="radio_<?=$radio_stat[2]?>">Aprovado</label>
                <input type="radio" name="avaliacao" id="radio2" value="2" class="crirHidden" <?php if($radio_stat[2] == 'checked') {?> checked="checked" <?php }?> /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>