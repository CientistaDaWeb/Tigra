<?php
session_start();
extract($_POST);
extract($_GET);
require_once('../../_inc/function.php');
require_once('../../_classe/database2.php');
$con = new database2();
$id_setor = $_POST['id_setor'];
if($_FILES['arquivo']['size'] > 0){
    $abraArq = fopen($_FILES['arquivo']['tmp_name'], "r");
    if (!$abraArq){
        echo "Arquivo não encontrado";
    }else{
        $novos = 0;
        $atualizados = 0;
        while($valores = fgetcsv($abraArq, 2048, ";")) {
            $query = 'SELECT * FROM alunos WHERE matricula = '.$valores[0];
            $verifica = $con->query($query);
            if($verifica && $verifica->num_rows > 0){
               $query2 = 'UPDATE alunos SET nome = "'.$valores[1].'" WHERE matricula = '.$valores[0];
               $con->query($query2);
               $atualizados++;
            }else{
               $query2 = 'INSERT INTO alunos(id_setor, matricula, nome, email, senha) VALUES ('.$id_setor.','.$valores[0].',"'.$valores[1].'","'.$valores[2].'","'.md5($valores[0]).'")';
               $con->query($query2);
               $novos++;
            }
        }
        echo 'Lista importada com sucesso!<br/><br/>Novos: '.$novos.'<br>Atualizados: '.$atualizados;
    }
    fclose($abraArq);
}
?>