<?php
class clippings{
	public $id_clipping, $assunto, $data, $midia, $local, $arquivo, $link, $slug;
	
	public function __construct(){}
	public function busca($id){
		$tabela = 'clippings';
		$campos = '*';
		$condicao = "WHERE id_clipping = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_clipping = $id;
        $this->assunto = $dados['assunto'];
		$this->data = $dados['data'];
        $this->arquivo = $dados['arquivo'];
		$this->local = $dados['local'];
        $this->link = $dados['link'];
		$this->midia = $dados['midia'];
        $this->data = $dados['data'];
        $this->slug = $dados['slug'];
	}
	public function __destruct(){}
}
?>