<?php

class Loja {

private $id;
private $nome_fantasia;
private $endereco;
private $telefone;
private $cnpj;
private $cep;

public function __construct(string $nome_fantasia='',string $endereco = '',string $telefone = '',string $cnpj = '',string $cep='', int $id=-1) {
    $this->id = $id;
    $this->nome_fantasia = $nome_fantasia;
    $this->endereco = $endereco;
    $this->telefone = $telefone;
    $this->cnpj = $cnpj;
    $this->cep = $cep;
}

public function setId(int $id) {
    $this->id = $id;
}

public function getId() {
    return $this->id;
}

public function setNome(string $nome_fantasia){
    $this->nome_fantasia = $nome_fantasia;
}

public function getNome(){
    return $this->nome_fantasia;
}

public function setEndereco(string $endereco){
    $this->endereco = $endereco;
}

public function getEndereco(){
    return $this->endereco;
}

public function setTelefone(string $telefone){
    $this->telefone = $telefone;
}

public function getTelefone(){
    return $this->telefone;
}

public function setCnpj(string $cnpj){
    $this->cnpj = $cnpj;
}

public function getCnpj(){
    return $this->cnpj;
}

public function setCep(string $cep){
    $this->cep = $cep;
}

public function getCep(){
    return $this->cep;
}


};