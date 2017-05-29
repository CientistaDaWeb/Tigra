<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
require_once('cgi/_classe/database.php');
$con = new database();
$sql = 'SELECT * FROM tg_clientes ORDER BY nome';
$rs = $con->executa($sql);
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
    <head>
        <title>Lista de Clientes - Ween Web Solutions</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="NOINDEX, NOFOLLOW" />
        <meta http-equiv="content-language" content="pt-br" />
        <link rel="stylesheet" type="text/css" href="/cgi/_css/lista.css" />
        <script type="text/javascript" src="/cgi/_js/jquery.js"> </script>
        <script type="text/javascript">
            jQuery(function ($) {
                $("#filter").focus(function() {
                    if($(this).attr("value") == 'Buscar Cliente'){
                        $(this).attr("value","");
                    }
                });
                $("#filter").keyup(function () {
                    var filter = $(this).val(), count = 0;
                    $(".filtered:first li").each(function () {
                        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                            $(this).addClass("hidden");
                        } else {
                            $(this).removeClass("hidden");
                            count++;
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <div id="inpute">
            <input id="filter" name="filter" value="Buscar Cliente"/>
        </div>
        <div id="ween-clientes" class="filtered">
            <ul>
                <?php
                if($rs && mysqli_num_rows($rs)>0) {
                    while($dados = mysqli_fetch_assoc($rs)) {
                        ?>
                <li>
                    <div>
                        <form action="/login/" method="post">
                            <input type="hidden" name="id_tg_cliente" value="<?=$dados['id_tg_cliente']?>" />
                            <input type="image" src="_img/clientes/<?=$dados['logotipo']?>" value="<?=$dados['nome']?>" />
                        </form>
                        <a href="#"><?=$dados['nome']?></a>
                    </div>
                </li>
                        <? }
}
$con->close();
?>
            </ul>
        </div>
    </body>
</html>