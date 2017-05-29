<?php
extract($_POST);

require_once('tg_creditos.php');

$objeto = new tg_creditos();
$objeto->id_tg_credito = $id_tg_credito;
$objeto->id_tg_cliente = $id_tg_cliente;
$objeto->data = limpadados(ajustadata($data,'banco'));
$objeto->valor = limpadados($valor);
$objeto->data_pago = limpadados(ajustadata($data_pago,'banco'));
$objeto->valor_pago = limpadados($valor_pago);
$objeto->status = limpadados($status);
$objeto->descritivo =limpadados($descritivo);


$id = limpadados($id_tg_credito);
$tg_mod_tabela = 'tg_creditos';
$tg_mod_tipo = 'credito';
$tg_mod_sexo = 'o';

if(!$remessa){
    require_once('_inc/action.php');
}else{
    $sql = 'SELECT * FROM tg_clientes WHERE id_tg_cliente = '.$id_tg_cliente;
    $cliente = $con_tigra->query($sql);
    $cliente = $cliente->fetch_assoc();
    for($i=0; $i<$parcelas; $i++){
        $sql = 'INSERT INTO tg_creditos (id_tg_cliente, data, valor, descritivo, status)
            VALUES ('.$id_tg_cliente.',"'.ajustadata($datap[$i],'banco').'","'.$valorp[$i].'", "'.$descritivo.'<br />Parcela '.($i+1).'/'.$parcelas.'", 1)';
        $con_tigra->query($sql);
    }
    
    echo "creditos criados e enviados!";
}