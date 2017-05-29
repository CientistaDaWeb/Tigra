<?php 
class lojas {
    var $id_loja, $id_estado, $nome, $endereco, $bairro, $cidade, $telefone, $telefone2, $email;
    
    function __construct() {
    }
    public function busca($id) {
        $tabela = 'lojas';
        $campos = '*';
        $condicao = "WHERE id_loja = $id";
        $ordem = '';
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_loja = $id;
		$this->id_estado = $dados['id_estado'];
		$this->nome = $dados['nome'];
        $this->endereco = $dados['endereco'];
        $this->bairro = $dados['bairro'];
        $this->cidade = $dados['cidade'];
        $this->telefone = $dados['telefone'];
		$this->telefone2 = $dados['telefone2'];
        $this->email = $dados['email'];
    }
    function __destruct() {
    }
}

?>
