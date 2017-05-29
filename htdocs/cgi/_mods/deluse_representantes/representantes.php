<?php 
class representantes {
    var $id_representante, $nome, $contato, $cidade_regiao, $id_estado, $fones, $emails;
    
    function __construct() {
    }
    public function busca($id) {
        $tabela = 'representantes';
        $campos = '*';
        $condicao = "WHERE id_representante = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_representante = $id;
        $this->nome = $dados['nome'];
        $this->contato = $dados['contato'];
        $this->cidade_regiao = $dados['cidade_regiao'];
        $this->id_estado = $dados['id_estado'];
        $this->fones = $dados['fones'];
        $this->emails = $dados['emails'];
    }
    function __destruct() {
    }
}

?>
