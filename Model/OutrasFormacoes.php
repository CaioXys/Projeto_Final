<?php
class OutrasFormacoes {
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $descricao;

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "INSERT INTO outrasformacoes (idusuario, inicio, fim, descricao) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isss", $this->idusuario, $this->inicio, $this->fim, $this->descricao);
        
        if ($stmt->execute()) {
            $this->id = $conn->insert_id;
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }

    public function excluirBD($id) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "DELETE FROM outrasformacoes WHERE idoutrasformacoes = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function listaFormacoes($idusuario) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "SELECT * FROM outrasformacoes WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setIdUsuario($idusuario) { $this->idusuario = $idusuario; }
    public function getIdUsuario() { return $this->idusuario; }
    
    public function setInicio($inicio) { $this->inicio = $inicio; }
    public function getInicio() { return $this->inicio; }
    
    public function setFim($fim) { $this->fim = $fim; }
    public function getFim() { return $this->fim; }
    
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function getDescricao() { return $this->descricao; }
}
?>