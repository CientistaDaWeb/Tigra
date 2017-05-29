<?php
require_once('vestibulares.php');
if($id) {
    $pesquisa = new vestibulares();
    $pesquisa->busca($id);
    $id_vestibulare = $pesquisa->id_vestibulare;
    $semestre = $pesquisa->semestre;
    $edicao = $pesquisa->edicao;
    $ano = $pesquisa->ano;
    $insc_data_inicio = ajustadata($pesquisa->insc_data_inicio,'site');
    $insc_data_fim = ajustadata($pesquisa->insc_data_fim,'site');
    $gabarito = $pesquisa->gabarito;

    $gabarito_data = explode(' ',$pesquisa->gabarito_data);
    $gabarito_dt = ajustadata($gabarito_data[0],'site');
    $gabarito_hora = $gabarito_data[1];

    $data = $pesquisa->data;
    $valor_promocional = $pesquisa->valor_promocional;
    $data_promocional = $pesquisa->data_promocional;
    $valor = $pesquisa->valor;
    $manual_candidato = $pesquisa->manual_candidato;
}
?>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskedinput.js"> </script>
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/maskMoney.js"> </script>
<link type="text/css" rel="stylesheet" href="<?=$url_base?>/cgi/_css/datePicker.css" />
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/date.js"> </script>
<!--[if IE]>
    <script type="text/javascript" src="<?=$url_base?>/cgi/_js/bigframe.js"> </script>
<![endif]-->
<script type="text/javascript" src="<?=$url_base?>/cgi/_js/datePicker.js"> </script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tabs").tabs();
        $("#insc_data_inicio,#insc_data_fim, #gabarito_dt, #data, #data_promocional").datePicker({
            startDate: '01/01/2000',
            displayClose : true,
            clickInput : true
        });
        $("#ano").mask("9999");
        $("#gabarito_hora").mask("99:99:99");
        $("#valor").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
        $("#valor_promocional").maskMoney({symbol:"R$ ",decimal:".",thousands:"",showSymbol:false});
    });
</script>
<div id="tabs">
    <ul>
        <li>
            <a href="#tab-vestibular">Vestibular</a>
        </li>
        <li>
            <a href="#tab-inscricoes">Inscrições</a>
        </li>
    </ul>
    <div id="tab-vestibular">
        <form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
            <input type="hidden" value="<?=$id_vestibulare?>" name="id_vestibulare" id="id_vestibulare" />
            <table id="formulario">
                <tr>
                    <td class="tit_campo">Semestre:</td>
                </tr>
                <tr>
                    <td><select class="inpute" name="semestre" id="semestre">
                            <?php
                            for($i=1; $i<3; $i++) {
                                ?>
                            <option value="<?=$i?>"<?php if($semestre == $i) {?>selected<?php }?>><?=$i?></option>
                                <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Edição:</td>
                </tr>
                <tr>
                    <td><select class="inpute" name="edicao" id="edicao">
                            <?php
                            for($i=1; $i<5; $i++) {
                                ?>
                            <option value="<?=$i?>"<?php if($edicao == $i) {?>selected<?php }?>><?=$i?></option>
                                <?php
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td class="tit_campo">Ano:</td>
                </tr>
                <tr>
                    <td><input type="text" name="ano" id="ano" maxlength="4" class="inpute pqno obrigatorio" title="ano" value="<?=$ano?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Gabarito:</td>
                </tr>
                <tr>
                    <td><textarea name="gabarito" class="inpute" id="gabarito" rows="5"><?=$gabarito?></textarea></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data de início da divulgação do gabarito:</td>
                </tr>
                <tr>
                    <td><input type="text" name="gabarito_dt" id="gabarito_dt" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data de início da divulgação do gabarito" value="<?=$gabarito_dt?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Hora de início da divulgação do gabarito:</td>
                </tr>
                <tr>
                    <td><input type="text" name="gabarito_hora" id="gabarito_hora" maxlength="10" class="inpute medio obrigatorio" title="Hora de início da divulgação do gabarito" value="<?=$gabarito_hora?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Manual do Candidato:</td>
                </tr>
                <tr>
                    <td>
                        <?php
                        if($manual_candidato) {
                            echo $manual_candidato;
                        }
                        ?>
                        <input type="file" name="manual_candidato" id="manual_candidato" class="inpute">
                    </td>
                </tr>
                <tr>
                    <td class="tit_campo">Data de início das inscrições:</td>
                </tr>
                <tr>
                    <td><input type="text" name="insc_data_inicio" id="insc_data_inicio" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data de início das inscrições" value="<?=$insc_data_inicio?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data final das inscrições:</td>
                </tr>
                <tr>
                    <td><input type="text" name="insc_data_fim" id="insc_data_fim" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data final das inscrições" value="<?=$insc_data_fim?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Valor:</td>
                </tr>
                <tr>
                    <td>R$ <input type="text" name="valor" id="valor" maxlength="4" class="inpute pqno obrigatorio" title="Valor" value="<?=$valor?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data do Vestibular:</td>
                </tr>
                <tr>
                    <td><input type="text" name="data" id="data" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data do vestibular" value="<?=$data?>" /></td>
                </tr>
                <tr>
                    <td><h3 class="subtitulos">Promocional</h3></td>
                </tr>
                <tr>
                    <td class="tit_campo">Data:</td>
                </tr>
                <tr>
                    <td><input type="text" name="data_promocional" id="data_promocional" maxlength="10" class="inpute medio date-pick dp-applied obrigatorio" title="Data do vestibular" value="<?=$data_promocional?>" /></td>
                </tr>
                <tr>
                    <td class="tit_campo">Valor:</td>
                </tr>
                <tr>
                    <td>R$ <input type="text" name="valor_promocional" id="valor_promocional" maxlength="4" class="inpute pqno obrigatorio" title="Valor Promocional" value="<?=$valor_promocional?>" /></td>
                </tr>
            </table>
            <table id="table_botoes_rodape">
                <tr>
                    <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
                    <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
                </tr>
            </table>
        </form>
    </div>
    <div id="tab-inscricoes">
    <?php
    if(!$id){
         echo '<p class="vazio">Salve o vestibular antes!</p>';
    }else{
        ?>
        <table width="100%">
        <?php
        $query = 'SELECT * FROM vestibulares_inscricoes WHERE id_vestibulare = '.$id;
        $inscricoes = $con_cliente->query($query);
        if($inscricoes && $inscricoes->num_rows > 0){
            while($inscricao = $inscricoes->fetch_assoc()){
                ?>
            <tr>
                <td><?=$inscricao['nome']?></td>
                <td><?=ajustadata($inscricao['data_cadastro'],'site')?></td>
                <td><a href="/cgi/AEBMBIiAwMiEQCD40+kWL2A+08PdzzszVIw=/form/<?php echo $inscricao['id_vestibulares_inscricoe']; ?>">Verificar inscrição</a></td>
            </tr>
            <?
            }
        }
    }
    ?>
        </table>
    </div>
</div>