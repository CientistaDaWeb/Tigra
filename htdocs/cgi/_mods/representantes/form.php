<style>
    #status_estado{
        margin:10px;
        padding:10px;
        display:none;
    }
</style>
<?php
require_once('representantes.php');
if($id) {
    $pesquisa = new representantes();
    $pesquisa->busca($id);
    $id_representante = $pesquisa->id_representante;
    $nome = $pesquisa->nome;
    $contato = $pesquisa->contato;
    $cidade_regiao = $pesquisa->cidade_regiao;
    $id_estado = $pesquisa->id_estado;
    $fone1 = $pesquisa->fone1;
    $fone2 = $pesquisa->fone2;
    $fone3 = $pesquisa->fone3;
    $email = $pesquisa->email;
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_representante?>" name="id_representante" id="id_representante" />
    <table id="formulario">
        <tr>
            <td class="tit_campo">Nome:</td>
        </tr>
        <tr>
            <td><input id="nome" name="nome" class="inpute gde obrigatorio"  value="<?=$nome?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Contato:</td>
        </tr>
        <tr>
            <td><input id="contato" name="contato" class="inpute medio obrigatorio"  value="<?=$contato?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Cidade:</td>
        </tr>
        <tr>
            <td><input id="cidade_regiao" name="cidade_regiao" class="inpute gde obrigatorio"  value="<?=$cidade_regiao?>" /></td>
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
            <td class="tit_campo">Telefone: (1) <input id="fone1" name="fone1" class="inpute pqueno obrigatorio"  value="<?=$fone1?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone: (2) <input id="fone2" name="fone2" class="inpute pqueno"  value="<?=$fone2?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefone: (3) <input id="fone3" name="fone3" class="inpute pqueno"  value="<?=$fone3?>" /></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail:</td>
        </tr>
        <tr>
            <td><input id="email" name="email" class="inpute gde obrigatorio"  value="<?=$email?>" /></td>
        </tr>
    </table>
    <?php
    if($id) {
        ?>
    <script type="text/javascript">
        function muda_estado(id_estado){
            var permit = document.getElementById('permit'+id_estado);
            if(permit.checked == true){
                var acao = 'remover';
            }else{
                var acao = 'adicionar';
            }

            $.ajax({
                type: "POST",
                url: "<?=$url_base?>/cgi/_mods/representantes/upload_estado.php?noob="+ new Date().getTime(),
                data: "id_representante=<?=$id_representante?>&id_estado="+escape(id_estado)+"&acao="+escape(acao),
                beforeSend: function(){
                    $("#status_estado").show().text("Aguarde...");
                },
                success: function(msg){
                    $("#status_estado").show().text("Estado de atuação atualizado com sucesso.");
                }
            });
        }
    </script>
    <div class="subtitulos" id="tit_estado">Estados de Atuação</div>
    <div id="status_estado" class="sucesso"></div>
    <div>
            <?php
            $checkbox_stat = array();
            $permissoes = $con_cliente->executa("SELECT * FROM representantes_estados WHERE id_representante = $id_representante");
            if($permissoes && mysqli_num_rows($permissoes)>0) {
                while($permissao = mysqli_fetch_assoc($permissoes)) {
                    $checkbox_stat[$permissao['id_estado']] = 'checked="checked"';
                }
            }
            $estados = $con_cliente->executa("SELECT * FROM estados ORDER BY estado");
            if($estados && mysqli_num_rows($estados)>0) {
                while($estadiu = mysqli_fetch_assoc($estados)) {
                    if($id_estado == $estadiu['id_estado']) $selected = 'selected="selected"';
                    ?>
        <div class="quatrocolunas">
            <label for="permit<?=$estadiu['id_estado']?>" onclick="muda_estado(<?=$estadiu['id_estado']?>)"><?=utf8_encode($estadiu['estado'])?></label>
            <input type="checkbox" name="permits[]" id="permit<?=$estadiu['id_estado']?>" value="<?=$estadiu['id_estado']?>" <?=$checkbox_stat[$estadiu['id_estado']]?> class="crirHiddenJS"/>
        </div>
                <?php
                }
            }
        ?>
    </div>
    <?php
    }
    ?>
    <table id="table_botoes_rodape">
        <tr>
            <td><input type="submit" value="Salvar" id="bt_salvar"/></td>
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>