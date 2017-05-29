<?php
function apagar($dir) {
    if(is_dir($dir)) {
        if($handle = opendir($dir)) {
            while(false !== ($file = readdir($handle))) {
                if(($file == ".") or ($file == "..")) {
                    continue;
                }
                if(is_dir($dir.'/'.$file)) {
                    apagar($dir.'/'.$file);
                }else {
                    echo 'apagando arquivo '.$dir.'/'.$file.'<br>';
                    chmod($dir.'/'.$file,777);
                    unlink($dir.'/'.$file);
                }
            }
        }else {
            return false;
        }
        closedir($handle);
        echo 'apagando pasta '.$dir.'<br>';
        chmod($dir,777);
        rmdir($dir);
    }else {
        return false;
        echo "Não é um diretório.";
    }
}

if($_GET['id']) {
    echo 'Apagado os arquivos do cliente com ID:'.$_GET['id'];
    apagar('tmp_up/'.$_GET['id']);
}else {
    echo 'Insira o id';
}