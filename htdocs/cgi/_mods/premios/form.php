<?php 
require_once 'premios.php';
if ($id) {
    $pesquisa = new premios();
    $pesquisa->busca($id);
    
	$id_premio = $id;
    $id_premios_classificacoe = $pesquisa->id_premios_classificacoe;
    $concurso = $pesquisa->concurso;
    $descricao = $pesquisa->descricao;
    $vinho_premiado = $pesquisa->vinho_premiado;
    $imagem = $pesquisa->imagem;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js">
</script>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_premio?>" name="id_premio" id="id_premio" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">
                Classificação do Prêmio:
            </td>
        </tr>
        <tr>
            <td>
                <select name="id_premios_classificacoe" class="inpute">
                    <? 
                    $pcs = $con_cliente->executa('SELECT * FROM premios_classificacoes ORDER BY classificacao');
                    if ($pcs && mysqli_num_rows($pcs) > 0) {
                        while ($pc = mysqli_fetch_assoc($pcs)) {
                            if ($id_premios_classificacoe == $pc['id_premios_classificacoe']) {
                                echo '<option selected="selected" value="'.$pc['id_premios_classificacoe'].'">'.$pc['classificacao'].'</option>';
                            } else {
                                echo '<option value="'.$pc['id_premios_classificacoe'].'">'.$pc['classificacao'].'</option>';
                            }
                    ?>
                    <? 
                    }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Concurso:
            </td>
        </tr>
        <tr>
            <td>
                <input id="concurso" name="concurso" class="inpute gde obrigatorio" title="Concurso" value="<?=$concurso?>" />
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Vinho Premiado
            </td>
        </tr>
        <tr>
            <td>
                <input id="vinho_premiado" name="vinho_premiado" class="inpute medio obrigatorio" title="Vinho Premiado" value="<?=$vinho_premiado?>" />
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Descrições
            </td>
        </tr>
        <tr>
            <td>
                <textarea id="descricao" name="descricao" title="Descrição"><?=$descricao?></textarea>
            </td>
        </tr>
        <tr>
            <td class="tit_campo">
                Imagem do Prêmio:
            </td>
        </tr>
        <tr>
            <td>
                <?php 
                if ($imagem) {
                    
                ?>
                <img src="http://www.<?=decripfy($_SESSION['dominio'],'h0s7')?>/img_premios/thumbs/<?=$imagem?>" />
                <br/>
                <?php 
                }
                ?>
                <input type="file" name="imagem" id="imagem" class="inpute">
            </td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
            <td>
                <input type="submit" value="Salvar" id="bt_salvar"/>
            </td>
            <td>
                <input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" />
            </td>
        </tr>
    </table>
</form>