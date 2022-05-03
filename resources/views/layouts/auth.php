<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $head ?>

    <?php foreach (["auth/custom"] as $css) : ?>
        <link rel="stylesheet" href="<?= CONF_APP_URL . "/public/css/{$css}" ?>.css">
    <?php endforeach; ?>

    <?= $this->section('styles') ?>
</head>

<body>
    <main class="main">
        <?= $this->section('content') ?>
    </main>

    <?php foreach (["jquery", "bootstrap", "auth/scripts"] as $js) : ?>
        <script src="<?= CONF_APP_URL . "/public/js/{$js}" ?>.js"></script>
    <?php endforeach; ?>
    <?= $this->section('scripts') ?>
</body>

</html>