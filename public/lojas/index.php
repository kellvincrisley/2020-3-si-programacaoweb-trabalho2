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
$lojas = $daoLoja->todos();

ob_start();

?>
<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Lojas</h2>
    </div>
    <div class="row mb-2">
        <div class="col-md-12">
            <a href="novo.php" class="btn btn-primary active" role="button" aria-pressed="true">Nova Loja</a>
        </div>
    </div>

    <?php
    if (count($lojas) > 0) {
        ?>

        <div class="row">
            <div class="col-md-12">
            
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome Fantasia</th>
                            <th scope="col">Endereço</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">CNPJ</th>
                            <th scope="col">CEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($lojas as $l) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo  $l->getId(); ?></th>
                                <td><?php echo $l->getNome(); ?></td>
                                <td><?php echo $l->getEndereco(); ?></td>
                                <td><?php echo $l->getTelefone(); ?></td>
                                <td><?php echo $l->getCnpj(); ?></td>
                                <td><?php echo $l->getCep(); ?></td>
                                <td>
                                    <a class="btn btn-danger btn-sm active" href="apagar.php?id=<?php echo $l->getId(); ?>">
                                        Apagar
                                    </a>
                                    <a class="btn btn-secondary btn-sm active" href="editar.php?id=<?php echo $l->getId(); ?>">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php
                    } // foreach
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    <?php

}  // if 
?>
</div>
<?php

$content = ob_get_clean();
echo html($content);

?>