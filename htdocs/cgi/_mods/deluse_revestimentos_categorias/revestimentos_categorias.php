<?php 
class revestimentos_categorias {
    public $id_revestimentos_categoria, $categoria, $slug;
    
    public function __construct() {
    }
    
    public function busca($id) {
        $tabela = "revestimentos_categorias";
        $campos = "*";
        $condicao = "WHERE id_revestimentos_categoria = $id";
        $ordem = "";
        $query = "SELECT $campos FROM $tabela $condicao $ordem";
        $con = new database2();
        $rs = $con->executa($query);
        $dados = mysqli_fetch_assoc($rs);
        $this->id_revestimentos_categoria = $id;
        $this->categoria = $dados['categoria'];
        $this->slug = $dados['slug'];
    }
	
    public function lista() {
        $con = new database2();
        $query = 'SELECT id_revestimentos_categoria, categoria FROM revestimentos_categorias ORDER BY categoria';
        $categorias = $con->query($query);
        if ($categorias && $categorias->num_rows > 0) {
            while ($categoria = $categorias->fetch_assoc()) {
                $dados[] = $categoria;
            }
            return $dados;
        }
        
    }
    public function listaAssociada() {
        $con = new database2();
        $query = 'SELECT rc.id_revestimentos_categoria, rc.categoria, rs.id_revestimentos_subcategoria, rs.subcategoria FROM revestimentos_categorias AS rc LEFT JOIN revestimentos_subcategorias AS rs ON rc.id_revestimentos_categoria = rs.id_revestimentos_categoria ORDER BY rc.categoria, rs.subcategoria';
        $categorias = $con->query($query);
        if ($categorias && $categorias->num_rows > 0) {
            while ($categoria = $categorias->fetch_assoc()) {
                $dados[] = $categoria;
            }
            return $dados;
        }
    }
    
    public function __destruct() {
    }
}
?>
