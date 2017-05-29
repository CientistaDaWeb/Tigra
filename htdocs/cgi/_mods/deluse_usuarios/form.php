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
require_once("usuarios.php");
if($id) {
    $pesquisa = new usuarios();
    $pesquisa->busca($id);
    $id_usuario = $pesquisa->id_usuario;
    $cnpj_cpf = $pesquisa->cnpj_cpf;
    $rs_nome = $pesquisa->rs_nome;
    $telefone = $pesquisa->telefone;
    $email = $pesquisa->email;
    $senha = $pesquisa->senha;
    $atividade = $pesquisa->atividade;
    $aprovado = $pesquisa->aprovado;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator(); <?=$validator?>">
    <input type="hidden" value="<?=$id_usuario?>" name="id_usuario" id="id_usuario" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">CNPJ/CPF:</td>
        </tr>
        <tr>
            <td><input type="text" name="cnpj_cpf" id="cnpj_cpf" maxlength="255" class="inpute gde obrigatorio" title="CNPJ/CPF:" value="<?=$cnpj_cpf?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Razão Social/Nome</td>
        </tr>
        <tr>
            <td><input type="text" name="rs_nome" id="rs_nome" maxlength="255" class="inpute gde obrigatorio" title="Razão Social/Nome" value="<?=$rs_nome?>" /></td>
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
            <td class="tit_campo">Senha</td>
        </tr>
        <tr>
            <td><input type="text" name="senha" id="senha" maxlength="255" class="inpute gde obrigatorio" title="Senha" value="<?=$senha?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Atividade principal da Empresa</td>
        </tr>
        <tr>
            <td><input type="atividade" name="atividade" id="atividade" maxlength="255" class="inpute gde obrigatorio" title="Atividade" value="<?=$atividade?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Usuário Aprovado</td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="stats_aprovado" value="<?=$aprovado?>" />
                <input type="radio" name="aprovado" value="2" <?php if($aprovado == 2) echo 'checked'?>/> Aprovado<br>
                <input type="radio" name="aprovado" value="1" <?php if($aprovado == 1) echo 'checked'?>/> Não Aprovado<br>
        </tr>
        <tr>
            <td class="tit_campo">Ao Aprovar o Usuário, ele automaticamente irá receber uma email com os dados cadastras e a senha de acesso.</td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input class="btn_salvar" type="submit" value="" id="bt_salvar"/></td>
            <td><input class="btn_voltar" type="button" value="" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
    <?php
    if($aprovado == 1) {
        $query = "SELECT data_hora FROM usuarios_logs WHERE id_usuario = $id";
        $busca = $con_cliente->executa($query);
        if($busca && mysqli_num_rows($busca)>0) {
            ?>
    <br/>
    <hr><br/>
    <table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>Data e Hora de um total de <b><?= mysqli_num_rows($busca)?></b> acesso(s)</th>
            </tr>
        </thead>
        <tbody>
                    <?php
                    while($item = mysqli_fetch_assoc($busca)) {
                        $i = 0;
                        $zebrado = array('even','odd');
                        ?>
            <tr class="<?=$zebrado[$i%2]?>">
                <td><?php echo ajustadata($item['data_hora'], 'timestamp') ?></td>
            </tr>
                        <?php
                        $i++;
                    }
                    ?>
        </tbody>
    </table>
            <?php
        }
    }
    ?>
</form>