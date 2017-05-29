<?php
class tg_creditos{
	public $id_tg_credito, $id_tg_cliente, $data, $valor, $data_pago, $valor_pago, $status, $descritivo;
	
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'tg_creditos';
		$campos = '*';
		$condicao = "WHERE id_tg_credito = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_tg_credito = $id;
		$this->id_tg_cliente = $dados['id_tg_cliente'];
		$this->data = $dados['data'];
		$this->valor = $dados['valor'];
                $this->data_pago = $dados['data_pago'];
		$this->valor_pago = $dados['valor_pago'];
		$this->status = $dados['status'];
		$this->descritivo = $dados['descritivo'];
	}
	
	public function __destruct(){
		
	}
}
?>