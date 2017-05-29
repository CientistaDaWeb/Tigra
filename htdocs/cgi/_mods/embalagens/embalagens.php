<?php 
class embalagens {
    var $id_embalagen, $embalagem_pt, $embalagem_es, $embalagem_en;
    
    function __construct() {
    }
    public function busca($id) {
        $tabela = 'embalagens';
        $campos = '*';
        $condicao = "WHERE id_embalagen = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_embalagen = $id;
        $this->embalagem_pt = $dados['embalagem_pt'];
		$this->embalagem_es = $dados['embalagem_es'];
		$this->embalagem_en = $dados['embalagem_en'];
    }
    function __destruct() {
    }
}

?>
