<?php
extract($_POST);

require_once("$tg_mod.php");
require_once('_classe/class.upload.php');

$objeto = new tg_clientes();
$objeto->id_tg_cliente = $id_tg_cliente;
$objeto->nome = limpadados($nome);
$objeto->db_host = cripfy(limpadados($db_host),'h0s7');
$objeto->db_user = cripfy(limpadados($db_user),'h0s7');
$objeto->db_pass = cripfy(limpadados($db_pass),'h0s7');
$objeto->db_dbname = cripfy(limpadados($db_dbname),'h0s7');
$objeto->ftp_host = cripfy(limpadados($ftp_host),'h0s7');
$objeto->ftp_user = cripfy(limpadados($ftp_user),'h0s7');
$objeto->ftp_pass = cripfy(limpadados($ftp_pass),'h0s7');
$objeto->dominio = cripfy(limpadados($dominio),'h0s7');
$objeto->logotipo = limpadados($logotipo);
$objeto->telefone = limpadados($telefone);
$objeto->cidade = limpadados($cidade);
$objeto->email = limpadados($email);
$objeto->fk_tg_estado = limpadados($fk_tg_estado);
$objeto->endereco = limpadados($endereco);
$objeto->documento = limpadados($documento);
$objeto->tipo = limpadados($tipo);
$objeto->contato = limpadados($contato);
$objeto->data = ajustadata(limpadados($data),'banco');
$objeto->avaliacao = limpadados($avaliacao);
$objeto->cep = limpadados($cep);

if($_FILES['logotipo']['size'] > 0) {
    $upload = new upload($_FILES['logotipo']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/_img/clientes';
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 150;
        $upload->image_y = 100;
        $upload->process($pasta);

        $objeto->logotipo = $upload->file_dst_name;
    }
}
	
$id = limpadados($id_tg_cliente);
$tg_mod_tabela = 'tg_clientes';
$tg_mod_tipo = 'Cliente';
$tg_mod_sexo = 'o';

require_once('_inc/action.php');