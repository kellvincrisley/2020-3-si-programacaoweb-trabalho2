<?php

require_once(__DIR__ . '/../../templates/template-html.php');
ob_start();

?>
<div class="container">
    <div class="py-5 text-center">
        <h2>Cadastro de Lojas</h2>
    </div>
    <div class="row">
        <div class="col-md-12">

            <form action="salvar.php" class="card p-2 my-4" method="POST">

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="nome_fantasia">Nome Fantasia</label>
                        <input type="text" placeholder="Nome fantasia" id="nome_fantasia"  class="form-control" name="nome_fantasia" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="endereco">Endereco</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" required>

                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                        <p> <small id="1Help" class="form-text text-muted">
                                Informe no máximo 20 caracteres
                            </small></p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" required>
                        <p> <small id="2Help" class="form-text text-muted">
                                Informe no máximo 20 caracteres
                            </small></p>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cep">Cep</label>
                        <input type="text" class="form-control" id="cep"  name="cep" placeholder="Cep" required>
                        <p> <small id="3Help" class="form-text text-muted">
                                Informe no máximo 15 caracteres
                            </small></p>
                    </div>
                </div>

                <div class="input-group">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Salvar</button>
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

?>