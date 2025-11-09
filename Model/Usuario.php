<?php
class Usuario {
    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $dataNascimento;
    private $senha;

    public function inserirBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();

        $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO usuario (nome, cpf, email, senha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $this->nome, $this->cpf, $this->email, $senhaHash);
        
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

    public function carregarUsuario($cpf) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "SELECT * FROM usuario WHERE cpf = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $result = $stmt->get_result();
        $r = $result->fetch_object();
        
        if($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }

    public function carregarUsuarioPorId($id) {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "SELECT * FROM usuario WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $r = $result->fetch_object();
        
        if($r != null) {
            $this->id = $r->idusuario;
            $this->nome = $r->nome;
            $this->email = $r->email;
            $this->cpf = $r->cpf;
            $this->dataNascimento = $r->dataNascimento;
            $this->senha = $r->senha;
            $stmt->close();
            $conn->close();
            return true;
        }
        $stmt->close();
        $conn->close();
        return false;
    }

    public function atualizarBD() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "UPDATE usuario SET nome = ?, cpf = ?, dataNascimento = ?, email = ? WHERE idusuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $this->nome, $this->cpf, $this->dataNascimento, $this->email, $this->id);
        
        $result = $stmt->execute();
        $stmt->close();
        $conn->close();
        return $result;
    }

    public function listaCadastrados() {
        require_once 'ConexaoBD.php';
        $con = new ConexaoBD();
        $conn = $con->conectar();
        
        $sql = "SELECT idusuario, nome FROM usuario ORDER BY nome";
        $re = $conn->query($sql);
        $conn->close();
        return $re;
    }

    public function setID($id) { $this->id = $id; }
    public function getID() { return $this->id; }
    
    public function setNome($nome) { $this->nome = $nome; }
    public function getNome() { return $this->nome; }
    
    public function setCPF($cpf) { $this->cpf = $cpf; }
    public function getCPF() { return $this->cpf; }
    
    public function setEmail($email) { $this->email = $email; }
    public function getEmail() { return $this->email; }
    
    public function setDataNascimento($dataNascimento) { $this->dataNascimento = $dataNascimento; }
    public function getDataNascimento() { return $this->dataNascimento; }
    
    public function setSenha($senha) { $this->senha = $senha; }
    public function getSenha() { return $this->senha; }
}
?>