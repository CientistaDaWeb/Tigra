<?php
extract($_POST);
require_once('vestibulares_boletos.php');

$query = 'SELECT * FROM vestibulares_boletos WHERE id_vestibulares_inscricoe = '.$id_vestibulares_inscricoe;
$boleto = $con_cliente->query($query);
if($boleto && $boleto->num_rows > 0){
    $boleto = $boleto->fetch_assoc();

    $objeto = new vestibulares_boletos();
    $objeto->id_vestibulares_boleto = $boleto['id_vestibulares_boleto'];
    $objeto->nossonumero = $boleto['nossonumero'];
    $objeto->num_doc = $boleto['num_doc'];
    $objeto->preco = $boleto['preco'];
    $objeto->pago = 1;
    $objeto->id_vestibulares_inscricoe = limpadados($id_vestibulares_inscricoe);

    $id = limpadados($objeto->id_vestibulares_boleto);
    $tg_mod_tabela = 'vestibulares_boletos';
    $tg_mod_tipo = 'Pagamento';
    $tg_mod_sexo = 'o';
}

require_once('_inc/action2.php');