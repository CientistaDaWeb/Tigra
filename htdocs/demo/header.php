<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="pt-br" xml:lang="pt-br">
    <head>
        <title>Seja Bem Vindo ao Demo do Ween Tigra</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="author" content="Ween Web Solutions" />
        <meta name="description" content="Demonstração Ween Tigra" />
        <meta name="keywords" content="demo, crm, weentigra" />
        <meta name="subject" content="demo, crm, weentigra" />
        <meta name="robots" content="index,follow" />
        <meta http-equiv="content-language" content="pt-br" />
        <meta name="reply-to" content="ween@ween.com.br" />
        <link rel="stylesheet" type="text/css" href="/demo/_css/style.css" />

        <link rel="Shortcut Icon" href="/demo/_css/_img/favicon.ico" />
        <link rel="icon" href="/demo/_css/_img/favicon.ico" />
        <script type="text/javascript" src="/demo/_js/jquery.js"> </script>
        <script type="text/javascript" src="/demo/_js/swfobject.js"> </script>
        <script type="text/javascript" src="/demo/_js/jquery.pngFix.pack.js"> </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).pngFix();
            });
        </script>
    </head>
    <body>
        <?php
        $menu = array(
            array('titulo'=>'Home', 'link'=>'/demo'),
            array('titulo'=>'Produtos', 'link'=>'/demo/produtos'),
            array('titulo'=>'Representantes', 'link'=>'/demo/representantes')
        );
        ?>
        <div id="root">
            <div id="header">
                <h1>Demostração do Weentigra</h1>
                <ul>
                    <?php
                    foreach($menu AS $minu){
                    ?>
                    <li><a href="<?php echo $minu['link']; ?>"><?php echo $minu['titulo']; ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="content">