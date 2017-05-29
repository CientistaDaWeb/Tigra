<?php
session_start();
require_once('../../_classe/pagination_class.php');
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();
extract($_POST);

$tabela = 'alunos';
$campos = array(
    array('Matricula', 'matricula',''),
    array('Nome', 'nome',''),
    array('E-mail','email','')
);

$qry = "SELECT * FROM $tabela";
$id = 'id_'.substr($tabela,0,-1);
$modulo = str_replace(" ","+",$modulo);

if($searchtext != ""){
    //$palavra = str_replace(' ','"|"', $searchtext);
    foreach($campos as $campo){
        $busca = $busca.' OR '.$campo[1].' LIKE "%'.$searchtext.'%"';
    }
    $busca = substr($busca, 3);
	$qry .=' WHERE '.$busca;
}

$order = ' ORDER BY nome';

$qry .= $order;


$starting = $page;
$recpage = 10;
$obj = new pagination_class($qry, $starting, $recpage, $con);
$result = $obj->result;

$linhas = array('odd', 'even');

if($result->num_rows != 0){
?>
<table id="lista" class="display" border="0" cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th></th>
            <th></th>
        <?php
        foreach($campos as $campo){
            echo "<th>".$campo[0]."</th>";
        }
        ?>
        </tr>
    </thead>
    <tbody>
    <?php
    $counter = 0;
    while($data = $result->fetch_array()){
    ?>
        <tr class="<?=$linhas[$counter%2]?>">
            <td><!--<label for="checkbox<?=$data[$id]?>" id="label<?=$data[$id]?>" class="checkbox_unchecked"></label>-->
            <input type="checkbox" name="del_item[]" id="checkbox<?=$data[$id]?>" value="<?=$data[$id]?>" /></td>
            <td align="center"><a href="/cgi/<?=$modulo?>/form/<?=$data[$id]?>" title="Editar"><img src="/cgi/_css/_img/btn/btn_editar.png" alt="Editar" /></a></td>
        <?php
        foreach($campos as $campo){
            echo "<td>".$data[$campo[1]]."</td>";
        }
        ?>
        </tr>
    <?
        $counter ++;
    }
    ?>
    </tbody>
</table>
<div class="dataTables_info"><?=$obj->total?></div>
<div class="dataTables_paginate"><?=$obj->anchors?></div>
<?
}else{
?>
    <div><span class="vazio">Não foi encontrado nenhum aluno.</span></div>
<?
}
?>
