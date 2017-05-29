<?php 
class produtos_subcategorias {
    public $id_produtos_subcategoria, $id_produtos_categoria, $slug, $subcategoria;
    
    public function __construct() {
    
    }
    
    public function busca($id) {
        $tabela = "produtos_subcategorias";
        $campos = "*";
        $condicao = "WHERE id_produtos_subcategoria = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_produtos_subcategoria = $id;
        $this->id_produtos_categoria = $dados['id_produtos_categoria'];
        $this->slug = $dados['slug'];
        $this->subcategoria = $dados['subcategoria'];
        
    }
    
    public function __destruct() {
    
    }
}
?>
