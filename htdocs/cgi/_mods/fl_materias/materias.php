<?php
class materias{
	public $id_materia, $titulo, $linha_apoio, $texto, $data, $id_materias_categoria, $id_materias_subcategoria, $id_redatore, $status, $imagem, $legenda_foto, $credito_foto, $video_link;
	
	public function __construct(){
		
	}	
	public function busca($id){
		$tabela = "materias";
		$campos = "*";
		$condicao = "WHERE id_materia = $id";
		$ordem = "";
		$query = "SELECT $campos FROM $tabela $condicao $ordem";
		$con = new database2();
		$rs = $con->executa($query);
		$dados = mysqli_fetch_assoc($rs);
		$this->id_materia = $id;
		$this->titulo = $dados['titulo'];
		$this->linha_apoio = $dados['linha_apoio'];
		$this->texto = $dados['texto'];
		$this->data = $dados['data'];
		$this->id_materias_categoria = $dados['id_materias_categoria'];
		$this->id_materias_subcategoria = $dados['id_materias_subcategoria'];
		$this->id_redatore = $dados['id_redatore'];
		$this->status = $dados['status'];
		$this->imagem = $dados['imagem'];
		$this->legenda_foto = $dados['legenda_foto'];
		$this->credito_foto = $dados['credito_foto'];
		$this->video_link = $dados['video_link'];
	}
	
	public function __destruct(){
		
	}
}
?>