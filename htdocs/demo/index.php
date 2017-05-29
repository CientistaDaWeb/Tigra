<?php
require_once('header.php');
require_once('classes/database.class.php');
$con = new database();

$baseURL = $_SERVER['REQUEST_URI'];
$baseURL = explode('/', $baseURL);

if(!$baseURL[2]) {
    ?>
<h2>Weentigra - Versão de demonstração</h2>
<p>Nesse site você poderá ver a eficiencia do nosso CRM para atualização do seu site.</p>
<p>Colocamos a disposição para testes apenas 2 módulos no momento, mas contamos com mais de 100 módulos já desenvolvidos</p>
<p>Para acessá-lo basta clicar no link do tigra que fica abaixo logo abaixo!</p>
<p>Os dados para acesso são:</p>
<p>Usuário: <b>demo</b></p>
<p>Senha: <b>demo</b></p>
<p>Aproveite</p>
    <?
}else {
    if(is_file($baseURL[2].'.php')) {
        require_once($baseURL[2].'.php');
    }else {
        require_once('404.php');
    }
}
require_once('footer.php');