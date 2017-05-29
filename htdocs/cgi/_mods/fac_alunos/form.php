<?php
require_once('fac_alunos.php');
if($id) {
    $pesquisa = new fac_alunos();
    $pesquisa->busca($id);
    $id_fac_aluno = $pesquisa->id_fac_aluno;
    $matricula = $pesquisa->matricula;
    $id_fac_curso = $pesquisa->id_fac_curso;
    $nome = $pesquisa->nome;
    $email = $pesquisa->email;
    $telefone = $pesquisa->telefone;
    $sexo = $pesquisa->sexo;
    $data_nascimento = ajustadata($pesquisa->data_nascimento,'site');
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#data_nascimento").mask("99/99/9999");
        $("#telefone").mask("(99) 9999.9999");
    });
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_fac_aluno?>" name="id_fac_aluno" id="id_fac_aluno" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Matricula:</td>
        </tr>
        <tr>
            <td><input type="text" name="matricula"
                       class="inpute medio obrigatorio" id="matricula" title="Matrícula"
                       value="<?=$matricula?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input type="text" name="nome" class="inpute gde obrigatorio"
                       id="nome" title="Nome" value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail:</td>
        </tr>
        <tr>
            <td><input type="text" name="email" class="inpute gde obrigatorio"
                       id="email" title="E-mail" value="<?=$email?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone:</td>
        </tr>
        <tr>
            <td><input type="text" name="telefone" class="inpute gde obrigatorio"
                       id="telefone" title="Telefone" value="<?=$telefone?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Sexo:</td>
        </tr>
        <tr>
            <td><select name="sexo" id="sexo" class="inpute">
                    <option value="Feminino" <? if($sexo == 'Feminino') {?>
                            selected="selected" <? }?>>Feminino</option>
                    <option value="Masculino" <? if($sexo == 'Masculino') {?>
                            selected="selected" <? }?>>Masculino</option>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Data de nascimento:</td>
        </tr>
        <tr>
            <td><input type="text" name="data_nascimento"
                       class="inpute pqno obrigatorio" id="data_nascimento"
                       title="Data de Nascimento" value="<?=$data_nascimento?>" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
            <td><input type="button" value="Cancelar"
                       onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'"
                       id="bt_cancelar" /></td>
        </tr>
    </table>
    <h3 class="subtitulos">Trocar senha do Aluno!</h3>
</form>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post"
      enctype="multipart/form-data" id="form_edicao">
    <input type="hidden"
           value="<?=$id_fac_aluno?>" name="id_fac_aluno" id="id_fac_aluno" />
    <input type="hidden"
           value="<?=$matricula?>" name="matricula" id="matricula" />
    <input type="hidden"
           value="<?=$id_fac_aluno?>" name="trocasenha" id="trocasenha" />

    <table>
        <tr>
            <td class="tit_campo">Senha Nova:</td>
        </tr>
        <tr>
            <td><input type="password" name="senhanova"
                       class="inpute gde" id="senhanova" title="Senha Nova"
                       value="" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
        </tr>
    </table>
</form>
