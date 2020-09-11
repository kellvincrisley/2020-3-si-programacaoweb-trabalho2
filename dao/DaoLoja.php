<?php 
require_once(__DIR__ . '/../model/Loja.php');
require_once(__DIR__ . '/../db/Db.php');

class DaoLoja {
    
  private $connection;

  public function __construct(Db $connection) {
      $this->connection = $connection;
  }

  public function porId(int $id): ?Loja {
    $sql = "SELECT id,nome_fantasia,endereco,telefone,cnpj,cep FROM lojas where id = ?";
    $stmt = $this->connection->prepare($sql);
    $l = null;
    if ($stmt) {
      $stmt->bind_param('i',$id);
      if ($stmt->execute()) {

        $id = 0; $nome_fantasia = ''; $endereco = ''; $telefone = ''; $cnpj = ''; $cep = '';

        $stmt->bind_result($id,$nome_fantasia,$endereco,$telefone,$cnpj,$cep);
        $stmt->store_result();

        if ($stmt->num_rows == 1 && $stmt->fetch()) {
          $l = new Loja($nome_fantasia, $endereco, $telefone, $cnpj, $cep, $id);
        }

      }
      $stmt->close();
    }
    return $l;
  }

  public function inserir(Loja $loja): bool {
    $sql = "INSERT INTO lojas (nome_fantasia,endereco,telefone,cnpj,cep) VALUES(?,?,?,?,?)";
    $stmt = $this->connection->prepare($sql);
    $res = false;
    if ($stmt) {

      $nome_fantasia = $loja->getNome();
      $endereco = $loja->getEndereco();
      $telefone = $loja->getTelefone();
      $cnpj = $loja->getCnpj();
      $cep = $loja->getCep();

      $stmt->bind_param('sssss', $nome_fantasia, $endereco, $telefone, $cnpj,$cep);
      if ($stmt->execute()) {
          $id = $this->connection->getLastID();
          $loja->setId($id);
          $res = true;
      }
      $stmt->close();
    }
    return $res;
  }


  public function remover(Loja $loja): bool {

    $sql = "DELETE FROM lojas where id=?";
    $id = $loja->getId(); 
    $stmt = $this->connection->prepare($sql);
    $ret = false;
    if ($stmt) {

      $stmt->bind_param('i',$id);
      $ret = $stmt->execute();
      $stmt->close();

    }
    return $ret;
  }
  
  public function atualizar(Loja $loja): bool {
    $sql = "UPDATE lojas SET nome_fantasia=?, endereco=?, telefone=?, cnpj=?, cep=? WHERE id = ?";
    $stmt = $this->connection->prepare($sql);
    $ret = false;      
    if ($stmt) {
        
      $nome_fantasia = $loja->getNome();
      $endereco = $loja->getEndereco();
      $telefone = $loja->getTelefone();
      $cnpj = $loja->getCnpj();
      $cep = $loja->getCep();
      $id = $loja->getId();

      $stmt->bind_param('sssssi', $nome_fantasia, $endereco, $telefone, $cnpj,$cep, $id);
      $ret = $stmt->execute();
      $stmt->close();
    }
    return $ret;
  }

  public function todos(): array {
    $sql = "SELECT id,nome_fantasia,endereco,telefone,cnpj,cep from lojas";
    $stmt = $this->connection->prepare($sql);
    $lojas = [];
    if ($stmt) {
      if ($stmt->execute()) {

        $id = 0; $nome_fantasia = ''; $endereco = ''; $telefone = ''; $cnpj = ''; $cep = '';

        $stmt->bind_result($id,$nome_fantasia,$endereco,$telefone,$cnpj,$cep);
        $stmt->store_result();
        while($stmt->fetch()) {
          $lojas[] = new Loja($nome_fantasia, $endereco, $telefone, $cnpj, $cep, $id);
        }
      }
      $stmt->close();
    }
    return $lojas;
  }

};

