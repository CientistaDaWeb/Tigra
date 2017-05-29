<?php
class fac_vestibulares_boletos{
	public $id_fac_vestibulares_boleto, $nossonumero, $num_doc, $preco, $pago, $id_fac_vestibulares_inscricoe;
	public function __construct(){
		
	}
	
	public function busca($id){
		$tabela = 'fac_vestibulares_boletos';
		$campos = '*';
		$condicao = "WHERE id_fac_vestibulares_boleto = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_fac_vestibulares_boleto = $id;
		$this->nossonumero = $dados['nossonumero'];
        $this->num_doc = $dados['num_doc'];
        $this->preco = $dados['preco'];
        $this->pago = $dados['pago'];
        $this->id_fac_vestibulares_inscricoe = $dados['id_fac_vestibulares_inscricoe'];
	}
	
	public function __destruct(){
		
	}
}
?>