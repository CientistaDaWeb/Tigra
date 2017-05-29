<?php
require_once('vestibulares_inscricoes.php');
if($id) {
    $pesquisa = new vestibulares_inscricoes();
    $pesquisa->busca($id);
    $id_vestibulares_inscricoe = $pesquisa->id_vestibulares_inscricoe;
    $id_vestibulare = $pesquisa->id_vestibulare;
    $nome = $pesquisa->nome;
    $sexo = $pesquisa->sexo;
    $nascimento = ajustadata($pesquisa->nascimento,'site');
    $cpf = $pesquisa->cpf;
    $rg = $pesquisa->rg;
    $orgaoExp = $pesquisa->orgaoExp;
    $dataEmissao = ajustadata($pesquisa->dataEmissao,'site');
    $endereco = $pesquisa->endereco;
    $numero = $pesquisa->numero;
    $complemento = $pesquisa->complemento;
    $bairro = $pesquisa->bairro;
    $cep = $pesquisa->cep;
    $cidade = $pesquisa->cidade;
    $uf = $pesquisa->uf;
    $foneRes = $pesquisa->foneRes;
    $foneCom = $pesquisa->foneCom;
    $cel = $pesquisa->cel;
    $email = $pesquisa->email;
    $curso1 = $pesquisa->curso1;
    $curso2 = $pesquisa->curso2;
    $curso3 = $pesquisa->curso3;
    $curso4 = $pesquisa->curso4;
    $curso5 = $pesquisa->curso5;
    $curso6 = $pesquisa->curso6;
    $deficiencia = $pesquisa->deficiencia;
    $qualDef = $pesquisa->qualDef;
    $enem = $pesquisa->enem;
    $enemInsc = $pesquisa->enemInsc;
    $enemAno = $pesquisa->enemAno;
    $idade = $pesquisa->idade;
    $estadoCivil = $pesquisa->estadoCivil;
    $naturalidade = $pesquisa->naturalidade;
    $nacionalidade = $pesquisa->nacionalidade;
    $nomeMae = $pesquisa->nomeMae;
    $tipoEm = $pesquisa->tipoEm;
    $preVest = $pesquisa->preVest;
    $qtsVest = $pesquisa->qtsVest;
    $curSup = $pesquisa->curSup;
    $curS = $pesquisa->curs;
    $sit = $pesquisa->sit;
    $fator = $pesquisa->fator;
    $renda = $pesquisa->renda;
    $atividade = $pesquisa->atividade;
    $lang = $pesquisa->lang;
    $langS = $pesquisa->langS;
    $prof = $pesquisa->prof;
    $empresaTab = $pesquisa->empresaTab;
    $comoSoube = $pesquisa->comoSoube;
    $csQual = $pesquisa->csQual;
    $data_cadastro = ajustadata($pesquisa->data_cadastro,'site');
}
?>
<form action="<?=$url_base?>/cgi/<?=$mod?>/action" method="post" enctype="multipart/form-data" id="form_edicao" onsubmit="return ween_validator()">
    <input type="hidden" value="<?=$id_vestibulares_inscricoe?>" name="id_vestibulares_inscricoe" id="id_vestibulares_inscricoe" />
    <table id="formulario">
        <tr>
            <td colspan="2"><input type="submit" value="Confirmar Pagamento" id="bt_confirmar_pagamento"/></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome:</td>
            <td><?=$nome?></td>
        </tr>
        <tr>
            <td class="tit_campo">Sexo:</td>
            <td><?=$sexo?></td>
        </tr>
        <tr>
            <td class="tit_campo">Data de Nascimento:</td>
            <td><?=$nascimento?></td>
        </tr>
        <tr>
            <td class="tit_campo">CPF:</td>
            <td><?=$cpf?></td>
        </tr>
        <tr>
            <td class="tit_campo">RG:</td>
            <td><?=$rg?> - <?=$orgaoExp?> - <?=$dataEmissao?></td>
        </tr>
        <tr>
            <td class="tit_campo">Endereço:</td>
            <td><?=$endereco?> - <?=$numero?> - <?=$complemento?><br><?=$bairro?> - <?=$cep?> - <?=$cidade?>/<?=$uf?></td>
        </tr>
        <tr>
            <td class="tit_campo">Telefones:</td>
            <td><?=$foneRes?> - <?=$foneCom?> - <?=$cel?></td>
        </tr>
        <tr>
            <td class="tit_campo">E-mail:</td>
            <td><?=$email?></td>
        </tr>
        <tr>
            <td class="tit_campo">Cursos Escolhidos:</td>
            <td><?=$curso1?> - <?=$curso2?> - <?=$curso3?> - <?=$curso4?> - <?=$curso5?> - <?=$curso6?></td>
        </tr>
        <tr>
            <td class="tit_campo">Deficiências:</td>
            <td><?=$deficiencia?> - <?=$qualDef?></td>
        </tr>
        <tr>
            <td class="tit_campo">Enem:</td>
            <td><?=$enem?> - <?=$enemInsc?>/<?=$enemAno?></td>
        </tr>
        <tr>
            <td class="tit_campo">Idade:</td>
            <td><?=$idade?></td>
        </tr>
        <tr>
            <td class="tit_campo">Estado Civil:</td>
            <td><?=$estadoCivil?></td>
        </tr>
        <tr>
            <td class="tit_campo">Naturalidade / Nacionalidade:</td>
            <td><?=$naturalidade?> / <?=$nacionalidade?></td>
        </tr>
        <tr>
            <td class="tit_campo">Nome da Mãe:</td>
            <td><?=$nomeMae?></td>
        </tr>
        <tr>
            <td class="tit_campo">Tipo de Ensino Médio:</td>
            <td><?=$tipoEm?></td>
        </tr>
        <tr>
            <td class="tit_campo">Já Prestou Vestibular / Número de Vezes:</td>
            <td><?=$preVest?> / <?=$qtsVest?></td>
        </tr>
        <tr>
            <td class="tit_campo">Já tem curso superior / Qual / Situação:</td>
            <td><?=$curSup?><br><?=$curS?> / <?=$sit?></td>
        </tr>
        <tr>
            <td class="tit_campo">Fator que levou a fazer o Vestibular:</td>
            <td><?=$fator?></td>
        </tr>
        <tr>
            <td class="tit_campo">Renda Familiar:</td>
            <td><?=$renda?></td>
        </tr>
        <tr>
        <tr>
            <td class="tit_campo">Atividade:</td>
            <td><?=$atividade?></td>
        </tr>
        <tr>
            <td class="tit_campo">Conhecimento em liíngua Estrangeira:</td>
            <td><?=$lang?> / <?=$langS?></td>
        </tr>
        <tr>
            <td class="tit_campo">Profissão / Empresa:</td>
            <td><?=$prof?> / <?=$empresaTab?></td>
        </tr>
        <tr>
            <td class="tit_campo">Como Soube:</td>
            <td><?=$comoSoube?> / <?=$csQual?></td>
        </tr>
        <tr>
            <td class="tit_campo">Data da Inscrição:</td>
            <td><?=$data_cadastro?></td>
        </tr>
    </table>
    <table id="table_botoes_rodape">
        <tr>
        <!--<td><input type="submit" value="Salvar" id="bt_salvar"/></td>-->
            <td><input type="button" value="Cancelar" onclick="window.location='<?=$url_base?>/cgi/<?=$mod?>'" id="bt_cancelar" /></td>
        </tr>
    </table>
</form>