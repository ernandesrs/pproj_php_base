<?php $this->layout('layouts/auth') ?>

<div class="auth-box register">
    <div class="auth-box-header">
        <h1 class="title">Registro</h1>
    </div>
    <div class="auth-box-body">
        <form action="<?= $router->route("auth.create") ?>" method="POST">
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="first_name">Nome:</label>
                        <input class="form-control" type="text" name="first_name">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="last_name">Sobrenome:</label>
                        <input class="form-control" type="text" name="last_name">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="username">Usuário:</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="gender">Gênero:</label>
                        <select class="form-control" name="gender">
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
                        </select>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" name="email">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="password">Senha:</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="password_confirm">Confirmar senha:</label>
                        <input class="form-control" type="password" name="password_confirm">
                    </div>
                </div>
            </div>

            <div class="py-2 text-center">
                <button class="btn btn-primary">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</div>