<?php 
class distribuidores {
    var $id_distribuidore, $nome, $contato, $cidade_regiao, $id_estado, $fone1, $fone2, $fone3, $email;
    
    function __construct() {
    }
    public function busca($id) {
        $tabela = 'distribuidores';
        $campos = '*';
        $condicao = "WHERE id_distribuidore = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_distribuidore = $id;
        $this->nome = $dados['nome'];
        $this->contato = $dados['contato'];
        $this->cidade_regiao = $dados['cidade_regiao'];
        $this->id_estado = $dados['id_estado'];
        $this->fone1 = $dados['fone1'];
        $this->fone2 = $dados['fone2'];
        $this->fone3 = $dados['fone3'];
        $this->email = $dados['email'];
    }
    function __destruct() {
    }
}

?>
