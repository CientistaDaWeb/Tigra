<?php
$CaracteresAceitos = 'abcdefghijklmnopqrstuvwxyz0123456789';
$max = strlen($CaracteresAceitos)-1;
$password = null;
for($i=0; $i < 10; $i++) {
    $password .= $CaracteresAceitos{mt_rand(0, $max)};
}
echo $password;
?>
