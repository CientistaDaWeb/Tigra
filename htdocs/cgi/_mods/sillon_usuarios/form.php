<script type="text/javascript">
    $(document).ready(function(){
        $('#lista').dataTable({
            "oLanguage": {
                "sUrl": "<?=$url_base?>/cgi/language/pt_BR.txt"
            },
            "sPaginationType": "full_numbers",
            "iDisplayLength": 25,
            "aaSorting": [[ 2, "desc" ]],
            "aoColumns":[
                {"bSortable": true}
            ]
        });
    });
</script>
<?php
require_once("usuarios_permitidos.php");
if($id) {
    $pesquisa = new usuarios_permitidos();
    $pesquisa->busca($id);
    $id_usuarios_permitido = $pesquisa->id_usuarios_permitido;
    $cnpj = $pesquisa->cnpj;
    $nome = $pesquisa->nome;
    $telefone = $pesquisa->telefone;
    $email = $pesquisa->email;
    $endereco = $pesquisa->endereco;
    $endereco = $pesquisa->endereco;
    $status = $pesquisa->status;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_usuarios_permitido?>" name="id_usuarios_permitido" id="id_usuarios_permitido" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">CNPJ:</td>
        </tr>
        <tr>
            <td><input type="text" name="cnpj" id="cnpj" maxlength="255" class="inpute gde obrigatorio" title="CNPJ/CPF:" value="<?=$cnpj?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome</td>
        </tr>
        <tr>
            <td><input type="text" name="nome" id="nome" maxlength="255" class="inpute gde obrigatorio" title="Razão Social/Nome" value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone</td>
        </tr>
        <tr>
            <td><input type="text" name="telefone" id="telefone" maxlength="255" class="inpute gde obrigatorio" title="Telefone" value="<?=$telefone?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Email</td>
        </tr>
        <tr>
            <td><input type="text" name="email" id="email" maxlength="255" class="inpute gde obrigatorio" title="Email" value="<?=$email?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Endereço</td>
        </tr>
        <tr>
            <td><input type="text" name="endereco" id="endereco" maxlength="255" class="inpute gde obrigatorio" title="Endereço" value="<?=$endereco?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Usuário Aprovado</td>
        </tr>
        <tr>
        <tr>
            <td><select class="inpute gde" name="status" id="status">
                    <option value="2">Não</option>
                    <option value="1" <?php if($status == 1) {
                        echo 'selected="selected"';
                            }?>>Sim</option>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Ao aprovar o Usuário, ele automaticamente irá receber uma email avisando que foi aprovado.</td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>