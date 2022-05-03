<?php

namespace App\Controllers\Front;

use App\Controllers\FrontController;
use App\Core\Alert;
use App\Models\User;
use CoffeeCode\Router\Router;

class AuthController extends FrontController
{
    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    /**
     * @return void
     */
    public function login(): void
    {
        echo $this->template->render("auth/login", [
            "head" => $this->seo->render(CONF_APP_NAME . " | Login", "Página de login", null, null, false)
        ]);
        return;
    }

    /**
     * @param array $data
     * @return void
     */
    public function authenticate(array $data = []): void
    {
        var_dump($data);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        echo $this->template->render("auth/register", [
            "head" => $this->seo->render(CONF_APP_NAME . " | Registro", "Página de registro", null, null, false)
        ]);
        return;
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data = []): void
    {
        $validated = $this->validate($data);

        $user = (new User())->add($validated);
        if (!$user->save()) {
            echo json_encode([
                "message" => Alert::error("Erro ao tentar criar sua conta de usuário.")->get()
            ]);
            return;
        }

        Alert::success("Conta criada com sucesso, faça o login usando as credenciais cadastradas.")->session();
        echo json_encode([
            "redirect" => $this->router->route("auth.login")
        ]);
        return;
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function validate(array $data)
    {
        $errs = [];
        $validated = [];

        if (empty($data["first_name"])) {
            $errs["first_name"] = "Informe o nome";
        } else {
            $validated["first_name"] = filter_var($data["first_name"], FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($data["last_name"])) {
            $errs["last_name"] = "Informe o sobrenome";
        } else {
            $validated["last_name"] = filter_var($data["last_name"], FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($data["username"])) {
            $errs["username"] = "Informe o nome de usuário";
        } else {
            $validated["username"] = filter_var($data["username"], FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($data["gender"]) || !in_array($data["gender"], ["m", "f"])) {
            $errs["username"] = "Informe um gênero válido";
        } else {
            $validated["gender"] = filter_var($data["gender"], FILTER_SANITIZE_SPECIAL_CHARS);
        }

        if (empty($data["email"])) {
            $errs["email"] = "Informe um email";
        } else if ((new User())->find("email=:email", "email={$data['email']}")->count()) {
            $errs["email"] = "Email já está cadastrado";
        } else {
            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                $errs["email"] = "Informe um email válido";
            } else {
                $validated["email"] = filter_var($data["email"], FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if (empty($data["password"]) || empty($data["password_confirm"])) {
            $errs["password"] = "Informe a senha";
        } else {
            if ($data["password"] !== $data["password_confirm"]) {
                $errs["password"] = "Senhas não conferem";
            } else {
                $validated["password"] = $data["password"];
            }
        }

        if (count($errs)) {
            echo json_encode([
                "message" => "Alguns dados informados são inválidos.",
                "errors" => $errs
            ]);
            die;
        }

        return $validated;
    }
}
