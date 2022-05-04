<?php $this->layout('layouts/front') ?>

<div class="h-100">
    <div class="container">
        <h1 class="text-center">
            <strong><?= CONF_APP_NAME ?></strong> FRONT | TESTES
        </h1>
        <div class="row justify-content-center">
            <div class="col-12">
                <a class="mx-1" href="<?= $router->route("front.test", ["test" => "fixed_message"]) ?>">Mensagem fixa</a>
                <a class="mx-1" href="<?= $router->route("front.test", ["test" => "float_message"]) ?>">Mensagem flutuante</a>
            </div>

            <div class="col-12 py-5">
                <form class="jsFormSubmit" action="<?= $router->route("front.testPost", ["test" => "form_errors"]) ?>" method="post">
                    <div class="jsMessageArea"></div>

                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input id="name" class="form-control" type="text" name="name">
                    </div>

                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input id="username" class="form-control" type="text" name="username">
                    </div>

                    <button class="btn btn-primary">Testar erros</button>
                </form>
            </div>
        </div>
    </div>
</div>