<?php
$lancamento = 2;
extract($_POST);
require_once('produtos.php');
require_once('_classe/class.upload.php');
require_once('_classe/ftp.class.php');

$objeto = new produtos();
$objeto->id_produto = limpadados($id_produto);
$objeto->id_produtos_categoria = limpadados($id_produtos_categoria);
$objeto->nome_pt = limpadados($nome_pt);
$objeto->referencia = limpadados($referencia);
$objeto->codigo = limpadados($codigo);
$objeto->composicao_pt = limpadados($composicao_pt);
$objeto->lancamento = limpadados($lancamento);
$objeto->imagem = limpadados($imagem);
$objeto->cores = limpadados($cores);
$objeto->nome_es = limpadados($nome_es);
$objeto->composicao_es = limpadados($composicao_es);
$objeto->ordem = limpadados($ordem);
$objeto->slug_pt = deixa_amigavel(limpadados($nome_pt));
$objeto->slug_es = deixa_amigavel(limpadados($nome_es));

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        $filename = date('U');
        /*Imagem Gande*/
        $pasta['servidor'] = '../tmp_up/'.$_SESSION['id_tg_usuario'];
        $pasta['cliente'] = '_img/produtos';

        $upload->file_new_name_body = $filename;
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 580;
        $upload->image_y = 435;

        $upload->process($pasta['servidor']);
        $ftp = new ClsFTP();
        $ftp->put($pasta['cliente'].'/'.$upload->file_dst_name, $pasta['servidor'].'/'.$upload->file_dst_name);

        /*Thumb*/
        $pasta['servidor'] = '../tmp_up/'.$_SESSION['id_tg_usuario'].'/thumb';
        $pasta['cliente'] = '_img/produtos/thumbs';

        $upload->file_new_name_body = $filename;
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 140;
        $upload->image_y = 105;
        $upload->process($pasta['servidor']);

        $ftp = new ClsFTP();
        $ftp->put($pasta['cliente'].'/'.$upload->file_dst_name, $pasta['servidor'].'/'.$upload->file_dst_name);

        $objeto->imagem = $upload->file_dst_name;
    }
}
if($_FILES['cores']['size'] > 0) {
    $upload = new upload($_FILES['cores']);
    if ($upload->uploaded) {
        $pasta['servidor'] = '../tmp_up/'.$_SESSION['id_tg_usuario'];
        $pasta['cliente'] = '_img/produtos/cores';

        $upload->file_new_name_body = date('U');
        $upload->image_resize = true;
        $upload->image_ratio_fill = true;
        $upload->image_x = 250;
        $upload->image_y = 40;
        $upload->process($pasta['servidor']);

        $ftp = new ClsFTP();
        $ftp->put($pasta['cliente'].'/'.$upload->file_dst_name, $pasta['servidor'].'/'.$upload->file_dst_name);

        $objeto->cores = $upload->file_dst_name;
    }
}
$id = limpadados($id_produto);
$tg_mod_tabela = 'produtos';
$tg_mod_tipo = 'Produto';
$tg_mod_sexo = 'o';

require_once('_inc/action2.php');