<?php
require_once('alunos.php');
if ($id) {
    $pesquisa = new alunos();
    $pesquisa->busca($id);
    $id_aluno = $pesquisa->id_aluno;
    $id_setor = $pesquisa->id_setor;
    $matricula = $pesquisa->matricula;
    $nome = $pesquisa->nome;
    $email = $pesquisa->email;
    $ativo = $pesquisa->ativo;
}
?>
<script type="text/javascript" src="<?= $url_base ?>/cgi/_js/maskedinput.js"> </script>
<form action="<?= $url_base ?>/cgi/<?= $mod ?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?= $id_aluno ?>" name="id_aluno" id="id_aluno" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Setor:</td>
        </tr>
        <tr>
            <td><select class="inpute gde" name="id_setor" id="id_setor">
                    <?php
                    $query = 'SELECT * FROM setors ORDER BY setor';
                    $categorias = $con_cliente->query($query);
                    if ($categorias && $categorias->num_rows > 0) {
                        while ($categoria = $categorias->fetch_assoc()) {
                            if ($categoria['id_setor'] == $id_setor) {
                                echo '<option value="' . $categoria['id_setor'] . '" selected="selected">' . $categoria['setor'] . '</option>';
                            } else {
                                echo '<option value="' . $categoria['id_setor'] . '">' . $categoria['setor'] . '</option>';
                            }
                            ?>
                            <?php
                        }
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td class="tit_campo">Matricula:</td>
        </tr>
        <tr>
            <td><input type="text" name="matricula" class="inpute medio obrigatorio" id="matricula" title="Matrícula" value="<?= $matricula ?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input type="text" name="nome" class="inpute gde obrigatorio" id="nome" title="Nome" value="<?= $nome ?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail:</td>
        </tr>
        <tr>
            <td><input type="text" name="email" class="inpute gde obrigatorio" id="email" title="E-mail" value="<?= $email ?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Aluno Ativo?</td>
        </tr>
        <tr>
            <td><select id="ativo" name="ativo">
                    <option value="S" <?php echo ($ativo == 'S') ? 'selected="selected"' : ''; ?>>Sim</option>
                    <option value="N" <?php echo ($ativo == 'N') ? 'selected="selected"' : ''; ?>>Não</option>
                </select>
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?= $url_base ?>/cgi/<?= $mod ?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
    <h3 class="subtitulos">Trocar senha do Aluno!</h3>
</form>
<form action="<?= $url_base ?>/cgi/<?= $mod ?>/action" method="post"
      enctype="multipart/form-data" id="form_edicao">
    <input type="hidden" value="<?= $id_aluno ?>" name="id_aluno" id="id_aluno" />
    <input type="hidden" value="<?= $id_setor ?>" name="id_setor" id="id_setor" />
    <input type="hidden" value="<?= $matricula ?>" name="matricula" id="matricula" />
    <input type="hidden" value="1" name="trocasenha" id="trocasenha" />
    <table>
        <tr>
            <td class="tit_campo">Senha Nova:</td>
        </tr>
        <tr>
            <td><input type="password" name="senhanova" class="inpute gde" id="senhanova" title="Senha Nova" value="" /></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar" /></td>
        </tr>
    </table>
</form>

