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

// Se for confirmação, apago o registro e redireciono para o index.php
if (isset($_POST['id']) && isset($_POST['confirmacao'])) {
  $loja = $daoLoja->porId($_POST['id']);
  $daoLoja->remover($loja);
  header('Location: ./index.php');
  exit;  // Termino a execucação desse script
}

// Se não for confirmação, exibo a confirmação
$loja = $daoLoja->porId($_GET['id']);
if (!$loja)
  header('Location: ./index.php');
else {
  ob_start();
  ?>
  <div class="container">
    <div class="py-5 text-center">
      <h2>Apagar Loja</h2>
    </div>
    <div class="row">
      <div class="col-md-12">

        <form action="apagar.php" class="card p-2 my-4" method="POST">
          <input type="hidden" name="id" value="<?php echo $loja->getId(); ?>">
          <div class="form-group">
            <label for="loja">Deseja realmente apagar a loja abaixo?</label>
            <input type="text" class="form-control" id="loja" aria-describedby="help" value="<?php echo $loja->getNome(); ?>" readonly>
            <small id="help" class="form-text text-muted">Esta operação não poderá ser desfeita.</small>
          </div>
          <div class="form-row">
            <input type="submit" class="btn btn-danger ml-1" value="Apagar" name="confirmacao" />
            <a href="index.php" class="btn btn-secondary ml-1" role="button" aria-pressed="true">Cancelar</a>
          </div>
        </form>

      </div>
    </div>
  </div>
  <?php
  $content = ob_get_clean();
  echo html($content);
}
?>