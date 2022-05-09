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
                <h1 class="border-bottom pb-3">
                    Teste de erros no formulário
                </h1>
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

            <div class="col-12 py-5">
                <h1 class="border-bottom pb-3">
                    Teste de envio de email
                </h1>
                <form class="jsFormSubmit" action="<?= $router->route("front.testPost", ["test" => "send_mail"]) ?>" method="post">
                    <div class="jsMessageArea"></div>

                    <div class="form-group">
                        <label for="to">Para:</label>
                        <input type="email" name="to" id="to" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="attach">Anexo:</label>
                        <input type="file" name="attach" id="attach" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="subject">Assunto:</label>
                        <textarea name="subject" id="subject" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="message">Mensagem:</label>
                        <textarea name="message" id="message" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">Enviar email</button>
                </form>
            </div>
        </div>
    </div>
</div>