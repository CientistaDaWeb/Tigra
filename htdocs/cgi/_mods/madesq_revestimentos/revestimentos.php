<?php
class revestimentos{
	var $id_revestimento, $revestimento, $imagem, $slug;

	function  __construct() {
	}
	public function busca($id){
		$query = 'SELECT * FROM revestimentos WHERE id_revestimento = '.$id;
		$con = new database2();
		$rs = $con->executa($query);
		if($rs && $rs->num_rows > 0){
			$dados = mysqli_fetch_assoc($rs);
			$this->id_revestimento = $id;
			$this->revestimento = $dados['revestimento'];
			$this->imagem = $dados['imagem'];
                        $this->slug = $dados['slug'];
                }
	}
	function  __destruct() {
	}
}
?>
