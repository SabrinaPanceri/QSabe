<?php
include '../BD/BD.php';

if (!isset($_SESSION)) {
    session_start();
}

session_cache_expire(10);

class Categoria {

    var $banco;
    var $nome;
    var $id_categoria;
    var $id_categoriaPai;

    public function __construct() {
        $this->banco = new BD();
        $this->banco->conecta();
    }

    public function listarCategorias() {
        $sql = 'select nome,idcategoria,idcategoriaPai from qsaberemake.categoria where idcategoriaPai is NULL order by idCategoria';
        $result = $this->banco->executequery($sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        } else {
            return NULL;
        }
    }

    public function listarCategoriasFilhos($idcategoriaPai, $base) {
        $sql = 'select nome,idcategoria,idcategoriaPai from qsaberemake.categoria where idCategoriaPai = ' . $idcategoriaPai . ' order by idCategoria';
        $result = $this->banco->executequery($sql);

        if (mysqli_num_rows($result) > 0) {
            //pego cat por cat 
            while ($row = mysqli_fetch_assoc($result)) {
                $nomecat = $row['nome'];
                $idcat = $row['idcategoria'];
                $idcatpai = $row['idcategoriaPai'];
                $html = $html . '<option value="' . $idcat . '">' . $base . $nomecat . '</option>';
                $html = $html . $this->listarCategoriasFilhos($idcat, $base . '->');
            }
            return $html;
        } else {
            return '';
        }
    }

    public function listarCategoriasSite() {
        $result = $this->listarCategorias();
        if ($result === NULL) {
            return NULL;
        } else {
            //pego cat por cat 
            while ($row = mysqli_fetch_assoc($result)) {
                $nomecat = $row['nome'];
                $idcat = $row['idcategoria'];
                $idcatpai = $row['idcategoriaPai'];
                $html = $html . '<option value="' . $idcat . '">' . $nomecat . '</option>';
                if ($idcatpai === NULL) {
                    $html = $html . $this->listarCategoriasFilhos($idcat, '->');
                }
            }
            return $html;
        }
    }

}
?>