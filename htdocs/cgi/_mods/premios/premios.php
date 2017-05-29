<?php
class premios{
    var $id_premio, $id_premios_classificacoe, $concurso, $descricao, $vinho_premiado, $slug, $imagem;

    function  __construct() {
    }
    public function busca($id){
		$tabela = 'premios';
		$campos = '*';
		$condicao = "WHERE id_premio = $id";
		$ordem = '';
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		
		$this->id_premio				 	= $id;
		$this->id_premios_classificacoe     = $dados['id_premios_classificacoe'];
        #$this->ano 						= $dados['ano'];
		$this->concurso 					= $dados['concurso'];
        $this->descricao 					= $dados['descricao'];
        #$this->local 						= $dados['local'];
        #$this->mes 						= $dados['mes'];
        #$this->safra 						= $dados['safra'];
        $this->vinho_premiado 				= $dados['vinho_premiado'];
        $this->slug                         = $dados['slug'];
        $this->imagem 						= $dados['imagem'];
	}
    function  __destruct() {
    }
}

?>
