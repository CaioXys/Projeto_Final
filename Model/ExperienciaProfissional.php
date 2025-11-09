<?php
class ExperienciaProfissional {
    private $id;
    private $idusuario;
    private $inicio;
    private $fim;
    private $empresa;
    private $descricao;

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "INSERT INTO experienciaprofissional (idusuario, inicio, fim, empresa, descricao) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $this->idusuario, $this->inicio, $this->fim, $this->empresa, $this->descricao);
        
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
        
        $sql = "DELETE FROM experienciaprofissional WHERE idexperienciaprofissional = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function listaExperiencias($idusuario) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "SELECT * FROM experienciaprofissional WHERE idusuario = ?";
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
    
    public function setEmpresa($empresa) { $this->empresa = $empresa; }
    public function getEmpresa() { return $this->empresa; }
    
    public function setDescricao($descricao) { $this->descricao = $descricao; }
    public function getDescricao() { return $this->descricao; }
}
?>