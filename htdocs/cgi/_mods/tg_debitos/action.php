<?php
extract($_POST);

require_once('tg_debitos.php');

$objeto = new tg_debitos();
$objeto->id_tg_debito = $id_tg_debito;
$objeto->id_tg_fornecedore = $id_tg_fornecedore;
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->valor = limpadados($valor);
$objeto->data_pago = limpadados(ajustadata($data_pago,'banco'));
$objeto->valor_pago = limpadados($valor_pago);
$objeto->status = limpadados($status);
$objeto->descritivo =limpadados($descritivo);


$id = limpadados($id_tg_debito);
$tg_mod_tabela = 'tg_debitos';
$tg_mod_tipo = 'debito';
$tg_mod_sexo = 'o';

if(!$remessa){
    require_once('_inc/action.php');
}else{
    $sql = 'SELECT * FROM tg_fornecedores WHERE id_tg_fornecedore = '.$id_tg_fornecedore;
    $fornecedore = $con_tigra->query($sql);
    $fornecedore = $fornecedore->fetch_assoc();
    for($i=0; $i<$parcelas; $i++){
        $sql = 'INSERT INTO tg_debitos (id_tg_fornecedore, data, valor, descritivo, status)
            VALUES ('.$id_tg_fornecedore.',"'.ajustadata($datap[$i],'banco').'","'.$valorp[$i].'", "'.$descritivo.'<br />Parcela '.($i+1).'/'.$parcelas.'", 1)';
        $con_tigra->query($sql);
    }
    
    echo "Débitos criados!";
}