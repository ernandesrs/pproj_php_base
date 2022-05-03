<?php $this->layout('layouts/auth') ?>

<div class="auth-box login">
    <div class="auth-box-header">
        <h1 class="title">Login</h1>
    </div>
    <div class="auth-box-body">
        <form action="<?= $router->route("auth.authenticate") ?>" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Senha:</label>
                <input class="form-control" type="password" name="password">
            </div>

            <div class="py-2 text-center">
                <button class="btn btn-primary">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</div>