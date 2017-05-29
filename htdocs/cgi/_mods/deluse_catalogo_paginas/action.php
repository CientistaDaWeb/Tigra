<?php
extract($_POST);
require_once('catalogo_paginas.php');
require_once('_classe/upload.php');

$objeto = new catalogo_paginas();
$objeto->id_catalogo_pagina = limpadados($id_catalogo_pagina);
$objeto->id_catalogo_categoria = limpadados($id_catalogo_categoria);
$objeto->pagina = limpadados($pagina);

if($_FILES['imagem']['size'] > 0) {
    $upload = new upload($_FILES['imagem']);
    if ($upload->uploaded) {
        /*Imagem Gande*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/catalogo_virtual';
        $upload->image_resize = true;
        $upload->image_ratio = true;
        $upload->image_x = 1000;
        $upload->image_y = 1414;
        $upload->process($pasta);

        /*Thumb*/
        $pasta = '/home/weentigra/www/images/'.$dominio.'/catalogo_virtual/thumbs';
        $upload->image_resize = true;
        $upload->image_ratio_crop = true;
        $upload->image_x = 389;
        $upload->image_y = 550;
        $upload->process($pasta);

        $objeto->imagem = $upload->file_dst_name;
    }
}

$id = limpadados($id_catalogo_pagina);
$tg_mod_tabela = 'catalogo_paginas';
$tg_mod_tipo = 'pagina';
$tg_mod_sexo = 'a';

catalogo_paginas::arrumaOrdem($pagina, $id_catalogo_pagina);

require_once('_inc/action2.php');