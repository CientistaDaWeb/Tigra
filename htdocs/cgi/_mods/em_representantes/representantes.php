<?php
class representantes{
    var $id_representante, $nome, $cidade, $estado, $fone, $email;

    function  __construct() {
    }
    public function busca($id){
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
		$this->cidade = $dados['cidade'];
        $this->estado = $dados['estado'];
        $this->fone = $dados['fone'];
        $this->email = $dados['email'];
	}
    function  __destruct() {
    }
}

?>
