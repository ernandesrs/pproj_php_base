<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $head ?>

    <?php foreach (["front/custom"] as $css) : ?>
        <link rel="stylesheet" href="<?= CONF_APP_URL . "/public/css/{$css}" ?>.css">
    <?php endforeach; ?>

    <?= $this->section('styles') ?>
</head>

<body>
    <header class="bg-light header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="<?= $router->route("front.index") ?>" title="<?= CONF_APP_NAME ?> Início">
                    <?= CONF_APP_NAME ?>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->route("front.index") ?>" title="<?= CONF_APP_NAME ?> Início">
                                Início
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $router->route("front.about") ?>">
                                Sobre
                            </a>
                        </li>
                    </ul>

                    <div class="ml-3 account">
                        <?php if ($auth = logged()) : ?>
                            <?php if (in_array($auth->level, [2, 3])) : ?>
                                <a class="btn btn-primary" href="<?= $router->route("admin.index") ?>" title="Acessar painel">
                                    Painel
                                </a>
                            <?php endif; ?>

                            <button class="btn btn-outline-primary">
                                Sair
                            </button>
                        <?php else : ?>
                            <a class="btn btn-primary" href="<?= $router->route("auth.login") ?>" title="Acessar sua conta">
                                Login
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="jsMessageArea">
                <?= flash_alert() ?>
            </div>
        </div>

        <?= $this->section('content') ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="text-center mb-0">
                Todos os direitos reservados
            </p>
        </div>
    </footer>

    <?php foreach (["jquery", "bootstrap", "front/scripts"] as $js) : ?>
        <script src="<?= CONF_APP_URL . "/public/js/{$js}" ?>.js"></script>
    <?php endforeach; ?>
    <?= $this->section('scripts') ?>
</body>

</html>