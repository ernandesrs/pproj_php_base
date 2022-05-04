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
        </div>
    </div>
</div>