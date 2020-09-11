<?php

require_once(__DIR__ . '/../../templates/template-html.php');

require_once(__DIR__ . '/../../db/Db.php');
require_once(__DIR__ . '/../../model/Loja.php');
require_once(__DIR__ . '/../../dao/DaoLoja.php');
require_once(__DIR__ . '/../../config/config.php');

$conn = Db::getInstance();

if (!$conn->connect()) {
    die();
}

$daoLoja = new DaoLoja($conn);
$loja = $daoLoja->porId($_GET['id']);

if (!$loja)
    header('Location: ./index.php');

else {
    ob_start();

    ?>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Cadastro de Lojas</h2>
        </div>
        <div class="row">
            <div class="col-md-12">

                <form action="atualizar.php" class="card p-2 my-4" method="POST">

                    <input type="hidden" name="id" value="<?php echo $loja->getId(); ?>">
                    
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="nome_fantasia">Nome Fantasia</label>
                            <input type="text" placeholder="Nome fantasia" id="nome_fantasia" value="<?php echo $loja->getNome(); ?>" class="form-control" name="nome_fantasia" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="endereco">Endereco</label>
                            <input type="text" class="form-control" id="endereco" value="<?php echo $loja->getEndereco(); ?>" name="endereco" placeholder="Endereço" required>
                      
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" id="telefone" value="<?php echo $loja->getTelefone(); ?>" name="telefone" placeholder="Telefone" required>
                            <p> <small id="1Help" class="form-text text-muted">
                                    Informe no máximo 20 caracteres
                                </small></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" value="<?php echo $loja->getCnpj(); ?>" name="cnpj" placeholder="CNPJ" required>
                            <p> <small id="2Help" class="form-text text-muted">
                                    Informe no máximo 20 caracteres
                                </small></p>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cep">Cep</label>
                            <input type="text" class="form-control" id="cep" value="<?php echo $loja->getCep(); ?>" name="cep" placeholder="Cep" required>
                            <p> <small id="3Help" class="form-text text-muted">
                                    Informe no máximo 15 caracteres
                                </small></p>
                        </div>
                    </div>


                    <div class="input-group">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                            <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
                        </div>
                    </div>

                </form>


            </div>
        </div>
    </div>
    <?php

    $content = ob_get_clean();
    echo html($content);
} // else-if

?>