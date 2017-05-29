 <?php
    require_once("extras.php");
    $id = 1;
    $pesquisa = new extras();
    $pesquisa->busca($id);
    $frete = $pesquisa->frete;
    $vinhos_personalizados = $pesquisa->vinhos_personalizados;
    $embalagens_promocionais = $pesquisa->embalagens_promocionais;
     ?>
    <table id="table_botoes">
        <tr>
            <td><a href="<?=$url_base?>/cgi/<?=$mod?>/form"><img src="_css/_img/btn/btn_editar.png" /> Editar</a></td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td class="subtitulos tit_campo">Frete</td>
        </tr>
        <tr>
            <td><?=$frete?></td>
        </tr>
        <tr>
            <td  class="subtitulos tit_campo">Vinhos Personalizados</td>
        </tr>
        <tr>
            <td><?=$vinhos_personalizados?></td>
        </tr>
        <tr>
            <td  class="subtitulos tit_campo">Embalagens Promocionais</td>
        </tr>
        <tr>
            <td><?=$embalagens_promocionais?></td>
        </tr>
    </table>


